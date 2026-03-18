<?php

defined('TYPO3') || die('Access denied.');

call_user_func(
    static function (): void {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
            "@import 'EXT:powermail_voucher/Configuration/TypoScript/setup.typoscript'"
        );
    }
);
