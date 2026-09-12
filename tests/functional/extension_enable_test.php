<?php
/**
 * bbGuild Lineage 2 Extension — extension enable functional test
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Enables bbguild core, then bbguildlineage2 on top. Adapted from
 * functional-tests.md test #1 for a plugin with no ACP modules of its own
 * (unlike bbguildwow, which asserts an ACP module is visible here — this
 * plugin registers none, so that assertion is intentionally dropped).
 *
 * Asserts:
 * - 'lineage2' row present in bb_games
 * - bbguildlineage2's classes seeded in bb_classes for game_id='lineage2'
 * - the plugin's own version constant (ext::BBGUILDLINEAGE2_VERSION, which
 *   is the canonical version source — this plugin has no phpbb_config
 *   version row) matches composer.json
 *
 * Catches: migration regressions, services.yml misconfig, missing tables.
 *
 * @group functional
 */
class avathar_bbguildlineage2_extension_enable_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	public function test_lineage2_game_row_seeded()
	{
		$db = $this->get_db();
		$sql = 'SELECT COUNT(*) AS cnt FROM ' . $this->get_table_prefix() . "bb_games WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$count = (int) $db->sql_fetchfield('cnt');
		$db->sql_freeresult($result);

		$this->assertSame(1, $count, 'exactly one lineage2 row expected in bb_games after enable');
	}

	public function test_lineage2_classes_seeded()
	{
		$db = $this->get_db();
		$sql = 'SELECT COUNT(*) AS cnt FROM ' . $this->get_table_prefix() . "bb_classes WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$count = (int) $db->sql_fetchfield('cnt');
		$db->sql_freeresult($result);

		$this->assertGreaterThan(0, $count, 'bbguildlineage2 classes expected in bb_classes for game_id=lineage2');
	}

	public function test_version_constant_matches_composer_json()
	{
		$composer = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);

		$this->assertSame(
			$composer['version'],
			\avathar\bbguildlineage2\ext::BBGUILDLINEAGE2_VERSION,
			'ext::BBGUILDLINEAGE2_VERSION must match composer.json "version"'
		);
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
