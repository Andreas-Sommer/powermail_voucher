<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        if (TYPO3_MODE == "BE")
        {
            /** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
            $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                \TYPO3\CMS\Core\Page\PageRenderer::class
            );
            $pageRenderer->loadRequireJsModule('TYPO3/CMS/PowermailVoucher/Module/List');
        }

        $container = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Extbase\Object\Container\Container::class
        );
        $container
            ->registerImplementation(
                \In2code\Powermail\Domain\Model\Field::class,
                \Belsignum\PowermailVoucher\Domain\Model\Field::class
            );

        $container->registerImplementation(
            \In2code\Powermail\Domain\Model\Mail::class,
            \Belsignum\PowermailVoucher\Domain\Model\Mail::class
        );
    }
);

