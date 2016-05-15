<?php

/**
 * This is the model class for table "pedido".
 *
 * The followings are the available columns in table 'pedido':
 * @property integer $id
 * @property integer $idUsuario
 * @property integer $idBolao
 * @property integer $data
 * @property string $linkTransacao
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Bolao $idBolao0
 * @property User $idUsuario0
 */
class Pedido extends CActiveRecord
{

	const StatusAguardando = 1;
	const Statuspago = 3; # Seguindo numeração do PagSeguro

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idUsuario, idBolao, data, status', 'required'),
			array('idUsuario, idBolao, data, status', 'numerical', 'integerOnly'=>true),
			array('id, idUsuario, idBolao, data, linkTransacao, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'idBolao0' => array(self::BELONGS_TO, 'Bolao', 'idBolao'),
			'idUsuario0' => array(self::BELONGS_TO, 'User', 'idUsuario'),
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
			'idBolao' => 'Id Bolao',
			'data' => 'Data',
			'linkTransacao' => 'Link Transacao',
			'status' => 'Status',
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pedido the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
