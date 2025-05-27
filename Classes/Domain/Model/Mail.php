<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/**
 * Class Mail
 */
class Mail extends \In2code\Powermail\Domain\Model\Mail
{
    /**
	 * @var Voucher
	 */
    protected $voucher = null;

    /**
     * @return Voucher
     */
    public function getVoucher(
	): Voucher {
        return $this->voucher;
    }

    /**
     * @param Voucher $voucher
     */
    public function setVoucher(
        Voucher $voucher
    ): void {
        $this->voucher = $voucher;
    }
}
