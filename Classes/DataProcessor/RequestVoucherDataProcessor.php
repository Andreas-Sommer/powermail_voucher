<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 11.10.2019
 * Time: 16:57
 */

namespace Belsignum\PowermailVoucher\DataProcessor;

use Belsignum\PowermailVoucher\Domain\Model\Field;
use Belsignum\PowermailVoucher\Domain\Model\Voucher;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use Belsignum\PowermailVoucher\Utility\VoucherUtility;
use In2code\Powermail\DataProcessor\AbstractDataProcessor;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RequestVoucherDataProcessor extends AbstractDataProcessor
{
    /**
     * voucherField
     *
     * @var Field
     */
    protected $voucherField;

    /**
     * voucherRepository
     *
     * @var VoucherRepository
     */
    protected $voucherRepository;

    /**
     * @return void
     */
    public function injectVoucherRepository(VoucherRepository $voucherRepository): void
    {
        $this->voucherRepository = $voucherRepository;
    }

    /**
     * adds a voucher code to a mail if a field of type voucher_campaign is set
     *
     * @return void
     */
    public function voucherDataProcessor(): void
    {
        if ($this->check())
        {
            $this->voucherField = VoucherUtility::getVoucherField($this->mail);
            if ($this->voucherField)
            {
                $campaignUid = VoucherUtility::getCampaignUidFromField($this->voucherField);
                if ($campaignUid <= 0) {
                    throw new \UnexpectedValueException('Could not resolve voucher campaign');
                }
                /** @var Voucher $voucher */
                $voucher
                	= $this->getVoucherRepository()->findOneUnusedByCampaignUid($campaignUid);
                if ( ! $voucher)
                {
                    throw new \UnexpectedValueException('Could not find any voucher codes');
                }

                $this->mail->getAnswersByFieldUid()[$this->voucherField->getUid()]->setValue($voucher->getCode());
                $voucher->setMail($this->mail);
                if (method_exists($this->mail, 'setVoucher')) {
                    $this->mail->setVoucher($voucher);
                }
            }
        }
    }

    /**
     * check to proceed data Processor
     *
     * @return bool
     */
    protected function check(): bool
    {
        if (
            $this->settings['main']['optin'] !== '1'
            && $this->getActionMethodName() === 'createAction'
        ) {
            return TRUE;
        }

        if (
            $this->settings['main']['optin'] === '1'
            && $this->getOriginAction() === 'optinConfirm'
		   	&& $this->getActionMethodName() === 'createAction'
        ) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Get origin action
     *
     * @return string
     */
    protected function getOriginAction(): string
    {
        $request = $GLOBALS['TYPO3_REQUEST'] ?? null;
        if (!$request instanceof ServerRequestInterface) {
            return '';
        }
        $powermailArguments = $request->getQueryParams()['tx_powermail_pi1'] ?? [];
        if (!\is_array($powermailArguments)) {
            return '';
        }
        return (string)($powermailArguments['action'] ?? '');
    }

    protected function getVoucherRepository(): VoucherRepository
    {
        if (!$this->voucherRepository instanceof VoucherRepository) {
            $this->voucherRepository = GeneralUtility::makeInstance(VoucherRepository::class);
        }
        return $this->voucherRepository;
    }
}
