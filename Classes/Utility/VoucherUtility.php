<?php
/**
 * Created by PhpStorm.
 * User: Andreas Sommer
 * Date: 12.10.2019
 * Time: 11:02
 */

namespace Belsignum\PowermailVoucher\Utility;

use In2code\Powermail\Domain\Model\Mail;

class VoucherUtility
{
	/**
	 * Get voucher field
	 *
	 * @param \In2code\Powermail\Domain\Model\Mail $mail
	 *
	 * @return \Belsignum\PowermailVoucher\Domain\Model\Field|null
	 */
	public static function getVoucherField(Mail $mail)
	{
		$fields = $mail->getForm()->getFields();

		/**
		 * @var \Belsignum\PowermailVoucher\Domain\Model\Field $field
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
