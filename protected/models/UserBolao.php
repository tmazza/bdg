<?php

/**
 * This is the model class for table "user_bolao".
 *
 * The followings are the available columns in table 'user_bolao':
 * @property integer $idUsuario
 * @property integer $idBolao
 * @property integer $status
 */
class UserBolao extends CActiveRecord
{
	const StatusAtivo = 1;
	const StatusInativo = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_bolao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idUsuario, idBolao', 'required'),
			array('idUsuario, idBolao, status', 'numerical', 'integerOnly'=>true),
			array('idUsuario, idBolao, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUsuario' => 'Id Usuario',
			'idBolao' => 'Id Bolao',
			'status' => 'Status',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserBolao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
