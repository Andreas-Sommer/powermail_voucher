<?php

$tempPowermailvoucherFieldColumns = [
	'tx_powermailvoucher_campaign' => [
		'exclude' => 1,
		'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_field.campaign',
		'config' => [
			'type' => 'select',
			'foreign_table' => 'tx_powermailvoucher_domain_model_campaign',
			'items' => [
				['LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_field.select_campaign', 0]
			],
			'default' => 0,
			'minitems' => 1,
			'maxitems' => 1
		]
	],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_powermail_domain_model_field', $tempPowermailvoucherFieldColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
	'tx_powermail_domain_model_field',
	'--div--;LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher.campaign, tx_powermailvoucher_campaign',
	'',
	'after:own_marker_select'
);
