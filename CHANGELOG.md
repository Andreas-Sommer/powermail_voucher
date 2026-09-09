# Changelog

## 12.0.2 - 2026-09-08

- Persist the drawn voucher: hand it to the repository (`update()`) so Extbase actually writes `mail` on the voucher record - without it the same code was handed out over and over
- Persist the voucher answer and flush the persistence session on double opt-in confirmation, where powermail neither saves the mail again nor reaches Extbase's shutdown `persistAll()` because the redirect finisher aborts the request with a `PropagateResponseException`
- Fail with a clear message instead of a fatal when the voucher field has no answer object

## 12.0.1 - 2026-03-18

- Ensure TypoScript setup is loaded in `ext_localconf.php` so voucher field partials are resolved without requiring manual static template inclusion
- Make campaign resolution resilient across mixed Powermail field subclasses (`powermail_country` / `softingtheme`) by resolving campaign UID with method and DB fallback
- Fix Extbase v12 query constraint usage (`logicalAnd` varargs instead of array)
- Harden validator/data processor repository access with lazy repository initialization to avoid null repository fatals
- Guard optional `Mail::setVoucher()` invocation for runtime compatibility with base Powermail mail model

## 12.0.0 - 2026-03-18

- Ported extension to TYPO3 v12 backend module APIs
- Replaced deprecated `ExtensionUtility::registerModule()` with `Configuration/Backend/Modules.php`
- Added icon registration in `Configuration/Icons.php`
- Migrated backend JavaScript from RequireJS to ES modules
- Added JavaScript import map in `Configuration/JavaScriptModules.php`
- Switched backend rendering to `ModuleTemplate->renderResponse()` to restore DocHeader menu and backend styling
- Fixed backend import upload handling using PSR-7 uploaded files
- Removed deprecated/removed API usage (`ObjectManager`, Extbase `Container`, `BackendTemplateView`, `StopActionException`, `GeneralUtility::_GET()`)
- Removed obsolete TYPO3 v12 calls from `ext_tables.php` (`addLLrefForTCAdescr`, `allowTableOnStandardPages`)
- Removed obsolete CSH language files
- Aligned backend templates to default template paths
