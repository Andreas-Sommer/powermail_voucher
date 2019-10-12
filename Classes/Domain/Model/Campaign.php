<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/***
 * This file is part of the "Voucher request with Powermail" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Andreas Sommer <sommer@belsignum.com>, Belsignum UG
 ***/

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Campaign
 */
class Campaign extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Belsignum\PowermailVoucher\Domain\Model\Voucher>
	 */
    protected $vouchers;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->initStorageObjects();
	}

	/**
	 * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		$this->vouchers = new ObjectStorage();
	}

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Belsignum\PowermailVoucher\Domain\Model\Voucher>
	 */
	public function getVouchers(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	{
		return $this->vouchers;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Belsignum\PowermailVoucher\Domain\Model\Voucher> $vouchers
	 */
	public function setVouchers(
		\TYPO3\CMS\Extbase\Persistence\ObjectStorage $vouchers
	): void {
		$this->vouchers = $vouchers;
	}


}
