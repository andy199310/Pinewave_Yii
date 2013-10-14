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

defined('WEB_BASE') or define('WEB_BASE', dirname(__FILE__));

require_once(require_once('pinewave.php'));

$white_IP = array('114.34.34.83', '140.115.232.33', "140.115.183.156", '140.115.189.100');

if(in_array($_SERVER['REMOTE_ADDR'], $white_IP) || YII_DEBUG == false ){
	$app = Yii::createWebApplication('config.php');

	Yii::import('application.extensions.YiiExcel', true);
	Yii::registerAutoloader(array('YiiExcel', 'autoload'), true);

	// Optional:
	//  As we always try to run the autoloader before anything else, we can use it to do a few
	//      simple checks and initialisations
//	PHPExcel_Shared_ZipStreamWrapper::register();
//
//	if (ini_get('mbstring.func_overload') & 2) {
//		throw new Exception('Multibyte function overloading in PHP must be disabled for string functions (2).');
//	}
//	PHPExcel_Shared_String::buildCharacterSets();

	//Now you can run application
	$app->run();


}
else{
	header( 'Location: http://radio.pinewave.tw/index.html' ) ;
}