<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_template', [
    'google_tagmanager_id' => [
        'exclude' => true,
        'label' => 'LLL:EXT:t3googletagmanager/Resources/Private/Language/locallang.xlf:tx_t3googletagmanager.google_tagmanager_id',
        'config' => [
            'type' => 'input',
            'eval' => 'trim,nospace,upper'
        ]
    ],
]);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_template', '
    --div--;LLL:EXT:t3googletagmanager/Resources/Private/Language/locallang.xlf:tx_t3googletagmanager.tab_title,
        google_tagmanager_id
');
