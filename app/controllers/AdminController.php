<?php
/**
 * User: Green
 * Date: 2013/7/26
 * Time: 下午 9:29
 */

class AdminController extends CController{

	public $layout = 'admin';

	public function actionIndex(){
		if($this->checkLogin()){

		}else{

		}
	}

	public function actionLogin(){
		if($this->checkLogin()){
			$this->redirect($this->createUrl('index'));
		}else{
			//Start login
			$user = Yii::app()->request->getPost('user');
			$pass = Yii::app()->request->getPost('pass');

			if($user != NULL && $pass != NULL){
				if($user == 'pinewave' && $pass = 'liverBroken'){
					//Login successful
					Yii::app()->user->login();
				}
			}else{
				echo 'login page';
			}
		}
	}

	public function actionLogout(){

	}

	private function checkLogin(){
		if(!Yii::app()->user->isGuest){
			return true;
		}else{
			$this->redirect('/index.php/admin/login');
		}
		return false;
	}

}