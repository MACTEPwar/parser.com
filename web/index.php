<?php

// comment out the following two lines when deployed to production
//ini_set('session.gc_maxlifetime', 120960);
//ni_set('session.cookie_lifetime', 120960);
//ini_set('session.save_path', __DIR__.'/../sessions/');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
