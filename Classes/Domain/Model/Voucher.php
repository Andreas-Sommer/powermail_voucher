<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use In2code\Powermail\Domain\Model\Mail;
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
class Voucher extends AbstractEntity
{
    /**
	 * code
	 *
	 * @var string
	 * @Extbase\Validate("NotEmpty")
	 */
	protected $code = '';

    /**
	 * campaign
	 *
	 * @var Campaign
	 */
	protected $campaign = null;

    /**
	 * mail
	 *
	 * @var Mail
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
	 * @return Campaign|null $campaign
	 */
	public function getCampaign(): ?Campaign
	{
        return $this->campaign;
    }

    /**
	 * Sets the campaign
	 *
	 * @param Campaign $campaign
	 * @return void
	 */
	public function setCampaign(Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }

	/**
	 * @return Mail|null
	 */
	public function getMail(): ?Mail
	{
		return $this->mail;
	}

	/**
	 * @param Mail $mail
	 */
	public function setMail(Mail $mail): void
	{
		$this->mail = $mail;
	}

}
