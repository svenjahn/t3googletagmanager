<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 't3googletagmanager',
    'description' => 'An easy and basic Google Tagmanager extension for TYPO3.',
    'category' => 'fe',
    'author' => 'visuellverstehen',
    'author_email' => 'kontakt@visuellverstehen.de',
    'author_company' => 'visuellverstehen',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-9.5.99',
        ]
    ]
];
