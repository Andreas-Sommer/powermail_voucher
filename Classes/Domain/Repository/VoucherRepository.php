<?php
namespace Belsignum\PowermailVoucher\Domain\Repository;

use Belsignum\PowermailVoucher\Domain\Model\Campaign;

/***
 * This file is part of the "Voucher request with Powermail" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *  (c) 2019 Andreas Sommer <sommer@belsignum.com>, Belsignum UG
 ***/

/**
 * The repository for Vouchers
 */
class VoucherRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
	/**
	 * @param \Belsignum\PowermailVoucher\Domain\Model\Campaign $campaign
	 *
	 * @return object
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
	 */
	public function findOneUnusedByCampaign(Campaign $campaign)
	{
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('campaign', $campaign->getUid()),
				$query->equals('mail', 0)
			)
		);
		return $query->execute()->getFirst();
	}
}
