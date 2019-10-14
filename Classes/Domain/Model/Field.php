<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/**
 * Class Field
 */
class Field extends \In2code\Powermail\Domain\Model\Field
{
    /**
	 * campaign
	 *
     * @var \Belsignum\PowermailVoucher\Domain\Model\Campaign
     */
    protected $campaign = null;

	/**
	 * @return \Belsignum\PowermailVoucher\Domain\Model\Campaign
	 */
	public function getCampaign(
	): ?\Belsignum\PowermailVoucher\Domain\Model\Campaign
	{
		return $this->campaign;
	}

	/**
	 * @param \Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign
	 */
	public function setCampaign(
		\Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign
	): void {
		$this->campaign = $campaign;
	}
}
