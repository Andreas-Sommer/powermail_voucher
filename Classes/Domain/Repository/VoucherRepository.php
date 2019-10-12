<?php
namespace Belsignum\PowermailVoucher\Domain\Repository;

use Belsignum\PowermailVoucher\Domain\Model\Campaign;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
	 */
	public function findOneUnusedByCampaign(Campaign $campaign)
	{
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$query->matching(
			$query->logicalAnd(
				$query->equals('campaign', $campaign->getUid()),
				$query->equals('mail', 0)
			)
		);
		return $query->execute()->getFirst();
	}

	/**
	 * @param array $codes
	 * @param int $campaignID
	 * @param int $pid
	 */
	public function import(array $codes, $campaignID, $pid)
	{
		$importData = [];
		foreach ($codes as $_ => $code)
		{
			$importData[] = [
				'pid' => $pid,
				'code' => $code,
				'campaign' => $campaignID
			];
		}

		$table = 'tx_powermailvoucher_domain_model_voucher';
		/** @var \TYPO3\CMS\Core\Database\Connection $databaseConnection */
		$databaseConnection = GeneralUtility::makeInstance(ConnectionPool::class)
											->getConnectionForTable($table);
		$databaseConnection->bulkInsert(
			$table,
			$importData,
			['pid', 'code', 'campaign']
		);
	}
}
