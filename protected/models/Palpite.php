<?php

/**
 * This is the model class for table "palpite".
 *
 * The followings are the available columns in table 'palpite':
 * @property integer $idUsuario
 * @property integer $idBolao
 * @property integer $idJogo
 * @property integer $golsMandante
 * @property integer $golsVisitante
 * @property string $vencedor
 * @property integer $pontos
 */
class Palpite extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'palpite';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idUsuario, idBolao, idJogo, golsMandante, golsVisitante', 'required'),
			array('idUsuario, idBolao, idJogo, pontos, golsMandante, golsVisitante', 'numerical', 'integerOnly'=>true),
			array('golsMandante, golsVisitante','default','setOnEmpty'=>true),
			array('vencedor', 'length', 'max'=>1),
			array('idUsuario, idBolao, idJogo, golsMandante, golsVisitante, vencedor, pontos', 'safe', 'on'=>'search'),
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
			'idJogo' => 'Id Jogo',
			'golsMandante' => 'Gols Mandate',
			'golsVisitante' => 'Gols Visitante',
			'vencedor' => 'Vencedor',
			'pontos' => 'Pontos',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Palpite the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

}
