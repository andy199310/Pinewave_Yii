<?php
/**
 * User: Green
 * Date: 2013/7/29
 * Time: 上午 1:33
 */
class ProgramModel{

	public function getProgramsList($from = 0, $count = 10){
		$connection = Yii::app()->db;

		$sql = "SELECT `program`.`name`, `program`.`dj`, `program`.`pic`, `program`.`id`
				FROM `program`
				ORDER BY `program`.`id` DESC";

		$command = $connection->createCommand($sql);
		$command->bindParam(':from', $from, PDO::PARAM_INT);
		$command->bindParam(':count', $count, PDO::PARAM_INT);

		return $command->queryAll();
	}

	public function addNewProgram($name, $dj, $class, $intro, $simple_intro){
		$connection = Yii::app()->db;

		$sql = "INSERT INTO `program`
				(`name`, `dj`, `class`, `introduction`, `simple_intro`)
				VALUES
				(:name, :dj, :class, :intro, :simple_intro)";

		$command = $connection->createCommand($sql);
		$command->bindParam(':name', $name, PDO::PARAM_STR);
		$command->bindParam(':dj', $dj, PDO::PARAM_STR);
		$command->bindParam(':class', $class, PDO::PARAM_STR);
		$command->bindParam(':intro', $intro, PDO::PARAM_STR);
		$command->bindParam(':simple_intro', $simple_intro, PDO::PARAM_STR);

		return $command->query();
	}

	public function getVolumeDataById($pid){
		$connection = Yii::app()->db;

		$sql = "SELECT `volume`.`vid`, `volume`.`count`
				FROM `volume`
				WHERE `volume`.`pid` = :pid
				ORDER BY `volume`.`count` ASC";

		$command = $connection->createCommand($sql);
		$command->bindParam(':pid', $pid, PDO::PARAM_STR);

		return $command->queryAll();

	}

	public function addNewVolume($pid, $datetime, $count){
		$connection = Yii::app()->db;

		$sql = "INSERT INTO `volume`
				(`pid`, `count`)
				VALUES
				(:pid, :count)";

		$command = $connection->createCommand($sql);
		$command->bindParam(':pid', $pid, PDO::PARAM_STR);
		$command->bindParam(':count', $count, PDO::PARAM_STR);

		$command->query();

		$vid = Yii::app()->db->getLastInsertId();

		$sql = "INSERT INTO `schedule`
				(`program`, `datetime`, `first`)
				VALUES
				(:vid, :datetime, '1')";

		$command = $connection->createCommand($sql);
		$command->bindParam(':vid', $vid, PDO::PARAM_STR);
		$command->bindParam(':datetime', $datetime, PDO::PARAM_STR);

		return $command->query();
	}

	public function getProgramDetailByProgramId($pid){
		$connection = Yii::app()->db;

		$sql = "SELECT `program`.`name`, `program`.`dj`, `program`.`pic`, `program`.`introduction`, `program`.`simple_intro`, `program`.`id`
				FROM `program`
				INNER JOIN `programClass`
					ON `program`.`class` = `programClass`.`id`
				WHERE `program`.`id` = :pid
				LIMIT 0, 1";

		$command = $connection->createCommand($sql);
		$command->bindParam(':pid', $pid, PDO::PARAM_STR);

		return $command->queryRow();
	}

	public function getNextProgramId(){
		$connection = Yii::app()->db;

		$sql = "SELECT `schedule`.`program`
				FROM `schedule`
				WHERE `datetime` > NOW()
				ORDER BY `datetime` ASC
				LIMIT 0, 1";

		$command = $connection->createCommand($sql);

		return $command->queryRow();
	}

	public function getPreviousProgramId(){
		$connection = Yii::app()->db;

		$sql = "SELECT `schedule`.`program`
				FROM `schedule`
				WHERE `datetime` < NOW()
				ORDER BY `datetime` DESC
				LIMIT 0, 1";

		$command = $connection->createCommand($sql);

		return $command->queryRow();
	}

	public function getProgramOnAirList($pid, $all = false){
		$connection = Yii::app()->db;

		$sql = "";

		if($all == true){
			$sql = "SELECT `schedule`.`id`, `schedule`.`datetime`
					FROM `schedule`
					WHERE `schedule`.`program` = :pid
					ORDER BY `datetime` ASC";
		}else{
			$sql = "SELECT `schedule`.`id`, `schedule`.`datetime`
					FROM `schedule`
					WHERE `schedule`.`program` = :pid
					AND `datetime` < NOW()
					ORDER BY `datetime` ASC";
		}



		$command = $connection->createCommand($sql);
		$command->bindParam(':pid', $pid, PDO::PARAM_INT);

		return $command->queryAll();
	}

	public function getProgramByClass($class){
		$connection = Yii::app()->db;

		$sql = "SELECT `program`.`name`, `program`.`id`
				FROM `program`
				WHERE `program`.`class` = :class
				ORDER BY `id` DESC";

		$command = $connection->createCommand($sql);
		$command->bindParam(':class', $class, PDO::PARAM_STR);

		return $command->queryAll();
	}

}