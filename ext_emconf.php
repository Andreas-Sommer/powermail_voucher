<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Voucher code request with Powermail.',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Andreas Sommer',
    'author_email' => 'sommer@belsignum.com',
    'state' => 'beta',
    'version' => '10.0.2',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
			'powermail' => '8.0.0-8.9.99'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
