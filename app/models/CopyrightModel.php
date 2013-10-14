<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 1:43
 */

class CopyrightModel extends CActiveRecord{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function primaryKey()	{
		return 'cid';
	}

	public function tableName(){
		return 'copyright';
	}

	public function rules(){
		return array(
			array('vid, name', 'required'),
//			array('vid, name, singer, lyricist, composer, arranger, company, playCount', 'required'),
//			array('singer, lyricist, composer, arranger, company, playCount', 'allowEmpty' => true),
		);
	}

	public function attributeLabels(){
		return array(
			'cid'           => '只是流水號',
			'vid'           => '集代號',
			'name'    	  	=> '歌名',
			'singer'      	=> '演唱者',
			'lyricist'     	=> '作詞',
			'composer'     	=> '作曲',
			'arranger'     	=> '編曲',
			'company'     	=> '發行公司',
			'playCount'     => '播放次數',
		);
	}

	public function scopes(){
		return array(
			'findByVid' => array(
				'condition' => '`vid` = :vid',
			),
		);
	}

	public function relations(){
		return array(
			'VolumeData' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => 'ProgramData'),
			'VolumeDataWithMonth' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => array('FirstOnAirTime', 'ProgramData'), 'condition' => 'FirstOnAirTime.`datetime` LIKE :time', 'order' => 'FirstOnAirTime.`datetime` ASC'),
		//	'CopyrightOver' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'joinType' => 'RIGHT JOIN', /*'alias'=>'volume', /*'with' => array('FirstOnAirTime', 'ProgramData'), 'condition' => 'FirstOnAirTime.`datetime` < NOW()', 'order' => 'FirstOnAirTime.`datetime` ASC', */),
//			'VolumeData2' => array(self::BELONGS_TO, 'VolumeModel', array('vid' => 'vid'), 'with' => array('ProgramData', 'FirstOnAirTime'), 'condition' => 'FirstOnAirTime.`datetime` LIKE :time'),

		);
	}
}