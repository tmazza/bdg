<?php

/**
 * This is the model class for table "jogo".
 *
 * The followings are the available columns in table 'jogo':
 * @property string $codCampeonato
 * @property integer $idJogo
 * @property integer $equipeMandante
 * @property integer $equipeVisitante
 * @property integer $golsMandante
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

	const StatusAguardando = 0;
	const StatusEmAberto = 1;
	const StatusFechado = 2;

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
			array('equipeMandante, equipeVisitante, golsMandante, golsVisitante,numJogo', 'numerical', 'integerOnly'=>true),
			array('codCampeonato', 'length', 'max'=>5),
			array('vencedor,status', 'length', 'max'=>1),
			array('codCampeonato, idJogo, equipeMandante, equipeVisitante, golsMandante, golsVisitante, vencedor', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'visitante' => array(self::BELONGS_TO, 'Equipe', 'equipeVisitante'),
			'codCampeonato0' => array(self::BELONGS_TO, 'Campeonato', 'codCampeonato'),
			'mandante' => array(self::BELONGS_TO, 'Equipe', 'equipeMandante'),
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
			'golsMandante' => 'Gols Mandate',
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

	public function getGolsPalpiteUserBolao($bolao){
		$palpite = Palpite::model()->findByPk([
			'idBolao'=>$bolao->idBolao,
			'idUsuario'=>Yii::app()->user->id,
			'idJogo'=>$this->idJogo,
		]);
		if(is_null($palpite)){
			return [null,null];
		} else {
			return [$palpite->golsMandante,$palpite->golsVisitante];
		}
	}

	public function getPontosObtidos($bolao){
		$palpite = Palpite::model()->findByPk([
			'idBolao'=>$bolao->idBolao,
			'idUsuario'=>Yii::app()->user->id,
			'idJogo'=>$this->idJogo,
		]);
		if(is_null($palpite)){
			return '-';
		} else {
			return $palpite->pontos;
		}
	}

	public function getGolsFechado(){
		if($this->status == self::StatusFechado){
			return [$this->golsMandante,$this->golsVisitante];
		} else {
			return [null,null];
		}
	}

}
