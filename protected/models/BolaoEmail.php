<?php

/**
 * This is the model class for table "bolao_email".
 *
 * The followings are the available columns in table 'bolao_email':
 * @property integer $idBolao
 * @property string $dia
 *
 * The followings are the available model relations:
 * @property Bolao $idBolao0
 */
class BolaoEmail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bolao_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idBolao, dia', 'required'),
			array('idBolao,tipo', 'numerical', 'integerOnly'=>true),
			array('dia', 'length', 'max'=>10),
			array('idBolao, dia', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'bolao' => array(self::BELONGS_TO, 'Bolao', 'idBolao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idBolao' => 'Id Bolao',
			'dia' => 'Dia',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BolaoEmail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
