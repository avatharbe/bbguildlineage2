<?php
/**
 * Lineage 2 Installer
 *
 * Installs Lineage 2 factions, classes, races, and roles.
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2018 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace avathar\bbguildlineage2\game;

use avathar\bbguild\model\games\abstract_game_install;

class lineage2_installer extends abstract_game_install
{
	/**
	 * Installs Lineage 2 factions
	 */
	protected function install_factions()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_factions_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'faction_id' => 1, 'faction_name' => 'Default');
		$this->db->sql_multi_insert($this->table('bb_factions_table'), $sql_ary);
	}

	/**
	 * Installs Lineage 2 classes (English only, 110 classes)
	 */
	protected function install_classes()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_classes_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();

		// Unknown
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 0, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#BBBBBB', 'imagename' => 'lineage2_Unknown');

		// ================ HUMANS ================ //
		// Human Fighter - 1-20
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 1, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_hfighter');
		// Human Warrior - 20-40
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 2, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_hwarrior');
		// Human Knight - 20-40
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 3, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_hknight');
		// Human Rogue - 20-40
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 4, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_hrogue');
		// Human Mystic - 1-20
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 5, 'class_armor_type' => 'ROBE', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_hmystic');
		// Human Wizard - 20-40
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 6, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_hwizard');
		// Human Cleric - 20-40
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 7, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_hcleric');
		// Human Warlord
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 8, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_warlord');
		// Human Gladiator
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 9, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_gladiator');
		// Human Paladin
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 10, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_paladin');
		// Human Dark Avenger
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 11, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_darkavenger');
		// Human Treasure Hunter
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 12, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_treasurehunter');
		// Human Hawkeye
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 13, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_hawkeye');
		// Human Sorcerer
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 14, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_sorc');
		// Human Necromancer
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 15, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_necro');
		// Human Warlock
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 16, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_warlock');
		// Human Bishop
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 17, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_bishop');
		// Human Prophet
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 18, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_prophet');
		// Human Dreadnought
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 19, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_dreadnought');
		// Human Duelist
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 20, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_duelist');
		// Human Phoenix Knight
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 21, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_phoenixknight');
		// Human Hell Knight
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 22, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_hellknight');
		// Human Adventurer
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 23, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_adventurer');
		// Human Sagittarius
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 24, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_sagittarius');
		// Human Archmage
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 25, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_archmage');
		// Human Soultaker
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 26, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_soultaker');
		// Human Arcana Lord
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 27, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_arcanalord');
		// Human Cardinal
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 28, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_cardinal');
		// Human Hierophant
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 29, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_hierophant');

		// ================ ELVES ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 30, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_efighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 31, 'class_armor_type' => 'ROBE', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_emystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 32, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_eknight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 33, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_escout');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 34, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_ewizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 35, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_eoracle');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 36, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_templeknight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 37, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_swordsinger');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 38, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_plainswalker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 39, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_silverranger');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 40, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_spellsinger');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 41, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_elementalsummoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 42, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_elvenelder');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 43, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_evastemplar');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 44, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_swordmuse');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 45, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_windrider');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 46, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_moonlightsentinel');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 47, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_mysticmuse');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 48, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_elementalmaster');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 49, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_evassaint');

		// ================ DARK ELVES ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 50, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_defighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 51, 'class_armor_type' => 'ROBE', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_demystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 52, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_palusknight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 53, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_assassin');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 54, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_dewizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 55, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_soracle');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 56, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_shillienknight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 57, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_bladedancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 58, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_abysswalker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 59, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_phantomranger');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 60, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_spellhowler');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 61, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_phantomsummoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 62, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_shillienelder');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 63, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_shillientemplar');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 64, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_spectraldancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 65, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_ghosthunter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 66, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_ghosttsentinel');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 67, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_stormscreamer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 68, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_spectralmaster');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 69, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_shilliensaint');

		// ================ ORCS ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 70, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_ofighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 71, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_omystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 72, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_oraider');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 73, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_omonk');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 74, 'class_armor_type' => 'ROBE', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_oshaman');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 75, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_destroyer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 76, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_tyrant');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 77, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_overlord');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 78, 'class_armor_type' => 'ROBE', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_warcryer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 79, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_titan');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 80, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_grandkhavatari');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 81, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_dominator');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 82, 'class_armor_type' => 'ROBE', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_doomcryer');

		// ================ DWARVES ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 83, 'class_armor_type' => 'HEAVY', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_dfighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 84, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_scavenger');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 85, 'class_armor_type' => 'HEAVY', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_artisan');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 86, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_bountyhunter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 87, 'class_armor_type' => 'HEAVY', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_warsmith');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 88, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_fortuneseeker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 89, 'class_armor_type' => 'HEAVY', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_maestro');

		// ================ KAMAELS ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 90, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_kmsoldier');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 91, 'class_armor_type' => 'LEATHER', 'class_min_level' => 1, 'class_max_level' => 20, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_kfsoldier');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 92, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_trooper');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 93, 'class_armor_type' => 'LEATHER', 'class_min_level' => 20, 'class_max_level' => 40, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_warder');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 94, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_berserker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 95, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_soulbreaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 96, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_arbalester');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 97, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_doombringer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 98, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_soulhound');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 99, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_trickster');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 100, 'class_armor_type' => 'LEATHER', 'class_min_level' => 40, 'class_max_level' => 76, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_inspector');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 101, 'class_armor_type' => 'LEATHER', 'class_min_level' => 76, 'class_max_level' => 85, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_judicator');

		// ================ AWAKENED CLASSES ================ //
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 102, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_yrarcher');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 103, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_tyrwarrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 104, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_feohwizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 105, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#FF0044', 'imagename' => 'lineage2_othellrogue');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 106, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_issenchanter');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 107, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC9933', 'imagename' => 'lineage2_sigelknight');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 108, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#32CD32', 'imagename' => 'lineage2_eolhhealer');
		$sql_ary[] = array('game_id' => $this->game_id, 'class_id' => 109, 'class_armor_type' => 'LEATHER', 'class_min_level' => 85, 'class_max_level' => 99, 'colorcode' => '#CC00BB', 'imagename' => 'lineage2_wynnsummoner');

		$this->db->sql_multi_insert($this->table('bb_classes_table'), $sql_ary);
		unset($sql_ary);

		// class names (English only)
		$this->db->sql_query('DELETE FROM ' . $this->table('bb_language_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "' AND attribute='class' ");

		$sql_ary = array();
		// Humans
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0,  'language' => 'en', 'attribute' => 'class', 'name' => 'Unknown',              'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Fighter',         'name_short' => 'Human Fighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Warrior',         'name_short' => 'Human Warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Knight',          'name_short' => 'Human Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Rogue',           'name_short' => 'Human Rogue');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Mystic',          'name_short' => 'Human Mystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Wizard',          'name_short' => 'Human Wizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 7,  'language' => 'en', 'attribute' => 'class', 'name' => 'Human Cleric',          'name_short' => 'Human Cleric');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 8,  'language' => 'en', 'attribute' => 'class', 'name' => 'Warlord',               'name_short' => 'Warlord');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 9,  'language' => 'en', 'attribute' => 'class', 'name' => 'Gladiator',             'name_short' => 'Gladiator');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 10, 'language' => 'en', 'attribute' => 'class', 'name' => 'Paladin',               'name_short' => 'Paladin');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 11, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dark Avenger',          'name_short' => 'Dark Avenger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 12, 'language' => 'en', 'attribute' => 'class', 'name' => 'Treasure Hunter',       'name_short' => 'Treasure Hunter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 13, 'language' => 'en', 'attribute' => 'class', 'name' => 'Hawkeye',               'name_short' => 'Hawkeye');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 14, 'language' => 'en', 'attribute' => 'class', 'name' => 'Sorcerer',              'name_short' => 'Sorcerer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 15, 'language' => 'en', 'attribute' => 'class', 'name' => 'Necromancer',           'name_short' => 'Necromancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 16, 'language' => 'en', 'attribute' => 'class', 'name' => 'Warlock',               'name_short' => 'Warlock');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 17, 'language' => 'en', 'attribute' => 'class', 'name' => 'Bishop',                'name_short' => 'Bishop');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 18, 'language' => 'en', 'attribute' => 'class', 'name' => 'Prophet',               'name_short' => 'Prophet');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 19, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dreadnought',           'name_short' => 'Dreadnought');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 20, 'language' => 'en', 'attribute' => 'class', 'name' => 'Duelist',               'name_short' => 'Duelist');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 21, 'language' => 'en', 'attribute' => 'class', 'name' => 'Phoenix Knight',        'name_short' => 'Phoenix Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 22, 'language' => 'en', 'attribute' => 'class', 'name' => 'Hell Knight',           'name_short' => 'Hell Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 23, 'language' => 'en', 'attribute' => 'class', 'name' => 'Adventurer',            'name_short' => 'Adventurer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 24, 'language' => 'en', 'attribute' => 'class', 'name' => 'Sagittarius',           'name_short' => 'Sagittarius');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 25, 'language' => 'en', 'attribute' => 'class', 'name' => 'Archmage',              'name_short' => 'Archmage');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 26, 'language' => 'en', 'attribute' => 'class', 'name' => 'Soultaker',             'name_short' => 'Soultaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 27, 'language' => 'en', 'attribute' => 'class', 'name' => 'Arcana Lord',           'name_short' => 'Arcana Lord');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 28, 'language' => 'en', 'attribute' => 'class', 'name' => 'Cardinal',              'name_short' => 'Cardinal');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 29, 'language' => 'en', 'attribute' => 'class', 'name' => 'Hierophant',            'name_short' => 'Hierophant');

		// Elves
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 30, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Fighter',         'name_short' => 'Elven Fighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 31, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Mystic',          'name_short' => 'Elven Mystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 32, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Knight',          'name_short' => 'Elven Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 33, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Scout',           'name_short' => 'Elven Scout');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 34, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Wizard',          'name_short' => 'Elven Wizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 35, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Oracle',          'name_short' => 'Elven Oracle');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 36, 'language' => 'en', 'attribute' => 'class', 'name' => 'Temple Knight',         'name_short' => 'Temple Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 37, 'language' => 'en', 'attribute' => 'class', 'name' => 'SwordSinger',           'name_short' => 'SwordSinger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 38, 'language' => 'en', 'attribute' => 'class', 'name' => 'Plainswalker',          'name_short' => 'Plainswalker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 39, 'language' => 'en', 'attribute' => 'class', 'name' => 'Silver Ranger',         'name_short' => 'Silver Ranger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 40, 'language' => 'en', 'attribute' => 'class', 'name' => 'SpellSinger',           'name_short' => 'SpellSinger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 41, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elemental Summoner',    'name_short' => 'Elemental Summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 42, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elven Elder',           'name_short' => 'Elven Elder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 43, 'language' => 'en', 'attribute' => 'class', 'name' => 'Eva\'s Templar',        'name_short' => 'Eva Templar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 44, 'language' => 'en', 'attribute' => 'class', 'name' => 'Sword Muse',            'name_short' => 'Sword Muse');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 45, 'language' => 'en', 'attribute' => 'class', 'name' => 'Wind Rider',            'name_short' => 'Wind Rider');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 46, 'language' => 'en', 'attribute' => 'class', 'name' => 'Moonglight Sentinel',   'name_short' => 'Moonglight Sentinel');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 47, 'language' => 'en', 'attribute' => 'class', 'name' => 'Mystic Muse',           'name_short' => 'Mystic Muse');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 48, 'language' => 'en', 'attribute' => 'class', 'name' => 'Elemental Master',      'name_short' => 'Elemental Master');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 49, 'language' => 'en', 'attribute' => 'class', 'name' => 'Eva\'s Saint',          'name_short' => 'Eva Saint');

		// Dark Elves
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 50, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dark Fighter',          'name_short' => 'Dark Fighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 51, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dark Mystic',           'name_short' => 'Dark Mystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 52, 'language' => 'en', 'attribute' => 'class', 'name' => 'Palus Knight',          'name_short' => 'Palus Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 53, 'language' => 'en', 'attribute' => 'class', 'name' => 'Assassin',              'name_short' => 'Assassin');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 54, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dark Wizard',           'name_short' => 'Dark Wizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 55, 'language' => 'en', 'attribute' => 'class', 'name' => 'Shillien Oracle',       'name_short' => 'Shillien Oracle');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 56, 'language' => 'en', 'attribute' => 'class', 'name' => 'Shillien Knight',       'name_short' => 'Shillien Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 57, 'language' => 'en', 'attribute' => 'class', 'name' => 'Blade Dancer',          'name_short' => 'Blade Dancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 58, 'language' => 'en', 'attribute' => 'class', 'name' => 'Abyss Walker',          'name_short' => 'Abyss Walker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 59, 'language' => 'en', 'attribute' => 'class', 'name' => 'Phantom Ranger',        'name_short' => 'Phantom Ranger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 60, 'language' => 'en', 'attribute' => 'class', 'name' => 'Spell Howler',          'name_short' => 'Spell Howler');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 61, 'language' => 'en', 'attribute' => 'class', 'name' => 'Phantom Summoner',      'name_short' => 'Phantom Summoner');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 62, 'language' => 'en', 'attribute' => 'class', 'name' => 'Shillien Elder',        'name_short' => 'Shillien Elder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 63, 'language' => 'en', 'attribute' => 'class', 'name' => 'Shillien Templar',      'name_short' => 'Shillien Templar');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 64, 'language' => 'en', 'attribute' => 'class', 'name' => 'Spectral Dancer',       'name_short' => 'Spectral Dancer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 65, 'language' => 'en', 'attribute' => 'class', 'name' => 'Ghost Rider',           'name_short' => 'Ghost Rider');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 66, 'language' => 'en', 'attribute' => 'class', 'name' => 'Ghost Sentinel',        'name_short' => 'Ghost Sentinel');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 67, 'language' => 'en', 'attribute' => 'class', 'name' => 'Storm Screamer',        'name_short' => 'Storm Screamer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 68, 'language' => 'en', 'attribute' => 'class', 'name' => 'Spectral Master',       'name_short' => 'Spectral Master');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 69, 'language' => 'en', 'attribute' => 'class', 'name' => 'Shillien Saint',        'name_short' => 'Shillien Saint');

		// Orcs
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 70, 'language' => 'en', 'attribute' => 'class', 'name' => 'Orc Fighter',           'name_short' => 'Orc Fighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 71, 'language' => 'en', 'attribute' => 'class', 'name' => 'Orc Mystic',            'name_short' => 'Orc Mystic');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 72, 'language' => 'en', 'attribute' => 'class', 'name' => 'Orc Raider',            'name_short' => 'Orc Raider');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 73, 'language' => 'en', 'attribute' => 'class', 'name' => 'Orc Monk',              'name_short' => 'Orc Monk');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 74, 'language' => 'en', 'attribute' => 'class', 'name' => 'Orc Shaman',            'name_short' => 'Orc Shaman');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 75, 'language' => 'en', 'attribute' => 'class', 'name' => 'Destroyer',             'name_short' => 'Destroyer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 76, 'language' => 'en', 'attribute' => 'class', 'name' => 'Tyrant',                'name_short' => 'Tyrant');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 77, 'language' => 'en', 'attribute' => 'class', 'name' => 'Overlord',              'name_short' => 'Overlord');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 78, 'language' => 'en', 'attribute' => 'class', 'name' => 'Warcryer',              'name_short' => 'Warcryer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 79, 'language' => 'en', 'attribute' => 'class', 'name' => 'Titan',                 'name_short' => 'Titan');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 80, 'language' => 'en', 'attribute' => 'class', 'name' => 'Grand Khavatari',       'name_short' => 'Grand Khavatari');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 81, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dominator',             'name_short' => 'Dominator');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 82, 'language' => 'en', 'attribute' => 'class', 'name' => 'Doomcryer',             'name_short' => 'Doomcryer');

		// Dwarves
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 83, 'language' => 'en', 'attribute' => 'class', 'name' => 'Dwarven Fighter',       'name_short' => 'Dwarven Fighter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 84, 'language' => 'en', 'attribute' => 'class', 'name' => 'Scavenger',             'name_short' => 'Scavenger');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 85, 'language' => 'en', 'attribute' => 'class', 'name' => 'Artisan',               'name_short' => 'Artisan');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 86, 'language' => 'en', 'attribute' => 'class', 'name' => 'Bounty Hunter',         'name_short' => 'Bounty Hunter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 87, 'language' => 'en', 'attribute' => 'class', 'name' => 'Warsmith',              'name_short' => 'Warsmith');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 88, 'language' => 'en', 'attribute' => 'class', 'name' => 'Fortune Seeker',        'name_short' => 'Fortune Seeker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 89, 'language' => 'en', 'attribute' => 'class', 'name' => 'Maestro',               'name_short' => 'Maestro');

		// Kamaels
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 90,  'language' => 'en', 'attribute' => 'class', 'name' => 'Kamael Male Solder',   'name_short' => 'Kamael Male Solder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 91,  'language' => 'en', 'attribute' => 'class', 'name' => 'Kamael Female Solder', 'name_short' => 'Kamael Female Solder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 92,  'language' => 'en', 'attribute' => 'class', 'name' => 'Trooper',              'name_short' => 'Trooper');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 93,  'language' => 'en', 'attribute' => 'class', 'name' => 'Warder',               'name_short' => 'Warder');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 94,  'language' => 'en', 'attribute' => 'class', 'name' => 'Berserker',            'name_short' => 'Berserker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 95,  'language' => 'en', 'attribute' => 'class', 'name' => 'Soul Breaker',         'name_short' => 'Soul Breaker');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 96,  'language' => 'en', 'attribute' => 'class', 'name' => 'Arbalester',           'name_short' => 'Arbalester');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 97,  'language' => 'en', 'attribute' => 'class', 'name' => 'Doombringer',          'name_short' => 'Doombringer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 98,  'language' => 'en', 'attribute' => 'class', 'name' => 'Soul Hound',           'name_short' => 'Soul Hound');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 99,  'language' => 'en', 'attribute' => 'class', 'name' => 'Trickster',            'name_short' => 'Trickster');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 100, 'language' => 'en', 'attribute' => 'class', 'name' => 'Inspector',            'name_short' => 'Inspector');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 101, 'language' => 'en', 'attribute' => 'class', 'name' => 'Judicator',            'name_short' => 'Judicator');

		// Awakened
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 102, 'language' => 'en', 'attribute' => 'class', 'name' => 'Yr Archer',            'name_short' => 'Yr Archer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 103, 'language' => 'en', 'attribute' => 'class', 'name' => 'Tyr Warrior',          'name_short' => 'Tyr Warrior');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 104, 'language' => 'en', 'attribute' => 'class', 'name' => 'Feoh Wizard',          'name_short' => 'Feoh Wizard');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 105, 'language' => 'en', 'attribute' => 'class', 'name' => 'Othell Rogue',         'name_short' => 'Othell Rogue');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 106, 'language' => 'en', 'attribute' => 'class', 'name' => 'Iss Enchanter',        'name_short' => 'Iss Enchanter');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 107, 'language' => 'en', 'attribute' => 'class', 'name' => 'Sigel Knight',         'name_short' => 'Sigel Knight');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 108, 'language' => 'en', 'attribute' => 'class', 'name' => 'Eolh Healer',          'name_short' => 'Eolh Healer');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 109, 'language' => 'en', 'attribute' => 'class', 'name' => 'Wynn Summoner',        'name_short' => 'Wynn Summoner');

		$this->db->sql_multi_insert($this->table('bb_language_table'), $sql_ary);
	}

	/**
	 * Installs Lineage 2 races with gender images (English only)
	 */
	protected function install_races()
	{

		$this->db->sql_query('DELETE FROM ' . $this->table('bb_races_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "'");
		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 0, 'race_faction_id' => 1, 'image_female' => ' ', 'image_male' => ' ');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 1, 'race_faction_id' => 1, 'image_female' => 'lineage2_human_female', 'image_male' => 'lineage2_human_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 2, 'race_faction_id' => 1, 'image_female' => 'lineage2_elf_female', 'image_male' => 'lineage2_elf_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 3, 'race_faction_id' => 1, 'image_female' => 'lineage2_delf_female', 'image_male' => 'lineage2_delf_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 4, 'race_faction_id' => 1, 'image_female' => 'lineage2_dwarf_female', 'image_male' => 'lineage2_dwarf_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 5, 'race_faction_id' => 1, 'image_female' => 'lineage2_orc_female', 'image_male' => 'lineage2_orc_male');
		$sql_ary[] = array('game_id' => $this->game_id, 'race_id' => 6, 'race_faction_id' => 1, 'image_female' => 'lineage2_kamael_female', 'image_male' => 'lineage2_kamael_male');
		$this->db->sql_multi_insert($this->table('bb_races_table'), $sql_ary);
		unset($sql_ary);

		// race names (English only)
		$this->db->sql_query('DELETE FROM ' . $this->table('bb_language_table') . " WHERE game_id = '" . $this->db->sql_escape($this->game_id) . "' AND attribute='race' ");

		$sql_ary = array();
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 0, 'language' => 'en', 'attribute' => 'race', 'name' => 'Unknown',  'name_short' => 'Unknown');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 1, 'language' => 'en', 'attribute' => 'race', 'name' => 'Human',    'name_short' => 'Human');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 2, 'language' => 'en', 'attribute' => 'race', 'name' => 'Elf',      'name_short' => 'Elf');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 3, 'language' => 'en', 'attribute' => 'race', 'name' => 'Dark Elf', 'name_short' => 'Dark Elf');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 4, 'language' => 'en', 'attribute' => 'race', 'name' => 'Dwarf',    'name_short' => 'Dwarf');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 5, 'language' => 'en', 'attribute' => 'race', 'name' => 'Orc',      'name_short' => 'Orc');
		$sql_ary[] = array('game_id' => $this->game_id, 'attribute_id' => 6, 'language' => 'en', 'attribute' => 'race', 'name' => 'Kamael',   'name_short' => 'Kamael');
		$this->db->sql_multi_insert($this->table('bb_language_table'), $sql_ary);
	}

	/**
	 * Installs Lineage 2 specializations (issue #331).
	 *
	 * Mirrors gw2_installer's structure, but lineage2_provider::spec_catalog()
	 * is deliberately empty — see its docblock for why this game has no
	 * additional per-class spec layer to seed (its class list already goes
	 * all the way to the terminal Awakening classes). Kept as a real override
	 * (rather than relying on the no-op default) so the guard/build/insert
	 * shape is uniform across plugins and easy to fill in later if that ever
	 * changes.
	 *
	 * Skipped if bb_specializations_table isn't wired in (older core installs
	 * that haven't run migration v200b4 yet).
	 */
	protected function install_specs(): void
	{
		if (!isset($this->table_names['bb_specializations_table']))
		{
			return;
		}

		$rows = [];
		foreach (lineage2_provider::spec_catalog() as $class_id => $specs)
		{
			foreach ($specs as $spec)
			{
				$rows[] = [
					'game_id'    => $this->game_id,
					'class_id'   => (int) $class_id,
					'role_id'    => (int) $spec['role_id'],
					'spec_name'  => (string) $spec['spec_name'],
					'spec_icon'  => (string) $spec['spec_icon'],
					'spec_order' => (int) $spec['spec_order'],
				];
			}
		}
		if (!$rows)
		{
			return;
		}
		$this->db->sql_multi_insert($this->table('bb_specializations_table'), $rows);
	}
}
