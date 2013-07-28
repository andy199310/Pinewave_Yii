<?php

global $pinewavedb;

return array(
	'name'      => '松濤電台 Pinewave Radio',
	'basePath'  => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'app',
	'preload'   => array('log', 'security'),
	'import'    => array(
		'application.models.*',
		'application.components.*'
	),
	'components'=> array(
		'user'          => array(
			'allowAutoLogin'    => true
		),
		'session'       => array(
			'autoStart'         => true,
			'sessionName'       => 'Pinewave'
		),
		'assetManager'    => array(
			'basePath'            => dirname(__FILE__)  . DIRECTORY_SEPARATOR . 'assets'
		),
		'urlManager'    => array(
			'urlFormat'         => 'path',
			'rules'             => array(
				''                                          => array('site/index', 'urlSuffix' => ''),
				'<action:\w+>'                              => 'site/<action>',
				'<action:\w+>'                              => 'site/<action>',
				// '<controller:\w+>/<id:\d+>/<title:.+>'     => '<controller>/view',
				// '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'        => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>/<select:\w+>'    => '<controller>/<action>',
				'<controller:\w+>/<action:\w+>'                 => '<controller>/<action>'
			),
			'caseSensitive'     => true,
			'showScriptName'    => false,
			'useStrictParsing'  => true
		),
		'db'            => array(
			'connectionString'  => 'mysql:host=' . $pinewavedb['host'] . ';dbname=' . $pinewavedb['database'],
			'emulatePrepare'    => true,
			'username'          => $pinewavedb['username'],
			'password'          => $pinewavedb['password'],
			'charset'           => 'utf8',
			'tablePrefix'       => '',
			'enableParamLogging'=> true,
			'enableProfiling'   => true
		),
        'errorHandler'  => array(
            'errorAction'       => 'site/error'
        ),
		// 'security'      => array(
		//     'class'             => 'Security'
		// ),
		'log'           => array(
			'class'             => 'CLogRouter',
			'routes'            => array(
				array(
					'class'     => 'CFileLogRoute',
					'levels'    => 'trace, info, error, warning',
				)
			)
		),
	),
	'params'            => array(

	),
);
