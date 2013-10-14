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
		return 'schedule';
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

	public function scopes(){
		return array(
			'firstOnAir' => array(
				'condition' => '`first` = \'1\'',
			),
			'monthly' => array(
				'condition' => '`datetime` LIKE :month',
				'params' => array(':month' => '%'.date("Y-m").'%'),
			)
		);
	}

	public function relations(){
		return array(
			'data' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => 'ProgramData'),
			'ScheduleLeftData' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => 'ProgramData', 'condition' => 'ProgramData.class=:class',),
		);
	}

}