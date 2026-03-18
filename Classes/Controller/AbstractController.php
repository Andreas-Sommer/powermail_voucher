<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 14:39
 */

namespace Belsignum\PowermailVoucher\Controller;

use TYPO3\CMS\Backend\Template\ModuleTemplate;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Belsignum\PowermailVoucher\Domain\Repository\CampaignRepository;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use TYPO3Fluid\Fluid\View\ViewInterface;

class AbstractController extends ActionController
{
    /**
     * campaignRepository
     *
     * @var CampaignRepository
     */
    protected $campaignRepository;

    /**
     * voucherRepository
     *
     * @var VoucherRepository
     */
    protected $voucherRepository;
    public function __construct(private readonly ModuleTemplateFactory $moduleTemplateFactory, private readonly PageRenderer $pageRenderer)
    {
    }

    /**
     * @return void
     */
    public function injectVoucherRepository(VoucherRepository $voucherRepository): void
    {
        $this->voucherRepository = $voucherRepository;
    }

    /**
     * @return void
     */
    public function injectCampaignRepository(CampaignRepository $campaignRepository): void
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * Set up the doc header properly here
     *
     * @param ViewInterface $view
     * @return void
     */
    protected function initializeView(ViewInterface $view): void
    {
        $this->pageRenderer->loadJavaScriptModule('@typo3/backend/modal.js');
        if ($this->request->getControllerActionName() === 'list')
        {
            $this->pageRenderer->loadJavaScriptModule('@belsignum/powermail-voucher/Module/List.js');
        }
    }

    protected function createModuleTemplate(): ModuleTemplate
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->setFlashMessageQueue($this->getFlashMessageQueue());
        $this->generateMenu($moduleTemplate);
        return $moduleTemplate;
    }

    /**
     * Generates the menu
     * @return void
     */
    protected function generateMenu(ModuleTemplate $moduleTemplate): void
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
        $menu = $moduleTemplate->getDocHeaderComponent()->getMenuRegistry()->makeMenu();
        $menu->setIdentifier('BackendUserModuleMenu');

        foreach ($menuItems as  $menuItemConfig)
        {
            if ($this->request->getControllerName() === $menuItemConfig['controller'])
            {
                $isActive = $this->request->getControllerActionName() === $menuItemConfig['action'];
            }
            else
            {
                $isActive = false;
            }
            $menuItem = $menu->makeMenuItem()
            				 ->setTitle($menuItemConfig['label'])
            				 ->setHref($this->getHref($menuItemConfig['controller'], $menuItemConfig['action']))
            				 ->setActive($isActive);
            $menu->addMenuItem($menuItem);
        }

        $moduleTemplate->getDocHeaderComponent()->getMenuRegistry()->addMenu($menu);
    }

    /**
     * Creates te URI for a backend action
     *
     *
     * @return string
     */
    protected function getHref(string $controller, string $action, array $parameters = []): string
    {
        $uriBuilder = clone $this->uriBuilder;
        $uriBuilder->setRequest($this->request);
        return $uriBuilder->reset()->uriFor($action, $parameters, $controller);
    }

    /**
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
