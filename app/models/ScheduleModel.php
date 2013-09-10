<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 1:43
 */

class ScheduleModel extends CActiveRecord{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return 'schedule_new';
	}

	public function rules(){
		return array(
			array('datetime', 'required' ,'on'=>'new_volume'),
		);
	}

	public function attributeLabels(){
		return array(
			'sid'           => '只是流水號',
			'vid'           => '集代號',
			'datetime'      => '播出時間',
			'first'     	=> '是否為首播',
		);
	}

	public function relations(){
		return array(
			'data' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => 'ProgramData'),
		);
	}

}