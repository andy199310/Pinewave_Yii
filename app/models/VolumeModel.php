<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 1:43
 */

class VolumeModel extends CActiveRecord{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return 'volume';
	}

	public function rules(){
		return array(
			array('count, pid', 'required','message'=>'{attribute}一定要填','on'=>'add'),
//			array('datetime', 'exist', 'attributeName'=>'vid', 'className'=>'ScheduleModel'),
//			array('datetime', 'date','format'=>'yyyy-MM-dd hh-mm-ss','allowEmpty'=>false),
//			array('replay_datetime', 'exist', 'attributeName'=>'vid', 'className'=>'ScheduleModel'),
//			array('replay_datetime', 'date','format'=>'yyyy-MM-dd hh-mm-ss','allowEmpty'=>false),
			array('count', 'numerical', 'integerOnly'=>true),
		);
	}

	public function attributeLabels(){
		return array(
			'vid'           => '集代號',
			'pid'           => '節目代號',
			'count'      	=> '集數',
			'datetime'      	=> '首播日期',
			'replay_datetime'      	=> '重播日期',
		);
	}

	public function relations()
	{
		return array(
			'ProgramData' => array(self::BELONGS_TO, 'ProgramData', array('pid' => 'id')),
			'OnAirTime' => array(self::HAS_MANY, 'ScheduleModel', 'vid'),
			'FirstOnAirTime' => array(self::HAS_ONE, 'ScheduleModel', 'vid', 'condition' => 'first=1'),
			'ReplayOnAirTime' => array(self::HAS_MANY, 'ScheduleModel', 'vid', 'condition' => 'first=0'),
		);
	}

}