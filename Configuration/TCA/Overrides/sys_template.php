<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
defined('TYPO3_MODE') or die();

/**
 * Add static file
 */
ExtensionManagementUtility::addStaticFile(
	'Belsignum.powermail_voucher',
	'Configuration/TypoScript',
	'Powermail Voucher'
);
