<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'译点通在线翻译',
    'language'=>'zh_cn',
    'timeZone'=>'Asia/Shanghai',
    'theme'=>'2013ydt',

    'defaultController'=>'path',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.yii-debug-toolbar.*',
        'application.extensions.yii-mail.YiiMailMessage',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
            'class'=>'WebUser',
			'allowAutoLogin'=>true,
            'loginUrl'=>array('path/login'),
		),
        'alipay'=>array(
            'class'=>'application.vendors.alipay.AlipayProxy',
            'partner'=>'2088901540450365', // your partner id
            'key'=>'eymh76re4tb8ifdw7fipz1j1da3mcma9', // your key
            'seller_email'=>'zfb@yeedt.com',
            'return_url'=>'http://www.yeedt.com/user/returnAlipay',
            'notify_url'=>'http://www.yeedt.com/user/notifyAlipay',
            'show_url'=>'http://www.yeedt.com/',
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'transportOptions' => array(
                'host' => 'smtp.gmail.com',
                'username' => 'yeedtcom@gmail.com',
                'password' => 'iol110123',
                'port' => '465',
                'encryption'=>'tls',
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false,
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
		
			'showScriptName'=>false,
			//'urlSuffix' => '/',	
		
			'rules'=>array(
			    '' => 'path/index',
                'fast' => 'path/fast',
                'why-fast' => 'path/whyFast',
                'file' => 'path/file',
                'resume' => 'path/resume',
			    'webSite' => 'path/webSite',
                'about' => 'path/about',
               	'server' => 'path/server',
                'contact' => 'path/contact',
                'example' => 'path/example',
                'login' => 'path/login',
                'logout' => 'path/logout',
                'reg' => 'path/reg',
                'panel' => 'user/panel',
		        'referral' => 'user/referral',
                'translateResult' => 'user/translateResult',
        		'orderResult' => 'user/orderResult',
                'chargeResult' => 'user/chargeResult',
                'getUserInfo' => 'user/getUserInfo',
                'panel' => 'proxy/panel',
                'getUserInfo' => 'proxy/getUserInfo',
                'referral' => 'proxy/referral',

				//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
			
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=kilangnet',
			'emulatePrepare' => true,
			'username' => 'kilangnet',
			'password' => 'p3v3c7m6',
			'charset' => 'utf8',
            'tablePrefix'=>'t_',
		),
		'errorHandler'=>array(
			// use 'path/error' action to display errors
            'errorAction'=>'path/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('127.0.0.1'),
                ),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
                    'levels'=>'trace',
                    'categories'=>'system.db.*',
                ),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);
