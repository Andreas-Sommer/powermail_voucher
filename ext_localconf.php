<?php
if (TYPO3_MODE=="BE" ) {
	/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
	$pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
	$pageRenderer->loadRequireJsModule('TYPO3/CMS/PowermailVoucher/Module/List');
	$pageRenderer->addCssLibrary('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
}
