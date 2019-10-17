<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 11.10.2019
 * Time: 16:57
 */

namespace Belsignum\PowermailVoucher\DataProcessor;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use Belsignum\PowermailVoucher\Utility\VoucherUtility;
use In2code\Powermail\DataProcessor\AbstractDataProcessor;

class RequestVoucherDataProcessor extends AbstractDataProcessor
{
	/**
	 * voucherField
	 *
	 * @var \Belsignum\PowermailVoucher\Domain\Model\Field
	 */
	protected $voucherField;

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
	 * adds a voucher code to a mail if a field of type voucher_campaign is set
	 *
	 * @return void
	 */
	public function voucherDataProcessor()
	{
		if($this->check())
		{
			$this->voucherField = VoucherUtility::getVoucherField($this->mail);
			if ($this->voucherField) {
				/** @var \Belsignum\PowermailVoucher\Domain\Model\Voucher $voucher */
				$voucher
					= $this->voucherRepository->findOneUnusedByCampaign($this->voucherField->getCampaign());
				if ( ! $voucher) {
					throw new \UnexpectedValueException('Could not find any voucher codes');
				}

				$this->mail->getAnswersByFieldUid()[$this->voucherField->getUid()]->setValue($voucher->getCode());
				$voucher->setMail($this->mail);
				$this->mail->setVoucher($voucher);
			}
		}
	}

	/**
	 * check to proceed data Processor
	 *
	 * @return bool
	 */
	protected function check()
	{
		if(
			$this->settings['main']['optin'] !== '1'
			&& $this->getActionMethodName() === 'createAction'
		)
		{
			return TRUE;
		}

		if(
			$this->settings['main']['optin'] === '1'
			&& $this->getOriginAction() === 'optinConfirm'
		   	&& $this->getActionMethodName() === 'createAction'
		)
		{
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Get origin action
	 *
	 * @return string
	 */
	protected function getOriginAction()
	{
		$request = GeneralUtility::_GET('tx_powermail_pi1');
		return $request['action'];
	}
}
