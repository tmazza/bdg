<?php

/**
 * This is the model class for table "pedido_produto".
 *
 * The followings are the available columns in table 'pedido_produto':
 * @property integer $pedido_id
 * @property integer $produto_id
 *
 * The followings are the available model relations:
 * @property Bolao $produto
 * @property Pedido $pedido
 */
class PedidoProduto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pedido_produto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('pedido_id, produto_id', 'required'),
			array('pedido_id, produto_id', 'numerical', 'integerOnly'=>true),
			array('pedido_id, produto_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'produto' => array(self::BELONGS_TO, 'Bolao', 'produto_id'),
			'pedido' => array(self::BELONGS_TO, 'Pedido', 'pedido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pedido_id' => 'Pedido',
			'produto_id' => 'Produto',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PedidoProduto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
