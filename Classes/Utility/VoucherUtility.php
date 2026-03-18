<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 11:02
 */

namespace Belsignum\PowermailVoucher\Utility;

use Belsignum\PowermailVoucher\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\DomainObjectInterface;

class VoucherUtility
{
    private const VOUCHER_CAMPAIGN = 'voucher_campaign';

    /**
     * Get voucher field
     *
     *
     * @return Field|null
     */
    public static function getVoucherField(Mail $mail): ?DomainObjectInterface
    {
        $fields = $mail->getForm()->getFields();

        /**
         * @var Field $field
         */
        foreach ($fields as $_ => $field)
        {
            if ($field->getType() === self::VOUCHER_CAMPAIGN)
            {
                return $field;
            }
        }
        return NULL;
    }

    public static function getCampaignUidFromField(object $field): int
    {
        if (method_exists($field, 'getCampaign')) {
            $campaign = $field->getCampaign();
            if (\is_object($campaign) && method_exists($campaign, 'getUid')) {
                return (int)$campaign->getUid();
            }
        }

        if (!method_exists($field, 'getUid')) {
            return 0;
        }

        $fieldUid = (int)$field->getUid();
        if ($fieldUid <= 0) {
            return 0;
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_powermail_domain_model_field');
        $campaignUid = $queryBuilder
            ->select('tx_powermailvoucher_campaign')
            ->from('tx_powermail_domain_model_field')
            ->where(
                $queryBuilder->expr()->eq(
                    'uid',
                    $queryBuilder->createNamedParameter($fieldUid, \PDO::PARAM_INT)
                )
            )
            ->executeQuery()
            ->fetchOne();

        return (int)$campaignUid;
    }
}
