<?php

/**
 * This is the model class for table "user_senha".
 *
 * The followings are the available columns in table 'user_senha':
 * @property integer $user_id
 * @property string $hash
 * @property integer $estado
 * @property integer $data
 */
class UserSenha extends CActiveRecord
{

	const Ativa = 1;
	const Usada = 2;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_senha';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('user_id, hash, estado, data', 'required'),
			array('user_id, estado, data', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>512),
			array('user_id, hash, estado, data', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'hash' => 'Hash',
			'estado' => 'Estado',
			'data' => 'Data',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserSenha the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
