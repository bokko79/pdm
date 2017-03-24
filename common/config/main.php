<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],       
        'user' => [
            'loginUrl' => ['/user/security/login'],
            'class' => 'dektrium\user\Module',
        ], 
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@frontend/views/user',
                    '@dektrium/user/views/mail' => '@frontend/views/user/mail',
                    '@frontend/views/projects' => '@frontend/views/user/profile/projects',
                    '@frontend/views/user' => '@frontend/views/user/security',
                ],
            ],
        ],
    ],
    'modules' => [
	    'user' => [
	        'class' => 'dektrium\user\Module',
	        // overriding controllers dektrium
            'controllerMap' => [
                'recovery'      => 'frontend\controllers\RecoveryController',
                'registration'  => 'frontend\controllers\RegistrationController',
                'security'      => 'frontend\controllers\SecurityController',
                'settings'      => 'frontend\controllers\SettingsController',
                //'profile'       => 'frontend\controllers\ProfileController',
                //'bookmarks'     => 'frontend\controllers\BookmarksController',
            ],
            // overriding models dektrium
            'modelMap' => [
                //'Profile'           => 'common\models\Profile',
                'RegistrationForm'  => 'common\models\RegistrationForm',
                'SettingsForm'      => 'common\models\SettingsForm',
                'UserAccount'       => 'common\models\User',
            ],
            'mailer' => [
                'viewPath' => '@frontend/views/user/mail',
            ],
	        // you will configure your module inside this file
	        // or if need different configuration for frontend and backend you may
	        // configure in needed configs
	        'enableUnconfirmedLogin' => true,
            'enableConfirmation' => false,
	        'enablePasswordRecovery' => true,
	        'confirmWithin' => 21600,
	        'cost' => 12,
	    ],
	],
];
