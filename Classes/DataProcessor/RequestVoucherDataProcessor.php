<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 11.10.2019
 * Time: 16:57
 */

namespace Belsignum\PowermailVoucher\DataProcessor;

use Belsignum\PowermailVoucher\Domain\Repository\VoucherRepository;
use In2code\Powermail\DataProcessor\AbstractDataProcessor;

class RequestVoucherDataProcessor extends AbstractDataProcessor
{
	/**
	 * voucher campaign field
	 *
	 * @var \Belsignum\PowermailVoucher\Domain\Model\Field
	 */
	protected $vcf;

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
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 */
	public function voucherDataProcessor()
	{
		$fields = $this->mail->getForm()->getFields();

		/**
		 * @var \Belsignum\PowermailVoucher\Domain\Model\Field $field
		 */
		foreach ($fields as $_ => $field)
		{
			if($field->getType() === 'voucher_campaign')
			{
				$this->vcf = $field;
				break;
			}
		}

		if($this->vcf)
		{
			/** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
			$querySettings = $this->voucherRepository->createQuery()->getQuerySettings();
			$querySettings->setRespectStoragePage(FALSE);
			$this->voucherRepository->setDefaultQuerySettings($querySettings);

			/** @var \Belsignum\PowermailVoucher\Domain\Model\Voucher $voucher */
			$voucher = $this->voucherRepository->findOneUnusedByCampaign($this->vcf->getCampaign());
			if(!$voucher)
			{
				throw new \UnexpectedValueException('Could not find any voucher codes');
			}

			$this->mail->getAnswersByFieldUid()[$this->vcf->getUid()]->setValue($voucher->getCode());
			$voucher->setMail($this->mail);
			$this->mail->setVoucher($voucher);
		}

	}
}
