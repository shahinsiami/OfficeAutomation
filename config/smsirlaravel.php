<?php

return [

	/* Important Settings */

	// ======================================================================
	// never remove 'web', just put your middleware like auth or admin (if you have) here. eg: ['web','auth']
	'middlewares' => ['web'],
	// you can change default route from sms-admin to anything you want
	'route' => 'sms-admin',
	// SMS.ir Web Service URL
	'webservice-url' => env('SMSIR-WEBSERVICE-URL','https://ws.sms.ir/'),
	// SMS.ir Api Key
	'api-key' => '4f849500fddae4da3d1883aa',
	// SMS.ir Secret Key
	'secret-key' => '%5781876%%@!*#&^%!@*#%5*&%^@#*&%^',
	// Your sms.ir line number
	'line-number' => '50002015042207',
	// ======================================================================
	// set true if you want log to the database
	'db-log' => true,
	// if you don't want to include admin panel routes set this to false
	'panel-routes' => true,
	/* Admin Panel Title */
	'title' => 'مدیریت پیامک ها',
	// How many log you want to show in sms-admin panel ?
	'in-page' => '15'
];
