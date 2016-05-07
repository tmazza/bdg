<?php

/**
 * This is the model class for table "user_login".
 *
 * The followings are the available columns in table 'user_login':
 * @property integer $id
 * @property integer $data
 * @property integer $ip
 */
class UserLogin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'user_login';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		return array(
			array('user_id,data, ip', 'required'),
			array('data,user_id', 'numerical', 'integerOnly'=>true),
			array('id, data, ip', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'data' => 'Data',
			'ip' => 'Ip',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserLogin the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
