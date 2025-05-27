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
	 * @var Campaign
	 */
    protected $campaign = null;

    /**
     * @return Campaign
     */
    public function getCampaign(
	): ?Campaign {
        return $this->campaign;
    }

    /**
     * @param Campaign $campaign
     */
    public function setCampaign(
        Campaign $campaign
    ): void {
        $this->campaign = $campaign;
    }
}
