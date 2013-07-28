<?php
/**
 * Created by IntelliJ IDEA.
 * User: Green
 * Date: 2013/7/26
 * Time: 下午 9:16
 */

defined('Pinewave') or define('Pinewave',true);

defined('YII_DEBUG') or define('YII_DEBUG',true);
ini_set("display_errors", "On");

defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once(require_once('pinewave.php'));

Yii::createWebApplication('config.php')->run();
