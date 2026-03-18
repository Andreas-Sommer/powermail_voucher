<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 12:40
 */

namespace Belsignum\PowermailVoucher\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;

class ModuleController extends AbstractController
{
    /**
     * @return void
     * @throws NoSuchArgumentException
     */
    public function listAction(): ResponseInterface
    {
        $moduleTemplate = $this->createModuleTemplate();
        $moduleTemplate->setTitle(
            $this->getLanguageService()->sL(
                'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang.xlf:tx_powermailvoucher_backend.voucher_list'
            )
        );

        $campaign = null;
        $campaigns = $this->campaignRepository->findAll();
        if (
            $this->request->hasArgument('campaign')
            && !\is_array($this->request->getArgument('campaign'))
        ) {
            $campaign = $this->campaignRepository->findByUid($this->request->getArgument('campaign'));
        }

        $moduleTemplate->assignMultiple([
        	'campaigns' => $campaigns,
        	'campaign' => $campaign
        ]);
        return $moduleTemplate->renderResponse('Module/List');
    }

    /**
     * import bulk data
     *
     * @return ResponseInterface
     * @throws NoSuchArgumentException
     */
    public function importAction(): ResponseInterface
    {
        $moduleTemplate = $this->createModuleTemplate();
        $moduleTemplate->setTitle(
            $this->getLanguageService()->sL(
                'LLL:EXT:powermail_voucher/Resources/Private/Language/locallang.xlf:tx_powermailvoucher_backend.import'
            )
        );

        $request = $GLOBALS['TYPO3_REQUEST'] ?? null;
        $pid = 0;
        if ($request instanceof ServerRequestInterface) {
            $pid = (int)($request->getQueryParams()['id'] ?? 0);
        }
        $campaigns = $this->campaignRepository->findAll();
        $moduleTemplate->assign('campaigns', $campaigns);

        if ($this->request->hasArgument('campaign'))
        {
            $content = $this->readUploadedCsvContent($request);
            if ($content === null) {
                $this->addFlashMessage('No file to import!', 'Error', ContextualFeedbackSeverity::ERROR);
                return $this->redirect('import');
            }
            $codes = str_getcsv($content, \chr(10));

            $this->voucherRepository->import(
                $codes,
                $this->request->getArgument('campaign'),
                $pid
            );

            $this->addFlashMessage('Import complete', 'Success', ContextualFeedbackSeverity::OK);
        }

        return $moduleTemplate->renderResponse('Module/Import');
    }

    private function readUploadedCsvContent(?ServerRequestInterface $request): ?string
    {
        if (!$request instanceof ServerRequestInterface) {
            return null;
        }
        $uploadedFile = $request->getUploadedFiles()['file'] ?? null;
        if (!$uploadedFile instanceof UploadedFileInterface || $uploadedFile->getError() !== \UPLOAD_ERR_OK) {
            return null;
        }
        $stream = $uploadedFile->getStream();
        $stream->rewind();
        $content = $stream->getContents();
        return $content !== '' ? $content : null;
    }
}
