<?php
/**
 * User: Green
 * Date: 2013/8/7
 * Time: 上午 2:32
 */

class BulletinModel{

	public function getBulletinMainByCount($count = 5){
		$connection = Yii::app()->db;

		$sql = "SELECT *
				FROM `bulletin`
				ORDER BY `time` DESC
				LIMIT 0, 5";

		$command = $connection->createCommand($sql);

		return $command->queryAll();
	}

	public function getBulletinDataById($id){
		$connection = Yii::app()->db;

		$sql = "SELECT *
				FROM `bulletin`
				WHERE `bulletin`.`id` = :id";

		$command = $connection->createCommand($sql);

		$command->bindParam(':id', $id, PDO::PARAM_INT);

		return $command->queryRow();
	}

}