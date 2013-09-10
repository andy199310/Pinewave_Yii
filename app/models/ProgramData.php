<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 1:22
 */

class ProgramData extends CActiveRecord{

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return 'program';
	}

	public function rules(){
		return array(
			array('name, dj, class, introduction, simple_intro', 'required','message'=>'{attribute}一定要填','on'=>'add'),
			array('class', 'exist', 'attributeName'=>'id', 'className'=>'ProgramClassModel'),
			array('class', 'numerical', 'integerOnly'=>true),
		);
	}

	public function attributeLabels(){
		return array(
			'id'  => 'id',
			'class'  => '類別',
			'name'  => '節目名稱',
			'dj'  => 'DJ',
			'introduction'  => '節目介紹',
			'simple_intro'  => '節目簡介',
		);
	}

	public function relations(){
		return array(
			'volume' => array(self::HAS_MANY, 'VolumeModel', 'pid'),
			'class' => array(self::BELONGS_TO, 'ProgramClassModel', array('class' => 'id')),
		);
	}

	public function programClassIdArray(){
		$array = ProgramClassModel::model()->findAll();
		return $array;
	}

}