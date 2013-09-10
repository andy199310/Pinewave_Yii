<?php
/**
 * Created by IntelliJ IDEA.
 * User: Green
 * Date: 2013/7/17
 * Time: 下午 10:34
 */


class ProgramClassModel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GeneralDepartment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'programClass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('department_id, department_name', 'required'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'ProgramData' => array(self::BELONGS_TO, 'ProgramData', 'class'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'  => 'id',
			'level'=> 'level',
			'name'=> 'Class Name',
		);
	}
}
