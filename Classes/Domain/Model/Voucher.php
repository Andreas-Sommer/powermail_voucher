<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/***
 *
 * This file is part of the "Voucher request with Powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Andreas Sommer <sommer@belsignum.com>, Belsignum UG
 *
 ***/

/**
 * Voucher
 */
class Voucher extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * code
     *
     * @var string
     * @validate NotEmpty
     */
    protected $code = '';

    /**
     * campaign
     *
     * @var \Belsignum\PowermailVoucher\Domain\Model\Campaign
     */
    protected $campaign = null;

    /**
     * mail
     *
     * @var \In2code\Powermail\Domain\Model\Mail
     */
    protected $mail = null;

    /**
     * Returns the code
     *
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the code
     *
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Returns the campaign
     *
     * @return \Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Sets the campaign
     *
     * @param \Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign
     * @return void
     */
    public function setCampaign(\Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

	/**
	 * @return \In2code\Powermail\Domain\Model\Mail
	 */
	public function getMail(): \In2code\Powermail\Domain\Model\Mail
	{
		return $this->mail;
	}

	/**
	 * @param \In2code\Powermail\Domain\Model\Mail $mail
	 */
	public function setMail(\In2code\Powermail\Domain\Model\Mail $mail): void
	{
		$this->mail = $mail;
	}


}
