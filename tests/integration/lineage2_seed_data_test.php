<?php
/**
 * bbGuild Lineage 2 Extension — seed data structural integrity test
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2026 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

/**
 * Per integration-tests.md's "Notes for other plugins": this plugin has no
 * external API, so the only integration-level value beyond the functional
 * tests is fixture-loading correctness — deeper structural correctness of
 * the seeded data than the functional tests check. Extends
 * phpbb_functional_test_case directly (per that doc's 2026-09 correction:
 * \phpbb_database_test_case does not give a real DB connection / installed
 * extension in this test framework — only phpbb_functional_test_case does).
 *
 * @group integration
 */
class avathar_bbguildlineage2_lineage2_seed_data_test extends phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('avathar/bbguild', 'avathar/bbguildlineage2');
	}

	public function test_every_class_has_a_valid_armor_type()
	{
		$db = $this->get_db();
		$valid = array('ROBE', 'LEATHER', 'HEAVY');

		$sql = 'SELECT class_id, class_armor_type FROM ' . $this->get_table_prefix() . "bb_classes WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$checked = 0;
		while ($row = $db->sql_fetchrow($result))
		{
			$this->assertContains($row['class_armor_type'], $valid, "class_id {$row['class_id']} has an invalid armor type: {$row['class_armor_type']}");
			$checked++;
		}
		$db->sql_freeresult($result);

		$this->assertGreaterThan(0, $checked, 'expected at least one lineage2 class row to check');
	}

	public function test_every_race_faction_id_references_a_valid_faction_or_zero()
	{
		$db = $this->get_db();
		$prefix = $this->get_table_prefix();

		$sql = "SELECT faction_id FROM {$prefix}bb_factions WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$valid_factions = array(0);
		while ($row = $db->sql_fetchrow($result))
		{
			$valid_factions[] = (int) $row['faction_id'];
		}
		$db->sql_freeresult($result);

		$sql = "SELECT race_id, race_faction_id FROM {$prefix}bb_races WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$checked = 0;
		while ($row = $db->sql_fetchrow($result))
		{
			$this->assertContains(
				(int) $row['race_faction_id'],
				$valid_factions,
				"race_id {$row['race_id']} references faction_id {$row['race_faction_id']}, which is not 0 and not a seeded lineage2 faction"
			);
			$checked++;
		}
		$db->sql_freeresult($result);

		$this->assertGreaterThan(0, $checked, 'expected at least one lineage2 race row to check');
	}

	public function test_no_duplicate_class_id_per_game_id()
	{
		$db = $this->get_db();
		$sql = "SELECT class_id, COUNT(*) AS cnt FROM " . $this->get_table_prefix() . "bb_classes
			WHERE game_id = 'lineage2'
			GROUP BY class_id
			HAVING COUNT(*) > 1";
		$result = $db->sql_query($sql);
		$duplicates = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$duplicates[] = $row['class_id'];
		}
		$db->sql_freeresult($result);

		$this->assertEmpty($duplicates, 'duplicate class_id(s) found for game_id=lineage2: ' . implode(', ', $duplicates));
	}

	public function test_no_duplicate_race_id_per_game_id()
	{
		$db = $this->get_db();
		$sql = "SELECT race_id, COUNT(*) AS cnt FROM " . $this->get_table_prefix() . "bb_races
			WHERE game_id = 'lineage2'
			GROUP BY race_id
			HAVING COUNT(*) > 1";
		$result = $db->sql_query($sql);
		$duplicates = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$duplicates[] = $row['race_id'];
		}
		$db->sql_freeresult($result);

		$this->assertEmpty($duplicates, 'duplicate race_id(s) found for game_id=lineage2: ' . implode(', ', $duplicates));
	}

	public function test_every_seeded_class_has_a_language_row()
	{
		// This installer seeds bb_language rows for every class (English
		// only) — assert none are missing.
		$db = $this->get_db();
		$prefix = $this->get_table_prefix();

		$sql = "SELECT class_id FROM {$prefix}bb_classes WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$class_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$class_ids[] = (int) $row['class_id'];
		}
		$db->sql_freeresult($result);

		$sql = "SELECT attribute_id FROM {$prefix}bb_language WHERE game_id = 'lineage2' AND attribute = 'class' AND language = 'en'";
		$result = $db->sql_query($sql);
		$lang_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$lang_ids[] = (int) $row['attribute_id'];
		}
		$db->sql_freeresult($result);

		$missing = array_diff($class_ids, $lang_ids);
		$this->assertEmpty($missing, 'class_id(s) missing an English bb_language row: ' . implode(', ', $missing));
	}

	public function test_every_seeded_race_has_a_language_row()
	{
		$db = $this->get_db();
		$prefix = $this->get_table_prefix();

		$sql = "SELECT race_id FROM {$prefix}bb_races WHERE game_id = 'lineage2'";
		$result = $db->sql_query($sql);
		$race_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$race_ids[] = (int) $row['race_id'];
		}
		$db->sql_freeresult($result);

		$sql = "SELECT attribute_id FROM {$prefix}bb_language WHERE game_id = 'lineage2' AND attribute = 'race' AND language = 'en'";
		$result = $db->sql_query($sql);
		$lang_ids = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$lang_ids[] = (int) $row['attribute_id'];
		}
		$db->sql_freeresult($result);

		$missing = array_diff($race_ids, $lang_ids);
		$this->assertEmpty($missing, 'race_id(s) missing an English bb_language row: ' . implode(', ', $missing));
	}

	private function get_table_prefix(): string
	{
		return self::$config['table_prefix'];
	}
}
