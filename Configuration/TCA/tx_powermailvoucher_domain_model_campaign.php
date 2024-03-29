<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_campaign',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,vouchers',
        'iconfile' => 'EXT:powermail_voucher/Resources/Public/Icons/icon.svg'
    ],
    'types' => [
        '1' => ['showitem' => 'title,vouchers,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,hidden,starttime,endtime'],
    ],
    'columns' => [

        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'behaviour' => [
                'allowLanguageSynchronization' => true
            ],
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
            ],
        ],

        'title' => [
            'exclude' => false,
            'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_campaign.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'vouchers' => [
            'exclude' => false,
            'label' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_db.xlf:tx_powermailvoucher_domain_model_campaign.vouchers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_powermailvoucher_domain_model_voucher',
				'foreign_field' => 'campaign',
				'appearance' => [
					'collapseAll' => 1,
					'expandSingle' => 1,
				],
            ],
        ],

    ],
];
