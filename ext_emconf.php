<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Voucher code request with Powermail.',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Andreas Sommer',
    'author_email' => 'sommer@belsignum.com',
    'state' => 'beta',
    'version' => '10.0.3',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
			'powermail' => '12.4.4-12.9.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
