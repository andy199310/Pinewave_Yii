<?php
/**
 * User: Green
 * Date: 2013/7/29
 * Time: 上午 1:33
 */
class ProgramModel{

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