<?php
/**
 * bbGuild Lineage 2 Extension — migration idempotency smoke test
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Disables bbguildlineage2 (data preserved) and re-enables it, then asserts
 * seeded rows were not duplicated. Disable does not revert schema/data,
 * so re-enabling re-runs every migration's effectively_installed() check
 * against data that's already there — this is the only way to exercise
 * that path without a second fresh install. Catches migrations that
 * mistakenly re-seed or re-create on a second run.
 *
 * Unlike bbguildwow, this plugin does not (yet) seed any bb_specializations
 * rows (separate open ticket), so that table is not checked here — instead
 * bb_classes, bb_races, and bb_language (all English-only for this plugin)
 * are checked directly.
 *
 * @group smoke
 */
class avathar_bbguildlineage2_smoke_migration_idempotency_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	private function count_rows(string $table, string $where): int
	{
		$db = $this->get_db();
		$sql = 'SELECT COUNT(*) AS cnt FROM ' . $table . ' WHERE ' . $where;
		$result = $db->sql_query($sql);
		$count = (int) $db->sql_fetchfield('cnt');
		$db->sql_freeresult($result);

		return $count;
	}

	public function test_reenable_does_not_duplicate_seeded_data()
	{
		$before_games = $this->count_rows($this->get_table_prefix() . 'bb_games', "game_id = 'lineage2'");
		$before_classes = $this->count_rows($this->get_table_prefix() . 'bb_classes', "game_id = 'lineage2'");
		$before_races = $this->count_rows($this->get_table_prefix() . 'bb_races', "game_id = 'lineage2'");
		$before_language = $this->count_rows($this->get_table_prefix() . 'bb_language', "game_id = 'lineage2'");
		$before_migrations = $this->count_rows($this->get_table_prefix() . 'migrations', "migration_name LIKE '%bbguildlineage2%'");

		$this->disable_ext('avathar/bbguildlineage2');
		$this->install_ext('avathar/bbguildlineage2');

		$after_games = $this->count_rows($this->get_table_prefix() . 'bb_games', "game_id = 'lineage2'");
		$after_classes = $this->count_rows($this->get_table_prefix() . 'bb_classes', "game_id = 'lineage2'");
		$after_races = $this->count_rows($this->get_table_prefix() . 'bb_races', "game_id = 'lineage2'");
		$after_language = $this->count_rows($this->get_table_prefix() . 'bb_language', "game_id = 'lineage2'");
		$after_migrations = $this->count_rows($this->get_table_prefix() . 'migrations', "migration_name LIKE '%bbguildlineage2%'");

		$this->assertSame(1, $before_games, 'expected exactly one lineage2 row in bb_games before re-enable');
		$this->assertSame($before_games, $after_games, 'bb_games lineage2 row was duplicated on re-enable');
		$this->assertSame($before_classes, $after_classes, 'bb_classes lineage2 rows were duplicated on re-enable');
		$this->assertSame($before_races, $after_races, 'bb_races lineage2 rows were duplicated on re-enable');
		$this->assertSame($before_language, $after_language, 'bb_language lineage2 rows were duplicated on re-enable');
		$this->assertSame($before_migrations, $after_migrations, 'bbguildlineage2 migration rows changed on re-enable');
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
