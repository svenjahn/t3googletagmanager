<?php

namespace VV\t3googletagmanager\Controller;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class GoogleTagmanagerController extends ActionController
{
    /**
     * @param array $parameter
     */
    public function writeConfiguration(array $parameter)
    {
        if (TYPO3_MODE === 'FE' && $this->getTagmanagerId() !== '') {
            $this->getPageRenderer()->addJsFooterInlineCode('t3googletagmanager-configuration', "
              var googleTagmanagerId = '" . $this->getTagmanagerId() . "',
                googleTagmanagerDisabledCookie = 'google-analytics-disable-' + googleTagmanagerId;

              // Function to disable Google Analytics
              var googleTagmanagerDisable = function() {
                document.cookie = googleTagmanagerDisabledCookie + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                window[googleTagmanagerDisable] = true;
              };

              // Function to enable Google Analytics
              var googleTagmanagerEnable = function() {
                document.cookie = googleTagmanagerDisabledCookie + '=true; expires=Thu, 01 Jan 1970 00:00:01 UTC; path=/';
                window[googleTagmanagerDisable] = false;
              };

              // Load and start Google Analytics if not disabled
              if (document.cookie.indexOf(googleTagmanagerDisabledCookie + '=true') === -1) {
                (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer', googleTagmanagerId);
                
                googleTagmanagerScript.src = 'https://www.googletagmanager.com/ns.html?id=' + googleTagmanagerId;
                document.head.appendChild(googleTagmanagerScript);
              }
            ");
        }
    }

    /**
     * @return string
     */
    protected function getTagmanagerId(): string
    {
        $trackingId = '';
        $tsfe = $this->getTypoScriptFrontendController();
        $sysTemplate = $tsfe->cObj->getRecords('sys_template', [
            'pidInList' => $tsfe->cObj->getData('leveluid:0'),
            'max' => 1,
        ]);

        if (isset($sysTemplate[0]['google_tagmanager_id'])) {
            $trackingId = $sysTemplate[0]['google_tagmanager_id'];
        }

        return $trackingId;
    }

    /**
     * @return PageRenderer
     */
    protected function getPageRenderer(): PageRenderer
    {
        return GeneralUtility::makeInstance(PageRenderer::class);
    }

    /**
     * @return TypoScriptFrontendController
     */
    protected function getTypoScriptFrontendController(): TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'] ?? GeneralUtility::makeInstance(TypoScriptFrontendController::class);
    }
}
