<?php
/**
 * User: Green
 * Date: 2013/9/4
 * Time: 下午 6:18
 */

class FileModel extends CActiveRecord{

	public $vid;

	public $file;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return 'program';
	}

	public function rules(){
		return array(
			array('file', 'file', 'types'=>'mp3'),
		);
	}

	public function attributeLabels(){
		return array(
			'file'  => '檔案',
			'vid'  => '節目代號',
		);
	}




}