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

class VoucherUtility
{
	/**
	 * Get voucher field
	 *
	 * @param Mail $mail
	 *
	 * @return Field|null
	 */
	public static function getVoucherField(Mail $mail): ?Field
	{
		$fields = $mail->getForm()->getFields();

		/**
		 * @var Field $field
		 */
		foreach ($fields as $_ => $field)
		{
			if($field->getType() === 'voucher_campaign')
			{
				return $field;
			}
		}
		return NULL;
	}
}
