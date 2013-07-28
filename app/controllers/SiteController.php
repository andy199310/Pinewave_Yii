<?php
/**
 * Created by IntelliJ IDEA.
 * User: Green
 * Date: 2013/7/26
 * Time: 下午 9:29
 */

class SiteController extends CController{

	public $layout = 'main';

	public function actionIndex(){
		//echo "HI";
		$this->render('index');
	}

	//Redirect to fb
	public function actionFb(){
		$this->redirect('https://www.facebook.com/pinewave');
	}

	public function actionError(){
		if($error=Yii::app()->errorHandler->error){
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}