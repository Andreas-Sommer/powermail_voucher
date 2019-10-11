<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/**
 * Class Mail
 */
class Mail extends \In2code\Powermail\Domain\Model\Mail
{
    /**
     * @var \Belsignum\PowermailVoucher\Domain\Model\Voucher
     */
    protected $voucher = null;

	/**
	 * @return \Belsignum\PowermailVoucher\Domain\Model\Voucher
	 */
	public function getVoucher(
	): \Belsignum\PowermailVoucher\Domain\Model\Voucher
	{
		return $this->voucher;
	}

	/**
	 * @param \Belsignum\PowermailVoucher\Domain\Model\Voucher $voucher
	 */
	public function setVoucher(
		\Belsignum\PowermailVoucher\Domain\Model\Voucher $voucher
	): void {
		$this->voucher = $voucher;
	}
}
