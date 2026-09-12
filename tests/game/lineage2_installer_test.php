<?php
/**
 * @package bbGuild Lineage2 Extension
 * @copyright (c) 2026 avathar.be
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace avathar\bbguildlineage2\tests\game;

use PHPUnit\Framework\TestCase;
use avathar\bbguildlineage2\game\lineage2_installer;

/**
 * Unit test for lineage2_installer's protected install_* methods.
 *
 * Mocks the phpBB db driver to capture sql_multi_insert() calls instead of
 * hitting a real database, then invokes each protected install_* method
 * this plugin actually overrides (install_factions, install_classes,
 * install_races) via reflection — exactly the seam wow_installer_test.php
 * uses. install_roles() is deliberately NOT exercised here: lineage2_installer
 * doesn't override it, so testing it would just be re-testing
 * abstract_game_install's own default (DPS/Healer/Tank) behavior, which
 * belongs to bbguild core's test suite, not this plugin's.
 *
 * This plugin is English-only (unlike wow's 4 languages), and seeds a
 * single "Default" faction (unlike wow's Alliance/Horde) — assertions
 * below reflect that, not wow's shape.
 */
class lineage2_installer_test extends TestCase
{
	/** @var lineage2_installer */
	protected $installer;

	/** @var array Captured sql_multi_insert calls: array of ['table' => ..., 'data' => ...] */
	protected $inserted = array();

	/** @var \PHPUnit\Framework\MockObject\MockObject */
	protected $db;

	protected function setUp(): void
	{
		parent::setUp();

		$this->inserted = array();

		$this->db = $this->createMock(\phpbb\db\driver\driver_interface::class);

		// Capture sql_multi_insert calls
		$this->db->method('sql_multi_insert')
			->willReturnCallback(function ($table, $data) {
				$this->inserted[] = array('table' => $table, 'data' => $data);
			});

		// sql_query (DELETE statements) — no-op
		$this->db->method('sql_query')->willReturn(true);
		$this->db->method('sql_escape')->willReturnCallback(function ($v) { return $v; });

		$cache = $this->createMock(\phpbb\cache\driver\driver_interface::class);
		$config = new \phpbb\config\config(array());
		$user = $this->getMockBuilder(\phpbb\user::class)
			->disableOriginalConstructor()
			->getMock();

		$this->installer = new lineage2_installer($this->db, $cache, $config, $user);

		// Set table_names and game_id via reflection (normally set by install())
		$ref = new \ReflectionClass($this->installer);

		$tn = $ref->getProperty('table_names');
		$tn->setAccessible(true);
		$tn->setValue($this->installer, array(
			'bb_factions_table' => 'phpbb_bb_factions',
			'bb_classes_table'  => 'phpbb_bb_classes',
			'bb_races_table'    => 'phpbb_bb_races',
			'bb_language_table' => 'phpbb_bb_language',
		));

		$gid = $ref->getProperty('game_id');
		$gid->setAccessible(true);
		$gid->setValue($this->installer, 'lineage2');
	}

	/**
	 * Invoke a protected method on the installer.
	 */
	private function invoke_protected(string $method_name): void
	{
		$this->inserted = array();
		$method = new \ReflectionMethod(lineage2_installer::class, $method_name);
		$method->setAccessible(true);
		$method->invoke($this->installer);
	}

	// ── Factions ───────────────────────────────────────────

	public function test_install_factions_count(): void
	{
		$this->invoke_protected('install_factions');
		$this->assertCount(1, $this->inserted);
		$this->assertCount(1, $this->inserted[0]['data']);
	}

	public function test_install_factions_ids(): void
	{
		$this->invoke_protected('install_factions');
		$factions = $this->inserted[0]['data'];
		$ids = array_column($factions, 'faction_id');
		$this->assertContains(1, $ids, 'Default faction_id=1');
	}

	public function test_install_factions_names(): void
	{
		$this->invoke_protected('install_factions');
		$factions = $this->inserted[0]['data'];
		$names = array_column($factions, 'faction_name');
		$this->assertContains('Default', $names);
	}

