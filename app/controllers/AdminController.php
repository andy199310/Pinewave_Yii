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

			$bulletinModel = new BulletinModel;

			if(isset($_POST['BulletinModel'])){
				$bulletinModel->attributes = $_POST['BulletinModel'];

				$bulletinModel->time = new CDbExpression('NOW()');

				if($bulletinModel->save()){
					$this->redirect(Yii::app()->createUrl('admin/index'));
					Yii::app()->end();
				}


				//$this->redirect('/index.php/admin/programs');
			}


			$data['bulletinModel'] = $bulletinModel;
			$this->render('bulletin', $data);
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
				$data['programData'] = $programData->findByPk($data['id']);
				$data['programVolumeData'] = $programData->with('volume')->findByPk($data['id']);
				if($data != NULL){
					$this->render('program', $data);
				}else{
					$this->redirect('admin/programs');
				}
			}else{
				$this->redirect('admin/programs');
			}
		}
	}

	//修改節目
	public function actionEditProgram(){
		if($this->checkLogin()){
			$data['id'] = Yii::app()->request->getParam('id');

			if($data['id'] != NULL){
				$programData = new ProgramData;

				$editData = ProgramData::model()->findByPk($data['id']);

				if(isset($_POST['ProgramData']) && $editData != NULL){

//					$editData->attributes = $_POST['ProgramData'];

//					$programData->name="OPPPPPPPPPeeeeeeee";

					$editData->class = $_POST['ProgramData']['class'];
					$editData->name = $_POST['ProgramData']['name'];
					$editData->dj = $_POST['ProgramData']['dj'];
					$editData->introduction = $_POST['ProgramData']['introduction'];
					$editData->simple_intro = $_POST['ProgramData']['simple_intro'];

					if($editData->validate()){
						$editData->save();
						$this->redirect('/index.php/admin/program/'.$editData->primaryKey);
						Yii::app()->end();
					}else{
						$data['model'] = $editData;
						$this->render('editProgram', $data);
						Yii::app()->end();
					}

					$this->redirect('/index.php/admin/programs');
				}else{
					$data['model'] = $programData->findByPk($data['id']);
					if($data['model'] != NULL){
						$this->render('editProgram', $data);
					}else{
						$this->redirect('admin/programs');
					}
				}

			}else{
				$this->redirect('admin/programs');
			}
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
						$tmpTime = strtotime($newData->datetime)+604800-3600;
						$newData->datetime = date('Y-m-d H:i:s', $tmpTime);
						$newData->save(false);

						$this->redirect(array('admin/volume/', 'id' => $volumeData->primaryKey));
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
				$data['volumeReplayData'] = $volumeModel->with('ReplayOnAirTime')->findAllByPk($data['vid']);
				$copyrightModel = new CopyrightModel;
				$data['volumeCopyrightCount'] = $copyrightModel->findByVid()->count(array('params' => array(':vid' => $data['vid'])));

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

					if($model->validate()){
						$model->file->saveAs(Yii::app()->params['programFilePath'] . $data['vid'] . '.mp3');
						$volumeModel = new VolumeModel;
						$volume = $volumeModel->findByPk($data['vid']);
						$volume->uploaded = 1;
						$volume->save();

						$this->redirect(array('admin/volume', 'id'=>$data['vid']));

						Yii::app()->end();
					}else{

					}
				}
				$this->render('uploadVolume', array('model' => $model));
			}else{
				$this->redirect(array('admin/programs'));
			}
		}
	}

	//上傳橫批
	public function actionUploadBar(){
		if($this->checkLogin()){
			$data['pid'] = Yii::app()->request->getParam('id');

			if($data['pid'] != NULL){
				$model = new BarModel;
				if(isset($_POST['BarModel'])){
					$model->attributes = $_POST['BarModel'];
					$model->file = CUploadedFile::getInstance($model, 'file');

					if($model->validate()){
						$model->file->saveAs(WEB_BASE.Yii::app()->params['programImgPath'] . $data['pid'] . '.jpg');

						$this->redirect(array('admin/program', 'id'=>$data['pid']));

						Yii::app()->end();
					}else{

					}
				}
				$this->render('uploadBar', array('model' => $model));
			}else{
				$this->redirect(array('admin/programs'));
			}
		}
	}

	//顯示小的版權清單
	public function actionShowCopyright(){
		if($this->checkLogin()){
			$data['vid'] = Yii::app()->request->getParam('id');

			if($data['vid'] != NULL){

				$copyrightModel = new CopyrightModel;
				$volumeModel = new VolumeModel;

				$data['volumeData'] = $volumeModel->with('ProgramData', 'FirstOnAirTime')->findByPk($data['vid']);

				$data['copyrightData'] = $copyrightModel->findByVid()->findAll(array('params' => array(':vid' => $data['vid'])));

				$this->render('showCopyright', $data);
			}else{
				$this->redirect(array('admin/programs'));
			}
		}
	}

	//加小的版權清單
	public function actionAddCopyright(){
		if($this->checkLogin()){
			$data['vid'] = Yii::app()->request->getParam('id');

			if($data['vid'] != NULL){

				$volumeModel = new VolumeModel;

				$data['volumeData'] = $volumeModel->with('ProgramData', 'FirstOnAirTime')->findByPk($data['vid']);
				if($data['volumeData'] != NULL){
					$data['model'] = new CopyrightModel;

					if(isset($_POST['CopyrightModel'])){
						$data['model']->attributes = $_POST['CopyrightModel'];

						$data['model']->singer = $_POST['CopyrightModel']['singer'];
						$data['model']->lyricist = $_POST['CopyrightModel']['lyricist'];
						$data['model']->composer = $_POST['CopyrightModel']['composer'];
						$data['model']->arranger = $_POST['CopyrightModel']['arranger'];
						$data['model']->company = $_POST['CopyrightModel']['company'];
						$data['model']->playCount = $_POST['CopyrightModel']['playCount'];

						$data['model']->vid = $data['vid'];

						if($data['model']->save()){


							$this->redirect(array('admin/showCopyright', 'id'=>$data['vid']));

							Yii::app()->end();
						}else{

						}
					}
					$this->render('addCopyright', $data);

				}else{
					$this->redirect(array('admin/programs'));
				}
			}else{
				$this->redirect(array('admin/programs'));
			}
		}
	}

	//修改小的版權清單
	public function actionEditCopyright(){
		if($this->checkLogin()){
			$data['cid'] = Yii::app()->request->getParam('id');

			if($data['cid'] != NULL){
				$copyrightModel = new CopyrightModel;

				$data['model'] = CopyrightModel::model()->findByPk($data['cid']);

				if(isset($_POST['CopyrightModel']) && $data['model'] != NULL){


					$data['model']->singer = $_POST['CopyrightModel']['singer'];
					$data['model']->lyricist = $_POST['CopyrightModel']['lyricist'];
					$data['model']->composer = $_POST['CopyrightModel']['composer'];
					$data['model']->arranger = $_POST['CopyrightModel']['arranger'];
					$data['model']->company = $_POST['CopyrightModel']['company'];
					$data['model']->playCount = $_POST['CopyrightModel']['playCount'];
//					$data['model']->vid = $data['cid'];


					if($data['model']->validate()){
						$data['model']->save();
						$this->redirect('/admin/showCopyright/'.$data['model']->vid);
						Yii::app()->end();
					}else{
						$this->render('editCopyright', $data);
						Yii::app()->end();
					}

					$this->redirect('/index.php/admin/programs');
				}else{
					$data['model'] = $copyrightModel->findByPk($data['cid']);
					if($data['model'] != NULL){
						$this->render('editCopyright', $data);
					}else{
						$this->redirect('admin/programs');
					}
				}

			}else{
				$this->redirect('admin/programs');
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




	//大的版權清單首頁
	public function actionCopyright(){
		if($this->checkLogin()){
			$this->render('copyrightIndex');
		}
	}

	//顯示上未填寫的節目(已播出的)
	public function actionCopyrightOver(){
		if($this->checkLogin()){
		
			$sql = 'SELECT count(copyright.cid) AS CopyRightCount, volume.vid, schedule.datetime, program.name, program.dj
					FROM copyright
					RIGHT JOIN volume ON (volume.vid=copyright.vid)
					LEFT JOIN schedule ON (volume.vid=schedule.vid)
					LEFT JOIN program ON (volume.pid=program.id)
					WHERE schedule.first = 1
						AND schedule.datetime < NOW()
					GROUP BY volume.vid
					ORDER BY schedule.datetime ASC';
					
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sql);
			$data['data'] = $command->queryAll();
			
			$this->render('copyrightOver', $data);
			
		}
	//	$data = $volumeModel->findBySql("SELECT count(copyright.cid) AS CopyRightCount, volume.vid, schedule.datetime, program.name, program.dj FROM copyright RIGHT JOIN volume ON (volume.vid=copyright.vid) LEFT JOIN schedule ON (volume.vid=schedule.vid) LEFT JOIN program ON (volume.pid=program.id) WHERE schedule.first = 1 AND schedule.datetime < NOW() GROUP BY volume.vid ORDER BY schedule.datetime ASC");
		//$data = $volumeModel->with('CopyrightOver')->findAll(array('select'=>'count(cid)'));
		//print_r($results);
	/*
		if($this->checkLogin()){
			echo "製作中XDD";
		}*/
	}

	//依年份月度顯示清單 POST: year, month
	public function actionCopyrightByMonth(){
		if($this->checkLogin()){
			if(isset($_POST['year']) && isset($_POST['month'])){
				$data['year'] = $_POST['year'];
				$data['month'] = $_POST['month'];

				$copyrightModel = new CopyrightModel;


				$time = sprintf('%%%04d-%02d%%', $data['year'], $data['month']);
//				echo ":".$time;

				$data['copyrightData'] = $copyrightModel->with('VolumeDataWithMonth')->findAll(array('params' => array(':time' => $time)));

//				print_r($data['copyrightData']);


				$this->render('copyrightByMonth', $data);
			}
		}
	}

	public function actionCopyrightDownload(){
		if($this->checkLogin()){
			$data['year'] = Yii::app()->request->getParam('year');
			$data['month'] = Yii::app()->request->getParam('month');

			if($data['year'] != NULL && $data['month'] != NULL){
				$copyrightModel = new CopyrightModel;

				$time = sprintf('%%%04d-%02d%%', $data['year'], $data['month']);
//echo "HI";
				$data['copyrightData'] = $copyrightModel->with('VolumeDataWithMonth')->findAll(array('params' => array(':time' => $time)));
				$this->render('copyrightDownload', $data);
			}else{
				$this->redirect(array('admin/copyright'));
			}
		}
	}


	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/index.php/admin/index');
	}

	public function actionTest(){
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("K'iin Balam")
			->setLastModifiedBy("K'iin Balam")
			->setTitle("YiiExcel Test Document")
			->setSubject("YiiExcel Test Document")
			->setDescription("Test document for YiiExcel, generated using PHP classes.")
			->setKeywords("office PHPExcel php YiiExcel UPNFM")
			->setCategory("Test result file");

		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Hello')
			->setCellValue('B2', 'world!')
			->setCellValue('C1', 'Hello')
			->setCellValue('D2', 'world!');

		// Miscellaneous glyphs, UTF-8
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A4', 'Miscellaneous glyphs')
			->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('YiiExcel');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		// Save a xls file
		$filename = 'YiiExcel';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

		$objWriter->save('php://output');
		unset($this->objWriter);
		unset($this->objWorksheet);
		unset($this->objReader);
		unset($this->objPHPExcel);
		exit();
//		echo phpinfo();
//		$this->redirect(array('admin/volume', 'id'=>'5480'));
//		$model = new VolumeModel();
//		$data = $model->with('OnAirTime')->findByPk(5467);
//
//		echo Yii::app()->params['programFilePath'];
//		echo '<br>' . dirname(__FILE__);
//		echo '<br>' . WEB_BASE;


	}

	public function actionMakePAL(){

		$programPath = "Y:\\";

		$filePath = "/home/radio/sam/";

		$fileName = date("D", mktime(0, 0, 0, date("m"), date('d')+1, date("Y"))).'.pal';

		$scheduleModel = new ScheduleModel;

		$contents = "";


		for($i=0; $i<24; $i++){
			$thisHour = date("Y-m-d H", mktime($i, 0, 0, date("m"), date("d")+1, date("Y")));
			$data = $scheduleModel->find(array(
				'condition' => '`datetime` LIKE :time',
				'params' => array(':time' => '%'.$thisHour.'%'),));

			$contents .= "PAL.WaitForTime(T['$i:00:00']);\n";

			$tmp = "";
			if($data != NULL){
				$tmp = $programPath.$data->vid.'.mp3';

			}else if ($i <= 5 || $i > 19){
				//night
				$id = rand(1, 9);
				$tmp = sprintf("D:\\fun_music\\night\\%02d.mp3", $id);
			}else if($i <= 11){
				//morning
				$id = rand(1, 10);
				$tmp = sprintf("D:\\fun_music\\morning\\%02d.mp3", $id);
			}else{
				//noon
				$id = rand(1, 31);
				$tmp = sprintf("D:\\fun_music\\noon\\%02d.mp3", $id);
			}

			$contents .= sprintf("Queue.AddFile('%s',ipTop);\n", $tmp);
			$contents .= "ActivePlayer.FadeToNext;\n";

		}

//		echo "File Name: " . $fileName . '<br><br>';

		echo "Content: <br>" . nl2br($contents);
		file_put_contents($filePath.$fileName, $contents);


	}

	public function actionMakePALToday(){

		$programPath = "Y:\\";

		$filePath = "/home/radio/sam/";

		$fileName = date("D", mktime(0, 0, 0, date("m"), date('d'), date("Y"))).'.pal';

		$scheduleModel = new ScheduleModel;

		$contents = "";


		for($i=0; $i<24; $i++){
			$thisHour = date("Y-m-d H", mktime($i, 0, 0, date("m"), date("d"), date("Y")));
			$data = $scheduleModel->find(array(
				'condition' => '`datetime` LIKE :time',
				'params' => array(':time' => '%'.$thisHour.'%'),));

			$contents .= "PAL.WaitForTime(T['$i:00:00']);\n";

			$tmp = "";
			if($data != NULL){
				$tmp = $programPath.$data->vid.'.mp3';

			}else if ($i <= 5 || $i > 19){
				//night
				$id = rand(1, 9);
				$tmp = sprintf("D:\\fun_music\\night\\%02d.mp3", $id);
			}else if($i <= 11){
				//morning
				$id = rand(1, 10);
				$tmp = sprintf("D:\\fun_music\\morning\\%02d.mp3", $id);
			}else{
				//noon
				$id = rand(1, 31);
				$tmp = sprintf("D:\\fun_music\\noon\\%02d.mp3", $id);
			}

			$contents .= sprintf("Queue.AddFile('%s',ipTop);\n", $tmp);
			$contents .= "ActivePlayer.FadeToNext;\n";

		}

//		echo "File Name: " . $fileName . '<br><br>';

		echo "Content: <br>" . nl2br($contents);
		file_put_contents($filePath.$fileName, $contents);


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

