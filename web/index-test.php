<?php
// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Dotenv::load(dirname(__DIR__));
Dotenv::required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','YII_DEBUG']);

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV'));


$config = require(__DIR__ . '/../tests/codeception/config/acceptance.php');

(new yii\web\Application($config))->run();
