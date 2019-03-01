<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/
	
	'mail' => [],

	'mailgun' => array(
		'domain' => 'no-responder@creditoslilipink.com',
		'secret' => 'key-54cd0847629ed9d0ba9f2908b4d00910',
	),

	'mandrill' => array(
		'secret' => 'pruebas@creditos.lilipink.com',
	),
	'stripe' => array(
		'model'  => 'User',
		'secret' => '',
	),

);
