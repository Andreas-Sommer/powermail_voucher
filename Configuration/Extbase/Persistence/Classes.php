<?php

use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
return [
    Field::class => [
        'subclasses' => [
            \Belsignum\PowermailVoucher\Domain\Model\Field::class
        ],
    ],
    \Belsignum\PowermailVoucher\Domain\Model\Field::class => [
        'tableName' => 'tx_powermail_domain_model_field',
        'properties' => [
            'campaign' => [
                'fieldName' => 'tx_powermailvoucher_campaign'
            ]
        ],
    ],
    Mail::class => [
        'subclasses' => [
            \Belsignum\PowermailVoucher\Domain\Model\Mail::class
        ],
    ],
    \Belsignum\PowermailVoucher\Domain\Model\Mail::class => [
        'tableName' => 'tx_powermail_domain_model_mail',
        'properties' => [
            'voucher' => [
                'fieldName' => 'tx_powermailvoucher_voucher'
            ]
        ],
    ],
];
