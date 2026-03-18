<?php

declare(strict_types=1);

return [
    'system_txpowermailvoucher' => [
        'parent' => 'system',
        'position' => ['after' => '*'],
        'access' => 'user',
        'iconIdentifier' => 'powermail-voucher-module',
        'labels' => 'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'PowermailVoucher',
        'controllerActions' => [
            \Belsignum\PowermailVoucher\Controller\ModuleController::class => ['list', 'import'],
        ],
    ],
];
