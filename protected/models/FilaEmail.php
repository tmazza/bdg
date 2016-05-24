<?php

/**
 * This is the model class for table "fila_email".
 *
 * The followings are the available columns in table 'fila_email':
 * @property integer $id
 * @property integer $idUsuario
 * @property integer $email
 * @property integer $foi
 *
 * The followings are the available model relations:
 * @property User $idUsuario0
 */
class FilaEmail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fila_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idUsuario, email, foi', 'required'),
			array('idUsuario, foi, data', 'numerical', 'integerOnly'=>true),
			array('id, idUsuario, email, foi', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'idUsuario'),
			'bolaoEmail' => array(self::BELONGS_TO, 'bolaoEmail', 'email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'idUsuario' => 'Id Usuario',
			'email' => 'email',
			'foi' => 'Foi',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FilaEmail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
