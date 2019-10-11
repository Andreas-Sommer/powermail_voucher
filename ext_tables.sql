#
# Table structure for table 'tx_powermailvoucher_domain_model_campaign'
#
CREATE TABLE tx_powermailvoucher_domain_model_campaign (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
	hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

#
# Table structure for table 'tx_powermailvoucher_domain_model_voucher'
#
CREATE TABLE tx_powermailvoucher_domain_model_voucher (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	code varchar(255) DEFAULT '' NOT NULL,
	campaign int(11) unsigned DEFAULT '0',
	mail int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)

);

#
# Table structure for table 'tx_powermail_domain_model_field'
#
CREATE TABLE tx_powermail_domain_model_field (
	tx_powermailvoucher_campaign int(11) unsigned DEFAULT '0',
);

#
# Table structure for table 'tx_powermail_domain_model_mail'
#
CREATE TABLE tx_powermail_domain_model_mail (
	tx_powermailvoucher_voucher int(11) unsigned DEFAULT '0',
);
