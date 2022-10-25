<?php
namespace Belsignum\PowermailVoucher\Domain\Model;

/***
 * This file is part of the "Voucher request with Powermail" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Andreas Sommer <sommer@belsignum.com>, Belsignum UG
 ***/
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Campaign
 */
class Campaign extends AbstractEntity
{
    /**
	 * title
	 *
	 * @var string
	 * @Extbase\Validate("NotEmpty")
	 */
	protected $title = '';

	/**
	 * @var ObjectStorage<Voucher>
	 */
	protected $vouchers;

	/**
	 * __construct
	 */
	public function __construct()
	{
		$this->initializeObject();
	}

	/**
	 * Initializes all \TYPO3\CMS\Extbase\Persistence\ObjectStorage properties.
	 *
	 * @return void
	 */
	public function initializeObject(): void
	{
		$this->setVouchers(new ObjectStorage);
	}

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle(): string
	{
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

	/**
	 * @return ObjectStorage<Voucher>
	 */
	public function getVouchers(): ObjectStorage
	{
		return $this->vouchers;
	}

	/**
	 * @param ObjectStorage<Voucher> $vouchers
	 */
	public function setVouchers(
		ObjectStorage $vouchers
	): void {
		$this->vouchers = $vouchers;
	}


}
