# Changelog

## 2.0.0-rc2 25/07/2026
  - [DOCS] Corrected the README to match the installer's complete Goddess-of-Destruction-era dataset: 6 races (Human, Elf, Dark Elf, Dwarf, Orc, Kamael) and the 110-class awakened progression. The README had wrongly claimed 7 races including Ertheia (2014), which the plugin does not seed; race-table IDs also corrected to match the installer. (#1)

## 2.0.0-rc1 24/07/2026
  - [FIX] Migration dependency pointed at a since-removed bbguild core migration path (`basics\schema`, squashed into `v200b3` in an earlier core release) — this plugin could not install at all against current core
  - [FIX] `get_table_names()` was missing `bb_specializations_table`, which would have silently blocked any future specialization seeding (issue #331 Phase 4)
  - [FIX] `license.txt` file mode corrected to 644
  - [FIX] Stripped ICC color profiles from 104 PNG icons and 1 JPG icon (EPV compliance)
  - [CHG] Version tracking moved out of `phpbb_config` into `ext::BBGUILDLINEAGE2_VERSION`
  - [CHG] Soft-requires `avathar/bbguild >= 2.0.0-rc3`
  - [CHG] Provider return types use FQCN; removed unused `use` statements
  - [CHG] CI: unit tests now check out bbguild core alongside so plugin classes resolve core interfaces
  - [DOCS] README: fixed wrong GitHub org (bbGuild Core / Issue Tracker links pointed at `avandenberghe/bbguild` instead of `avatharbe/bbguildlineage2`), stale PHP >= 7.4.0 requirement (actual has been 8.1.0)

## 2.0.0-a1 02/03/2026
  - [NEW] Initial release as standalone phpBB extension
  - [NEW] Extracted from bbGuild core as part of the game plugin architecture
  - [NEW] Implements `game_provider_interface` — registers Lineage 2 with bbGuild via tagged services
  - [NEW] `lineage2_installer` extends `abstract_game_install` with clean array-based table names
  - [NEW] `lineage2_provider` supplies game metadata (Lineage 2 Online URLs)
  - [NEW] Game images served from plugin directory with gender-specific race images
  - [CHG] Installer uses `$this->table()` helper instead of direct property access
