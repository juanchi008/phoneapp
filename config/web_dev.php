<?php

$params = require(__DIR__ . '/params_dev.php');

$config = [
    'id' => 'app',
    'name' => 'Phone Directory',
    'version' => '1.0',
	// Preload the Debug Module
    'basePath' => dirname(__DIR__),
//	'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),
    'bootstrap' => [
    	'log',
    	'debug',
    	'gii',
	],
	'language'=>'es',
    'components' => [
		// UrlManager

		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			
			// Disable index.php
			'showScriptName' => false,
			
			// Disable r= routes
			'enablePrettyUrl' => true,
				
			//'rules' => [],
		],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '3Gz1z1lTCfSPoe6k_orbeX7fNzIrnvaN',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Identity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],                    
    	'fn' => [
            'class' => 'app\components\Fn',
    	],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                ],
            ],
        ],
    		/*
		'pdf' => [
	        'class' => Pdf::classname(),
	        'format' => Pdf::FORMAT_A4,
	        'orientation' => Pdf::ORIENT_PORTRAIT,
	        'destination' => Pdf::DEST_BROWSER,
	        // refer settings section for all configuration options
		],
		*/
        'db' => require(__DIR__ . '/db_dev.php'),
    ],

	// Modules
	'modules' => [
		'debug' => [
	        'class' => 'yii\debug\Module',
	    ],
		'gii'   => [
	        'class' => 'yii\gii\Module',
			'allowedIPs' => ['127.0.0.1', '::1', '10.1.1.*', '192.168.56.*', '184.163.110.10'],
	    ],
	],
    'params' => $params,
];
/*
if (YII_ENV_DEV) {
	
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1', '::1', '10.1.1.*', '184.163.110.10'],
    ];
}
*/

return $config;
