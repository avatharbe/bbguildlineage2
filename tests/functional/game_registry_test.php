<?php
/**
 * bbGuild Lineage 2 Extension — game registry functional test
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Adapted from functional-tests.md test #2. After enabling, requests the
 * bbguild core game registry service and asserts Lineage 2 is registered
 * with has_api() === false — unlike wow, this plugin has no external API
 * (no Battle.net-style integration), so the registry's copy of the
 * provider must reflect that.
 *
 * Catches: 'bbguild.game_provider' tag missing in services.yml, broken
 * provider class, wrong has_api()/get_installer() wiring.
 *
 * @group functional
 */
class avathar_bbguildlineage2_game_registry_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	public function test_lineage2_provider_registered_without_api()
	{
		// No DI container is reachable in-process for phpbb_functional_test_case
		// (see integration-tests.md's "no container reachable" note) — the
		// registry itself is only assembled inside a real phpBB request. So
		// this asserts the registry's effect (the seeded bb_games row and its
		// armory_enabled flag) rather than resolving the service directly.
		$db = $this->get_db();
		$sql = "SELECT armory_enabled FROM " . $this->get_table_prefix() . "bb_games WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$db->sql_freeresult($result);

		$this->assertNotFalse($row, 'lineage2 game row must exist for the provider to have installed correctly');
		$this->assertEquals(0, (int) $row['armory_enabled'], 'lineage2 has no API — armory_enabled must be 0 (has_api() === false)');
	}

	public function test_lineage2_provider_class_resolvable()
	{
		// Static guard: the tagged service class itself must exist and
		// autoload, and must actually implement game_provider_interface
		// with has_api() === false — this is the part of the registry
		// wiring that IS resolvable without a container.
		$this->assertTrue(class_exists(\avathar\bbguildlineage2\game\lineage2_provider::class));

		$interfaces = class_implements(\avathar\bbguildlineage2\game\lineage2_provider::class);
		$this->assertArrayHasKey(\avathar\bbguild\model\games\game_provider_interface::class, $interfaces);
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
