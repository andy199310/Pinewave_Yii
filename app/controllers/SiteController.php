<?php
/**
 * Created by IntelliJ IDEA.
 * User: Green
 * Date: 2013/7/26
 * Time: 下午 9:29
 */

class SiteController extends CController{

	public $layout = 'site';

	public function init(){
		$this->pageTitle=Yii::app()->name . '';
	}


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

		$scheduleModel = new ScheduleModel;

		$data['nextProgram'] = $scheduleModel->firstOnAir()->with('data')->find(array('condition' => '`datetime` > NOW()', 'order' => '`datetime` ASC' ));
		$data['previousProgram'] = $scheduleModel->firstOnAir()->with('data')->find(array('condition' => '`datetime` < NOW()', 'order' => '`datetime` DESC'));

		$bulletinModel = new BulletinModel;
		$data['bulletinData'] = $bulletinModel->findAll(array('order' => '`id` DESC', 'limit' => '5'));
		$this->render('index', $data);

//		print_r($data['nextProgram']);
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
			$data['data'] = $bulletinModel->findByPk($data['id']);
			$this->render('bulletin', $data);
		}
	}

	public function actionProgram(){
		$select = Yii::app()->request->getParam('id');
//		$scheduleModel = new ScheduleModel;
//		$leftData['programsCommon'] = $scheduleModel->firstOnAir()->with('ScheduleLeftData')->findAll(array('limit' => '10', 'order' => 'sid DESC', 'params' => array(':class' => '9')));
//		$leftData['programsDJFree'] = $scheduleModel->firstOnAir()->with('ScheduleLeftData')->findAll(array('limit' => '10', 'order' => 'sid DESC', 'params' => array(':class' => '10')));
//		$leftData['programsEvent'] = $scheduleModel->firstOnAir()->with('ScheduleLeftData')->findAll(array('limit' => '10', 'order' => 'sid DESC', 'params' => array(':class' => '8')));

		$programData = new ProgramData;
		$leftData['programsCommon'] = $programData->findAll(array('order' => 'id DESC', 'limit' => '10', 'condition' => 'class=:class', 'params' => array(':class' => '1')));
		$leftData['programsDJFree'] = $programData->findAll(array('order' => 'id DESC', 'limit' => '10', 'condition' => 'class=:class', 'params' => array(':class' => '2')));
		$leftData['programsEvent'] = $programData->findAll(array('order' => 'id DESC', 'limit' => '5', 'condition' => 'class=:class', 'params' => array(':class' => '3')));

		$data['programLeft'] = $this->renderPartial('_program_left', $leftData, true);

		if($select == NULL){
			$scheduleModel = new ScheduleModel;
			$data['monthData'] = $scheduleModel->firstOnAir()->monthly()->with('data')->findAll(array('order' => '`datetime` ASC'));

			$this->render('program_schedule', $data);
		}else{
			$programData = new ProgramData;

			$data['programData'] = $programData->findByPk($select);


			if($data['programData'] != NULL){

				$data['programChooseData'] =  $programData->with('VolumeChooseData')->findByPk($select);
				$this->render('program_one', $data);

			}else{
				$this->redirect('/index.php/program');
			}
		}
	}

	public function actionAjaxSchedule(){
		$data['year'] = Yii::app()->request->getPost('y');
		$data['month'] = Yii::app()->request->getPost('m');


		if($data['year'] != NULL && $data['month'] != NULL){

			$scheduleModel = new ScheduleModel;

			$y = (string)$data['year'];
			$m = (string)$data['month'];
			//$date = date("Y-m-d");

			$tmp = sprintf('%04d-%02d', $y, $m);

			$data['monthData'] = $scheduleModel->firstOnAir()->monthly()->with('data')->findAll(array('order' => '`datetime` ASC', 'params' => array(':month' => '%'.$tmp.'%')));

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
		$this->render('staff');
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