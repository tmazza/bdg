<?php

/**
 * This is the model class for table "pedido".
 *
 * The followings are the available columns in table 'pedido':
 * @property integer $id
 * @property integer $user_id
 * @property integer $status
 * @property integer $data
 * @property string $link_transacao
 *
 * The followings are the available model relations:
 * @property User $user
 * @property PedidoProduto[] $pedidoProdutos
 */
class Pedido extends CActiveRecord
{

	const StatusAguardando = 1;
	const StatusAprovado = 2;
	const StatusCancelado = 3;

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
			array('user_id, status, data', 'required'),
			array('user_id, status, data', 'numerical', 'integerOnly'=>true),
			array('id, user_id, status, data, link_transacao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'produtos' => array(self::HAS_MANY, 'PedidoProduto', 'pedido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'status' => 'Status',
			'data' => 'Data',
			'link_transacao' => 'Link da transação',
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

	/**
	 * Adiciona produto ao pedido
	 */
	public function addProduto($id){
		$pedPro = new PedidoProduto();
		$pedPro->produto_id = $id;
		$pedPro->pedido_id = $this->id;
		return $pedPro->save();
	}

}
