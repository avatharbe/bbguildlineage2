<?php
/**
 * bbGuild Lineage 2 Extension — disabling this plugin must not break core
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Adapted from functional-tests.md test #8 — per that doc, "the single
 * most important guardrail" for a non-flagship plugin, since it's the
 * failure mode that's hardest to spot in manual testing.
 *
 * Enables bbguild core + bbguildlineage2, creates a control guild using
 * core's own built-in 'custom' game_id (seeded by bbguild core's own
 * migrations, independent of any game plugin — so this test doesn't
 * depend on bbguildwow or any other plugin being installed), then disables
 * bbguildlineage2. Asserts:
 * - The control guild's page still renders 200
 * - bbguild core's ACP game list still loads
 *
 * Catches: shared service definitions accidentally moved into the plugin,
 * event listeners that throw when the plugin is gone.
 *
 * @group functional
 */
class avathar_bbguildlineage2_disable_keeps_core_test extends phpbb_functional_test_case
{
	/** guild id chosen to avoid colliding with bbguild core's own seeded sample guild (id=1) */
	const CONTROL_GUILD_ID = 602;

	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	public function test_disabling_lineage2_does_not_break_core_guild_or_acp()
	{
		$db = $this->get_db();
		$prefix = $this->get_table_prefix();

		// Control guild on bbguild core's own 'custom' game_id — seeded by
		// core's migrations, so this doesn't depend on any game plugin.
		$db->sql_query('DELETE FROM ' . $prefix . 'bb_guild WHERE id = ' . self::CONTROL_GUILD_ID);
		$db->sql_query('INSERT INTO ' . $prefix . 'bb_guild ' . $db->sql_build_array('INSERT', array(
			'id'             => self::CONTROL_GUILD_ID,
			'name'           => 'Control Custom Guild',
			'realm'          => 'TestRealm',
			'region'         => 'us',
			'roster'         => 1,
			'players'        => 0,
			'emblemurl'      => '',
			'game_id'        => 'custom',
			'game_edition'   => 'retail',
			'min_armory'     => 0,
			'rec_status'     => 0,
			'guilddefault'   => 0,
			'armory_enabled' => 0,
			'armoryresult'   => '',
			'recruitforum'   => 0,
			'faction'        => 1,
		)));

		$this->login();

		// Disable this plugin.
		$this->disable_ext('avathar/bbguildlineage2');

		// Control guild page must still render.
		self::request('GET', 'guild/' . self::CONTROL_GUILD_ID);
		$this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'control guild page must still render with bbguildlineage2 disabled');

		// bbguild core's ACP game list must still load.
		$this->admin_login();
		self::request('GET', 'adm/index.php?i=-avathar-bbguild-acp-game_module&mode=listgames&sid=' . $this->sid);
		$this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'bbguild core ACP game list must still load with bbguildlineage2 disabled');

		// Re-enable so later tests in the same suite run are unaffected.
		$this->install_ext('avathar/bbguildlineage2');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
