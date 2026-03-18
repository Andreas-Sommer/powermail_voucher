<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3') || die('Access denied.');

/**
 * Add static file
 */
ExtensionManagementUtility::addStaticFile(
    'powermail_voucher',
    'Configuration/TypoScript',
    'Powermail Voucher'
);
