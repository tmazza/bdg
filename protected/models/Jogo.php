<?php

/**
 * This is the model class for table "jogo".
 *
 * The followings are the available columns in table 'jogo':
 * @property string $codCampeonato
 * @property integer $idJogo
 * @property integer $equipeMandante
 * @property integer $equipeVisitante
 * @property integer $golsMandate
 * @property integer $golsVisitante
 * @property string $vencedor
 *
 * The followings are the available model relations:
 * @property Equipe $equipeVisitante0
 * @property Campeonato $codCampeonato0
 * @property Equipe $equipeMandante0
 */
class Jogo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jogo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('codCampeonato, equipeMandante, equipeVisitante, data', 'required'),
			array('equipeMandante, equipeVisitante, golsMandate, golsVisitante', 'numerical', 'integerOnly'=>true),
			array('codCampeonato', 'length', 'max'=>5),
			array('vencedor', 'length', 'max'=>1),
			array('codCampeonato, idJogo, equipeMandante, equipeVisitante, golsMandate, golsVisitante, vencedor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'equipeVisitante0' => array(self::BELONGS_TO, 'Equipe', 'equipeVisitante'),
			'codCampeonato0' => array(self::BELONGS_TO, 'Campeonato', 'codCampeonato'),
			'equipeMandante0' => array(self::BELONGS_TO, 'Equipe', 'equipeMandante'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codCampeonato' => 'Cod Campeonato',
			'idJogo' => 'Id Jogo',
			'equipeMandante' => 'Equipe Mandante',
			'equipeVisitante' => 'Equipe Visitante',
			'golsMandate' => 'Gols Mandate',
			'golsVisitante' => 'Gols Visitante',
			'vencedor' => 'Vencedor',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jogo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
