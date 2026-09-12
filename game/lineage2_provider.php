<?php
/**
 * Lineage 2 Game Provider
 *
 * @package   bbguildlineage2 v2.0
 * @copyright 2018 avathar.be
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace avathar\bbguildlineage2\game;

use avathar\bbguild\model\games\game_provider_interface;
use avathar\bbguild\model\games\specialization_provider_interface;

class lineage2_provider implements game_provider_interface, specialization_provider_interface
{
	/** @var lineage2_installer */
	private $installer;

	/** @var \phpbb\extension\manager */
	private $ext_manager;

	public function __construct(lineage2_installer $installer, \phpbb\extension\manager $ext_manager)
	{
		$this->installer = $installer;
		$this->ext_manager = $ext_manager;
	}

	public function get_game_id(): string
	{
		return 'lineage2';
	}

	public function get_game_name(): string
	{
		return 'Lineage 2';
	}

	public function get_installer(): \avathar\bbguild\model\games\game_install_interface
	{
		return $this->installer;
	}

	public function get_boss_base_url(): string
	{
		return 'http://www.lineage2-online.com/database/en/monsters/%s.php';
	}

	public function get_zone_base_url(): string
	{
		return 'http://www.lineage2-online.com/database/en/quests/%s.php';
	}

	public function get_images_path(): string
	{
		return $this->ext_manager->get_extension_path('avathar/bbguildlineage2', true) . 'images/';
	}

	public function has_api(): bool
	{
		return false;
	}

	public function get_api(): ?\avathar\bbguild\model\games\game_api_interface
	{
		return null;
	}

	public function get_regions(): array
	{
		return array(
			'us' => 'US',
			'eu' => 'EU',
		);
	}

	public function get_api_locales(): array
	{
		return array();
	}

	public function get_armor_types(): array
	{
		return array(
			'ROBE'    => 'Robes',
			'LEATHER' => 'Leather',
			'HEAVY'   => 'Heavy',
		);
	}

	/**
	 * Specialization catalog (issue #331 / bbguild #331) — deliberately empty.
	 *
	 * Lineage 2's install_classes() (see game/lineage2_installer.php) already
	 * seeds all 110 classes down to their most granular, terminal build: the
	 * 1st (lvl 20) -> 2nd (lvl 40) -> 3rd/final occupation (lvl 76) chain,
	 * AND the level-85 Awakening tier (class_id 102-109: Sigel Knight, Tyrr
	 * Warrior, Feoh Wizard, Othell Rogue, Iss Enchanter, Wynn Summoner, Yul
	 * Archer, Aeore Healer), each already its own distinct class_id. There is
	 * no further class_id-keyed "pick one of several named specs with their
	 * own role" layer beyond that in the real game:
	 *
	 * - The only other post-3rd-class system, the Talent Tree (Power /
	 *   Mastery / Protection branches unlocked at level 80), is a universal
	 *   point-buy tree identical for every class — not a named per-class
	 *   spec choice, so it doesn't fit this interface's per-class catalog
	 *   shape (spec_name/role_id varying by class_id).
	 * - "Subclass" / dual class is a parallel alt-character system (add
	 *   entire additional classes to level up separately on the same
	 *   character), not a specialization of the main class.
	 *
	 * So this plugin has genuinely nothing to seed here — an honestly empty
	 * catalog, not a gap. Per the interface's own docblock: "Plugins that
	 * already seeded specs return []."
	 *
	 * @return array<int, list<array{spec_name:string,role_id:int,spec_icon:string,spec_order:int}>>
	 */
	public static function spec_catalog(): array
	{
		return array();
	}

	/**
	 * @inheritdoc
	 */
	public function get_spec_label(): string
	{
		return 'Specialization';
	}

	/**
	 * Interface implementation: delegates to the static (empty) catalog.
	 *
	 * @return array<int, list<array{spec_name:string,role_id:int,spec_icon:string,spec_order:int}>>
	 */
	public function get_specializations(): array
	{
		return self::spec_catalog();
	}
}