	public function test_install_factions_game_id(): void
	{
		$this->invoke_protected('install_factions');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('lineage2', $row['game_id']);
		}
	}

	// ── Classes ────────────────────────────────────────────

	public function test_install_classes_count(): void
	{
		$this->invoke_protected('install_classes');
		// First insert: class rows, second insert: language rows
		$this->assertCount(2, $this->inserted);
		$this->assertCount(110, $this->inserted[0]['data']);
	}

	public function test_install_classes_valid_armor_types(): void
	{
		$this->invoke_protected('install_classes');
		$valid = array('ROBE', 'LEATHER', 'HEAVY');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertContains($row['class_armor_type'], $valid, "class_id {$row['class_id']} has valid armor type");
		}
	}

	public function test_install_classes_unique_ids(): void
	{
		$this->invoke_protected('install_classes');
		$ids = array_column($this->inserted[0]['data'], 'class_id');
		$this->assertSame(count($ids), count(array_unique($ids)), 'no duplicate class_id within install_classes()');
	}

	public function test_install_classes_game_id(): void
	{
		$this->invoke_protected('install_classes');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('lineage2', $row['game_id']);
		}
	}

	public function test_install_classes_language_coverage(): void
	{
		$this->invoke_protected('install_classes');
		$lang_rows = $this->inserted[1]['data'];
		$languages = array_unique(array_column($lang_rows, 'language'));
		// Lineage 2 is English-only, unlike wow's 4 languages.
		$this->assertSame(array('en'), $languages);
	}

	public function test_install_classes_language_entries_match_class_count(): void
	{
		$this->invoke_protected('install_classes');
		$class_count = count($this->inserted[0]['data']);
		$lang_rows = $this->inserted[1]['data'];
		$this->assertCount($class_count, $lang_rows, 'one language row per seeded class (English-only)');
	}

	// ── Races ──────────────────────────────────────────────

	public function test_install_races_count(): void
	{
		$this->invoke_protected('install_races');
		// First insert: race rows, second insert: language rows
		$this->assertCount(2, $this->inserted);
		$this->assertCount(7, $this->inserted[0]['data']);
	}

	public function test_install_races_valid_factions(): void
	{
		// This plugin only ever seeds one faction (id=1, "Default"), so
		// every race must reference it — unlike wow's Alliance/Horde/neutral(0).
		$this->invoke_protected('install_races');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame(1, $row['race_faction_id'], "race_id {$row['race_id']} references the single seeded faction");
		}
	}

	public function test_install_races_unique_ids(): void
	{
		$this->invoke_protected('install_races');
		$ids = array_column($this->inserted[0]['data'], 'race_id');
		$this->assertSame(count($ids), count(array_unique($ids)), 'no duplicate race_id within install_races()');
	}

	public function test_install_races_game_id(): void
	{
		$this->invoke_protected('install_races');
		foreach ($this->inserted[0]['data'] as $row)
		{
			$this->assertSame('lineage2', $row['game_id']);
		}
	}

	public function test_install_races_language_coverage(): void
	{
		$this->invoke_protected('install_races');
		$lang_rows = $this->inserted[1]['data'];
		$languages = array_unique(array_column($lang_rows, 'language'));
		$this->assertSame(array('en'), $languages);
	}

	public function test_install_races_language_entries_match_race_count(): void
	{
		$this->invoke_protected('install_races');
		$race_count = count($this->inserted[0]['data']);
		$lang_rows = $this->inserted[1]['data'];
		$this->assertCount($race_count, $lang_rows, 'one language row per seeded race (English-only)');
	}

	// ── has_api_support() ──────────────────────────────────

	public function test_has_api_support_defaults_false(): void
	{
		// lineage2_installer does not override has_api_support(), so it
		// inherits abstract_game_install's default of false — this plugin
		// has no external API, unlike wow.
		$method = new \ReflectionMethod(lineage2_installer::class, 'has_api_support');
		$method->setAccessible(true);
		$this->assertFalse($method->invoke($this->installer));
	}
}
