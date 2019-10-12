<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 10:56
 */

namespace Belsignum\PowermailVoucher\Domain\Validator;

use Belsignum\PowermailVoucher\Utility\VoucherUtility;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use In2code\Powermail\Domain\Validator\AbstractValidator;
use Belsignum\PowermailVoucher\Domain\Model\Mail;
use In2code\Powermail\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Error\Error;
use TYPO3\CMS\Extbase\Error\Result;

class VoucherValidator extends AbstractValidator
{
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
	 * validate
	 *
	 * @param Mail $mail
	 * @return Result
	 */
	public function validate($mail)
	{
		$result = new Result();
		if($voucherField = VoucherUtility::getVoucherField($mail))
		{
			/** @var \Belsignum\PowermailVoucher\Domain\Model\Voucher $voucher */
			$voucher = $this->voucherRepository->findOneUnusedByCampaign($voucherField->getCampaign());
			if(!$voucher)
			{
				$msg = LocalizationUtility::translate('tx_powermailvoucher_error.exceeds_vouchers', 'powermail_voucher');
				$result->addError(
					new Error($msg, $voucherField->getMarker())
				);
			}
		}
		return $result;
	}
}
