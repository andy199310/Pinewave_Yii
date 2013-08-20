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

		$eventData = Yii::app()->params['event'];

		if($eventData['active'] == true){
			if(Yii::app()->session['event_visit_time'] == NULL){
				Yii::app()->session['event_visit_time'] = time();
				$this->redirect($eventData['url']);
			}else if(Yii::app()->session['event_visit_time'] + $eventData['again_time'] < time()){
				Yii::app()->session['event_visit_time'] = time();
				$this->redirect($eventData['url']);
			}
		}
		$programModel = new ProgramModel;
		$data['nextProgram'] = $programModel->getProgramDetailByProgramId($programModel->getNextProgramId()['program']);
		$data['previousProgram'] = $programModel->getProgramDetailByProgramId($programModel->getPreviousProgramId()['program']);
		$bulletinModel = new BulletinModel;
		$data['bulletinData'] = $bulletinModel->getBulletinMainByCount();
		$this->render('index', $data);
	}

	public function actionAbout(){
		$this->render('about');
	}

	public function actionBulletin(){
		$data['id'] = Yii::app()->request->getParam('id');
		if($data['id'] == NULL){
			$this->redirect('/');
		}else{
			$bulletinModel = new BulletinModel;
			$data['data'] = $bulletinModel->getBulletinDataById($data['id']);
			$this->render('bulletin', $data);
		}
	}

	public function actionProgram(){
		$select = Yii::app()->request->getParam('id');
		if($select == NULL){

			$data['programLeft'] = $this->renderPartial('_program_left', NULL, true);
			$this->render('program_schedule', $data);
		}else{
			$programModel = new ProgramModel;
			$data['programData'] = $programModel->getProgramDetailByProgramId($select);
			$data['programChooseData'] = $programModel->getProgramOnAirList($select);
			$data['programLeft'] = $this->renderPartial('_program_left', NULL, true);
			$this->render('program_one', $data);
		}
	}

	public function actionAjaxSchedule(){
		$data['year'] = Yii::app()->request->getPost('y');
		$data['month'] = Yii::app()->request->getPost('m');

		if($data['year'] != NULL && $data['month'] != NULL){
			$this->renderPartial('_schedule', $data);
		}else{
			//error
		}
	}

	public function actionBoard(){
		$boardModel = new BoardModel;
		$data['boardData'] = $boardModel->getBoardData();
		$data['boardModel'] = $boardModel;
		$data['display'] = 10;
		$data['page'] = Yii::app()->request->getParam('id');
		if($data['page'] == NULL){
			$data['page'] = 1;
		}
		$this->render('board', $data);
	}

	public function actionStaff(){
		$this->render('about');
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