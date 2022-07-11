<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher',
        'label' => 'code',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',

        'searchFields' => 'code,campaign,mail',
        'iconfile' => 'EXT:powermail_voucher/Resources/Public/Icons/icon.svg'
    ],
    'types' => [
        '1' => ['showitem' => 'code, campaign, mail'],
    ],
    'columns' => [
        'code' => [
            'exclude' => false,
            'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher.code',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'campaign' => [
            'exclude' => true,
            'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher.campaign',
            'config' => [
                'type' => 'select',
				'renderType' => 'selectSingle',
                'foreign_table' => 'tx_powermailvoucher_domain_model_campaign',
				'items' => [
					['LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher.select_campaign', 0]
				],
				'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
		'mail' => [
			'exclude' => true,
			'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_voucher.mail',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_powermail_domain_model_mail',
				'minitems' => 0,
				'maxitems' => 1,
			],
		],

    ],
];
