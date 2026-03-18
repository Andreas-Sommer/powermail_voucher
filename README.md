# Powermail Voucher

TYPO3 extension to manage voucher campaigns and assign voucher codes via Powermail submissions.

## Requirements

- TYPO3 `^12.4`
- `in2code/powermail` `^12.4.4`

## TYPO3 v12 migration notes

This release migrates backend module and JavaScript integration to TYPO3 v12 APIs:

- Backend module registration moved to `Configuration/Backend/Modules.php`
- RequireJS usage replaced with ES module loading
- JavaScript import map added via `Configuration/JavaScriptModules.php`
- Backend rendering moved to `ModuleTemplate->renderResponse()`
- Deprecated/removed Extbase APIs removed (`ObjectManager`, Extbase `Container`, old backend view classes)

## Backend module

Module location: `System > Powermail Voucher`

Features:

- Voucher list by campaign
- CSV import for voucher codes
