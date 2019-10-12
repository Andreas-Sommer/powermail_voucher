<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 14:39
 */

namespace Belsignum\PowermailVoucher\Controller;

use Belsignum\PowermailVoucher\Domain\Repository\CampaignRepository;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
	/**
	 * Backend Template Container
	 *
	 * @var string
	 */
	protected $defaultViewObjectName = \TYPO3\CMS\Backend\View\BackendTemplateView::class;

	/**
	 * campaignRepository
	 *
	 * @var \Belsignum\PowermailVoucher\Domain\Repository\CampaignRepository
	 */
	protected $campaignRepository;

	/**
	 * voucherRepository
	 *
	 * @var \Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository
	 */
	protected $voucherRepository;

	/**
	 * @param \Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository $voucherRepository
	 */
	public function injectVoucherRepository(VoucherRepository $voucherRepository)
	{
		$this->voucherRepository = $voucherRepository;
	}

	/**
	 * @param \Belsignum\PowermailVoucher\Domain\Repository\CampaignRepository $campaignRepository
	 */
	public function injectCampaignRepository(CampaignRepository $campaignRepository)
	{
		$this->campaignRepository = $campaignRepository;
	}

	/**
	 * Set up the doc header properly here
	 *
	 * @param ViewInterface $view
	 * @return void
	 */
	protected function initializeView(ViewInterface $view)
	{
		/** @var BackendTemplateView $view */
		parent::initializeView($view);
		$this->generateMenu();
		if ($view instanceof BackendTemplateView) {
			$view->getModuleTemplate()->getPageRenderer()->loadRequireJsModule('TYPO3/CMS/Backend/Modal');
		}
	}

	/**
	 * Generates the action menu
	 */
	protected function generateMenu()
	{
		$menuItems = [
			'list' => [
				'controller' => 'Module',
				'action' => 'list',
				'label' => $this->getLanguageService()->sL('LLL:EXT:powermail_voucher/Resources/Private/Language/locallang.xlf:tx_powermailvoucher_backend.voucher_list')
			],
			'import' => [
				'controller' => 'Module',
				'action' => 'import',
				'label' => $this->getLanguageService()->sL('LLL:EXT:powermail_voucher/Resources/Private/Language/locallang.xlf:tx_powermailvoucher_backend.import')
			],
		];
		$uriBuilder = $this->objectManager->get(UriBuilder::class);
		$uriBuilder->setRequest($this->request);

		$menu = $this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
		$menu->setIdentifier('BackendUserModuleMenu');

		foreach ($menuItems as  $menuItemConfig) {
			if ($this->request->getControllerName() === $menuItemConfig['controller']) {
				$isActive = $this->request->getControllerActionName() === $menuItemConfig['action'] ? true : false;
			} else {
				$isActive = false;
			}
			$menuItem = $menu->makeMenuItem()
							 ->setTitle($menuItemConfig['label'])
							 ->setHref($this->getHref($menuItemConfig['controller'], $menuItemConfig['action']))
							 ->setActive($isActive);
			$menu->addMenuItem($menuItem);
		}

		$this->view->getModuleTemplate()->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
	}


	/**
	 * Creates te URI for a backend action
	 *
	 * @param string $controller
	 * @param string $action
	 * @param array $parameters
	 * @return string
	 */
	protected function getHref($controller, $action, $parameters = [])
	{
		$uriBuilder = $this->objectManager->get(UriBuilder::class);
		$uriBuilder->setRequest($this->request);
		return $uriBuilder->reset()->uriFor($action, $parameters, $controller);
	}

	/**
	 * @return LanguageService
	 */
	protected function getLanguageService()
	{
		return $GLOBALS['LANG'];
	}
}
