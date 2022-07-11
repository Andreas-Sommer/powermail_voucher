<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
$tempPowermailvoucherMailColumns = [
	'tx_powermailvoucher_voucher' => [
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_mail.voucher',
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_powermailvoucher_domain_model_voucher',
			'foreign_field' => 'mail',
			'minitems' => 0,
			'maxitems' => 1,
		]
	],
];
ExtensionManagementUtility::addTCAcolumns('tx_powermail_domain_model_mail', $tempPowermailvoucherMailColumns);
ExtensionManagementUtility::addToAllTCAtypes(
	'tx_powermail_domain_model_mail',
	'--div--;LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_mail.voucher, tx_powermailvoucher_voucher',
	'',
	'after:user_agent'
);
