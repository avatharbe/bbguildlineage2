# bbGuild - Lineage 2

**Current version:** 2.0.0-rc1 (release candidate)

[![Tests](https://github.com/avatharbe/bbguildlineage2/actions/workflows/tests.yml/badge.svg)](https://github.com/avatharbe/bbguildlineage2/actions/workflows/tests.yml)

Lineage 2 guilds are clans in the truest sense — castle sieges and open-world clan warfare have driven its community since launch, a very different culture from PvE raid guilds elsewhere, and one that rewards knowing exactly who's fielding what. bbguildlineage2 covers the full 110-class progression tree from base classes through to their awakened forms, all 7 races with gender-specific images, and boss/zone links straight to Lineage 2 Online. That's enough granularity to track a clan's real siege composition, not just a rough headcount.

## Features

- **Lineage 2 Classes** - 110 classes covering all class progressions from base to awakened (Human, Elf, Dark Elf, Orc, Dwarf, Kamael, Awakened)
- **Lineage 2 Races** - 7 playable races (Human, Elf, Dark Elf, Orc, Dwarf, Kamael, Ertheia) with gender-specific images
- **Factions** - Default faction
- **Database Links** - Boss and zone URLs linked to Lineage 2 Online

## Requirements

- phpBB >= 3.3.0
- PHP >= 8.1.0
- **bbGuild core** (`avathar/bbguild`) must be installed and enabled

## Installation

1. Ensure bbGuild core (`avathar/bbguild`) is installed and enabled.
2. Copy the `bbguildlineage2` folder to `/ext/avathar/bbguildlineage2/`.
3. Navigate in the ACP to `Customise -> Manage extensions`.
4. Look for `bbGuild - Lineage 2` under Disabled Extensions and click `Enable`.
5. Go to ACP > bbGuild > Games and install the **Lineage 2** game.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Find `bbGuild - Lineage 2` under Enabled Extensions and click `Disable`.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/avathar/bbguildlineage2` folder.

**Note:** Disabling the extension does not delete existing guild or player data. Your roster and player records remain intact in bbGuild core.

## Game Data

### Classes by Race (110)

| Race | IDs | Count | Examples |
|------|-----|-------|----------|
| Human | 0-29 | 30 | Fighter, Warrior, Warlord, Gladiator, Knight, Paladin, Dark Avenger, ... |
| Elf | 30-49 | 20 | Elven Fighter, Elven Knight, Temple Knight, Swordsinger, ... |
| Dark Elf | 50-69 | 20 | Dark Fighter, Palus Knight, Shillien Knight, Bladedancer, ... |
| Orc | 70-82 | 13 | Orc Fighter, Orc Raider, Destroyer, Orc Monk, Tyrant, ... |
| Dwarf | 83-89 | 7 | Dwarven Fighter, Scavenger, Bounty Hunter, Artisan, Warsmith, ... |
| Kamael | 90-101 | 12 | Kamael Soldier, Trooper, Warder, Berserker, Soul Breaker, ... |
| Awakened | 102-109 | 8 | Sigel Knight, Tyrr Warrior, Othell Rogue, Yul Archer, ... |

### Races (7)

| ID | Race |
|----|------|
| 0 | Human |
| 1 | Elf |
| 2 | Dark Elf |
| 3 | Orc |
| 4 | Dwarf |
| 5 | Kamael |
| 6 | Ertheia |

## License

[GNU General Public License v2](http://opensource.org/licenses/gpl-2.0.php)

## Links

- [bbGuild Core](https://github.com/avatharbe/bbguild)
- [Issue Tracker](https://github.com/avatharbe/bbguildlineage2/issues)
