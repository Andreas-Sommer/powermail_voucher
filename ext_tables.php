<?php
defined('TYPO3') || die('Access denied.');

call_user_func(
    function() {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            "@import 'EXT:powermail_voucher/Configuration/TsConfig/config.tsconfig'"
        );
    }
);
