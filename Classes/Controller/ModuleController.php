<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 12:40
 */

namespace Belsignum\PowermailVoucher\Controller;


use TYPO3\CMS\Core\Messaging\AbstractMessage;

class ModuleController extends AbstractController
{
	public function listAction()
	{
		$campaigns = $this->campaignRepository->findAll();
		if(
			$this->request->hasArgument('campaign')
			&& !\is_array($this->request->getArgument('campaign'))
		)
		{
			$campaign = $this->campaignRepository->findByUid($this->request->getArgument('campaign'));
		}

		$this->view->assignMultiple([
			'campaigns' => $campaigns,
			'campaign' => $campaign
		]);
	}

	/**
	 * import bulk data
	 *
	 * @return void
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	public function importAction()
	{
		$pid = (int) $GLOBALS['_GET']['id'];
		$campaigns = $this->campaignRepository->findAll();
		$this->view->assign('campaigns', $campaigns);

		if($this->request->hasArgument('campaign'))
		{
			if(!$this->request->hasArgument('fileupload'))
			{
				$this->addFlashMessage('No file to import!', 'Error', AbstractMessage::ERROR);
				$this->redirect('import');
			}

			$tmpFile = $_FILES['tx_powermailvoucher_web_powermailvouchervoucher']['tmp_name']['fileupload']['file'];
			$content = file_get_contents($tmpFile);
			$codes = str_getcsv($content, \chr(10));

			$this->voucherRepository->import(
				$codes,
				$this->request->getArgument('campaign'),
				$pid
			);

			$this->addFlashMessage('Import complete', 'Success', AbstractMessage::OK);
		}
	}




}
