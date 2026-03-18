<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 10:56
 */

namespace Belsignum\PowermailVoucher\Domain\Validator;

use Belsignum\PowermailVoucher\Domain\Model\Voucher;
use Belsignum\PowermailVoucher\Utility\VoucherUtility;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use In2code\Powermail\Domain\Validator\AbstractValidator;
use Belsignum\PowermailVoucher\Domain\Model\Mail;
use In2code\Powermail\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Error\Error;
use TYPO3\CMS\Extbase\Error\Result;

class VoucherValidator extends AbstractValidator
{
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
     * validate
     *
     * @param Mail $mail
     * @return Result
     */
    public function validate($mail): Result
    {
        $result = new Result();
        if ($voucherField = VoucherUtility::getVoucherField($mail))
        {
            $campaignUid = VoucherUtility::getCampaignUidFromField($voucherField);
            if ($campaignUid <= 0) {
                return $result;
            }
            /** @var Voucher $voucher */
            $voucher = $this->getVoucherRepository()->findOneUnusedByCampaignUid($campaignUid);
            if (!$voucher)
            {
                $msg = LocalizationUtility::translate('tx_powermailvoucher_error.exceeds_vouchers', 'powermail_voucher');
                $result->addError(
                    new Error($msg, $voucherField->getMarker())
                );
            }
        }
        return $result;
    }

    protected function isValid(mixed $value): void
    {
        // TODO: Implement isValid() method.
    }

    protected function getVoucherRepository(): VoucherRepository
    {
        if (!$this->voucherRepository instanceof VoucherRepository) {
            $this->voucherRepository = GeneralUtility::makeInstance(VoucherRepository::class);
        }
        return $this->voucherRepository;
    }
}
