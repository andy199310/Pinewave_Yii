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
			$data['none'] = '';
			$this->render('index', $data);
		}else{

		}
	}

	public function actionBulletin(){
		if($this->checkLogin()){
			$this->render('bulletin');
		}
	}

	//節目們頁面
	public function actionPrograms(){
		if($this->checkLogin()){
			$data['id'] = Yii::app()->request->getParam('id');
			$from = 0;
			if($data['id'] == NULL){
				$from = $data['id'] * 10;
			}

			$programData = new ProgramData;
			$data['programsData'] = $programData->findAll(array('order' => 'id DESC'));

			$this->render('programs', $data);
		}
	}

	//加節目
	public function actionAddProgram(){
		if($this->checkLogin()){
			$addData = new ProgramData('add');

			if(isset($_POST['ProgramData'])){
				$addData->attributes = $_POST['ProgramData'];

				if($addData->save()){
					$this->redirect('/index.php/admin/program/'.$addData->primaryKey);
					Yii::app()->end();
				}


				//$this->redirect('/index.php/admin/programs');
			}

			$data['model'] = $addData;
			$this->render('addProgram', $data);
		}
	}

	//小節目頁面
	public function actionProgram(){
		if($this->checkLogin()){
			$data['id'] = Yii::app()->request->getParam('id');

			if($data['id'] != NULL){
				$programData = new ProgramData;
				$data['programData'] = $programData->with('volume')->findByPk($data['id']);
				if($data != NULL){
					$this->render('program', $data);
				}else{
					$this->redirect('admin/programs');
				}
			}else{
				$this->redirect('admin/programs');
			}


			echo "小節目頁面";
		}
	}

	//加小集
	public function actionAddVolume(){
		if($this->checkLogin()){
			$data['pid'] = Yii::app()->request->getParam('id');

			if($data['pid'] != NULL){


				$volumeData = new VolumeModel('add');
				$volumeData->pid = $data['pid'];
				$scheduleData = new ScheduleModel('new_volume');



				if(isset($_POST['VolumeModel']) && isset($_POST['ScheduleModel'])){


					$volumeData->attributes = $_POST['VolumeModel'];
					$scheduleData->attributes = $_POST['ScheduleModel'];

					$valid = $volumeData->validate();
					$valid = $valid && $scheduleData->validate();

					if($valid){
						$volumeData->save(false);
						$scheduleData->vid = $volumeData->primaryKey;
						$scheduleData->first = 1;
						$scheduleData->save(false);


						$newData = new ScheduleModel('new_volume');
						$newData->attributes = $_POST['ScheduleModel'];
						$newData->first = 0;
						$newData->vid = $volumeData->primaryKey;
						$tmpTime = strtotime($newData->datetime)+3600;
						$newData->datetime = date('Y-m-d H:i:s', $tmpTime);
						$newData->save(false);

						$newData = new ScheduleModel('new_volume');
						$newData->attributes = $_POST['ScheduleModel'];
						$newData->first = 0;
						$newData->vid = $volumeData->primaryKey;
						$tmpTime = strtotime($newData->datetime)+604800;
						$newData->datetime = date('Y-m-d H:i:s', $tmpTime);
						$newData->save(false);

						$this->redirect('/index.php/admin/volume/'.$volumeData->primaryKey);
						Yii::app()->end();
					}



				}

				$data['model'] = $volumeData;
				$data['scheduleModel'] = $scheduleData;
				$this->render('addVolume', $data);

			}else{
				echo "ERROR(代號：274)";
			}
		}
	}

	//小集頁面
	public function actionVolume(){
		if($this->checkLogin()){
			$data['vid'] = Yii::app()->request->getParam('id');
			if($data['vid'] != NULL){
				$volumeModel = new VolumeModel;
				$data['volumeData'] = $volumeModel->with('ProgramData', 'FirstOnAirTime')->findByPk($data['vid']);
				$data['volumeReplayData'] = $volumeModel->with('ReplayOnAirTime')->findByPk($data['vid']);
				$this->render('volume', $data);
			}else{
				$this->redirect('/index.php/admin/programs');
			}
		}
	}

	//上傳頁
	public function actionUploadVolume(){
		if($this->checkLogin()){
			$data['vid'] = Yii::app()->request->getParam('id');

			if($data['vid'] != NULL){
				$model = new FileModel;
				if(isset($_POST['FileModel'])){
					$model->attributes = $_POST['FileModel'];
					$model->file = CUploadedFile::getInstance($model, 'file');

					if($model->save()){
						$model->file->saveAs(Yii::app()->params['programFilePath'] . $data['vid'] . '.mp3');
						$volumeModel = new VolumeModel;
						$volume = $volumeModel->findByPk($data['vid']);
						$volume->uploaded = 1;
						$volume->save();

						$this->redirect(array('admin/volume', 'id'=>$data['vid']));

						Yii::app()->end();
					}
				}
				$this->render('uploadVolume', array('model' => $model));
			}else{
				$this->redirect(array('admin/programs'));
			}
		}
	}

	public function actionLogin(){
		if($this->checkLogin()){
			$this->redirect('/index.php/admin/index');
		}else{
			$this->layout = 'site';
			//Start login
			$user = Yii::app()->request->getPost('user');
			$pass = Yii::app()->request->getPost('pass');

			if($user != NULL && $pass != NULL){
				$identity=new PinewaveUserIdentity($user, $pass);
				if($identity->authenticate()){
					Yii::app()->user->login($identity);
					$this->redirect('/index.php/admin/index');
				}
				else{
					$data['errorMsg'] = '帳號或密碼錯誤';
					$this->render('login', $data);
				}
			}else{
				$data['errorMsg'] = '';
				$this->render('login', $data);
			}
		}
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/index.php/admin/index');
	}

	public function actionTest(){

		$this->redirect(array('admin/volume', 'id'=>'5480'));
//		$model = new VolumeModel();
//		$data = $model->with('OnAirTime')->findByPk(5467);
//
//		echo Yii::app()->params['programFilePath'];
//		echo '<br>' . dirname(__FILE__);
//		echo '<br>' . WEB_BASE;


	}

	private function checkLogin(){
		if(!Yii::app()->user->isGuest){
			return true;
		}else{
			if(Yii::app()->controller->action->id != 'login'){
				$this->redirect('/index.php/admin/login');
			}
		}
		return false;
	}

}

