<?php
/**
 * bbGuild Lineage 2 Extension — guild view rendering functional test
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Adapted from functional-tests.md test #3. Inserts a guild fixture with
 * game_id='lineage2' plus a roster portal module for it (bbguild core only
 * auto-seeds a roster module for its own sample guild_id=1, see
 * migrations/v200b3/release_2_0_0_b3.php::seed_portal_layout(); any other
 * guild needs its own bb_portal_modules row) and one player using a valid
 * Lineage 2 class/race. GETs /guild/{guild_id} as an authenticated user.
 *
 * Asserts:
 * - Response is 200
 * - The roster module rendered the player's class image under
 *   ext/avathar/bbguildlineage2/images/ (this plugin's own images path,
 *   resolved via lineage2_provider::get_images_path() through bbguild
 *   core's game_registry — see portal/modules/roster.php::get_game_images_path())
 *
 * Catches: guild_context wiring, image path resolution, provider
 * registration regressions.
 *
 * @group functional
 */
class avathar_bbguildlineage2_guild_view_renders_test extends phpbb_functional_test_case
{
	/** guild id chosen to avoid colliding with bbguild core's seeded sample guild (id=1) */
	const GUILD_ID = 601;

	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	public function test_guild_page_renders_player_with_class_image()
	{
		$db = $this->get_db();
		$prefix = $this->get_table_prefix();

		// A valid Lineage 2 class/race pair: class_id=1 (Human Fighter,
		// imagename lineage2_hfighter), race_id=1 (Human).
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_players WHERE player_guild_id = ' . self::GUILD_ID);
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_portal_modules WHERE guild_id = ' . self::GUILD_ID);
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_portal_tabs WHERE guild_id = ' . self::GUILD_ID);
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_ranks WHERE guild_id = ' . self::GUILD_ID);
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_guild WHERE id = ' . self::GUILD_ID);

		$db->sql_query('INSERT INTO ' . $prefix . 'bb_guild ' . $db->sql_build_array('INSERT', array(
			'id'             => self::GUILD_ID,
			'name'           => 'Test Lineage 2 Guild',
			'realm'          => 'TestRealm',
			'region'         => 'us',
			'roster'         => 1,
			'players'        => 1,
			'emblemurl'      => '',
			'game_id'        => 'lineage2',
			'game_edition'   => 'retail',
			'min_armory'     => 0,
			'rec_status'     => 0,
			'guilddefault'   => 0,
			'armory_enabled' => 0,
			'armoryresult'   => '',
			'recruitforum'   => 0,
			'faction'        => 1,
		)));

		// getplayerlist() inner-joins bb_ranks on (guild_id, rank_id,
		// rank_hide=0) — without this row the player below is silently
		// excluded from the roster query regardless of everything else
		// being correct.
		$db->sql_query('INSERT INTO ' . $prefix . 'bb_ranks ' . $db->sql_build_array('INSERT', array(
			'guild_id'    => self::GUILD_ID,
			'rank_id'     => 0,
			'rank_name'   => 'Guild Leader',
			'rank_hide'   => 0,
			'rank_prefix' => '',
			'rank_suffix' => '',
		)));

		$db->sql_query('INSERT INTO ' . $prefix . 'bb_players ' . $db->sql_build_array('INSERT', array(
			'game_id'             => 'lineage2',
			'player_name'         => 'Testcharacter',
			'player_region'       => 'us',
			'player_realm'        => 'TestRealm',
			'player_title'        => '',
			'player_level'        => 40,
			'player_race_id'      => 1,
			'player_class_id'     => 1,
			'player_rank_id'      => 0,
			'player_role'         => '',
			'player_comment'      => '',
			'player_joindate'     => time(),
			'player_outdate'      => 0,
			'player_guild_id'     => self::GUILD_ID,
			'player_gender_id'    => 1,
			'player_achiev'       => 0,
			'player_armory_url'   => '',
			'player_portrait_url' => '',
			'player_spec'         => '',
			'phpbb_user_id'       => 0,
			'player_status'       => 1,
			'deactivate_reason'   => '',
			'last_update'         => time(),
		)));

		// Seed a portal tab first -- portal_renderer::render() bails out
		// before ever looking at bb_portal_modules when a guild has zero
		// tabs (bbguild#360's page-level tabs; see also #374, which
		// backfills this for guilds created through the normal ACP flow,
		// but a fixture inserting rows directly via SQL bypasses that flow
		// entirely and needs to seed its own tab).
		$db->sql_query('INSERT INTO ' . $prefix . 'bb_portal_tabs ' . $db->sql_build_array('INSERT', array(
			'guild_id'   => self::GUILD_ID,
			'tab_name'   => 'Overview',
			'tab_slug'   => 'welcome',
			'tab_order'  => 0,
			'tab_status' => 1,
		)));
		$tab_id = (int) $db->sql_last_inserted_id();

		// Roster portal module for this guild (center column, matching the
		// layout bbguild core's own sample-guild migration uses).
		$db->sql_query('INSERT INTO ' . $prefix . 'bb_portal_modules ' . $db->sql_build_array('INSERT', array(
			'guild_id'            => self::GUILD_ID,
			'module_tab'          => $tab_id,
			'module_classname'    => '\avathar\bbguild\portal\modules\roster',
			'module_column'       => 2,
			'module_order'        => 1,
			'module_name'         => 'BBGUILD_PORTAL_ROSTER',
			'module_image_src'    => '',
			'module_icon'         => '',
			'module_icon_size'    => 16,
			'module_image_width'  => 16,
			'module_image_height' => 16,
			'module_group_ids'    => '',
			'module_status'       => 1,
		)));

		$this->login();
		$crawler = self::request('GET', 'guild/' . self::GUILD_ID);

		$this->assertEquals(200, self::$client->getResponse()->getStatus());

		$html = $crawler->html();
		$this->assertStringContainsString(
			'ext/avathar/bbguildlineage2/images/',
			$html,
			'roster module should render the class image under this plugin\'s own images path'
		);
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
