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

	const VencEmpate = 0;
	const VencCasa = 1;
	const VencVisitante = 2;

	const PExato = 25;
	const PVencedorEGols = 14;
	const PVencedor = 10;
	const PUmPlacar = 3;
	const PNada = 0;


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
		$palpite = $this->getPalpiteUserBolao(Yii::app()->user->id,$bolao->idBolao);
		if(is_null($palpite)){
			return [null,null];
		} else {
			return [$palpite->golsMandante,$palpite->golsVisitante];
		}
	}

	public function getPalpiteUserBolao($userId,$bolaoId){
		return Palpite::model()->findByPk([
			'idBolao'=>$bolaoId,
			'idUsuario'=>$userId,
			'idJogo'=>$this->idJogo,
		]);
	}

	public function getPontosObtidos($bolao){
		$palpite = Palpite::model()->findByPk([
			'idBolao'=>$bolao->idBolao,
			'idUsuario'=>Yii::app()->user->id,
			'idJogo'=>$this->idJogo,
		]);
		if($this->status==Jogo::StatusFechado){
			if(is_null($palpite)){
				return '0';
			} else {
				return $palpite->pontos;
			}
		} else {
			return '<small>Aguardando correção</small>';
		}
	}

	public function getGolsFechado(){
		if($this->status == self::StatusFechado){
			return [$this->golsMandante,$this->golsVisitante];
		} else {
			return [null,null];
		}
	}


	// Errar o vencedor do jogo e a quantidade de gols dos dois times	0 ponto
	// Acertar apenas a quantidade de gols de um dos times	3 pontos
	// Acertar apenas o vencedor (ou empate) do jogo	10 pontos
	// Acertar o vencedor do jogo e a quantidade de gols de um dos times	14 pontos
	// Acertar o placar exato do jogo	25 pontos
	public function calculaPontos($bolao,$user){
		$palpite = $this->getPalpiteUserBolao($user->id,$bolao->idBolao);
		if(is_null($palpite)){
			return [false,0,0,0];
		} else {
			$jC = $this->golsMandante; # jogo gols casa
			$jV = $this->golsVisitante; # jogo gols visitante
			$pC = $palpite->golsMandante; # palpite gols casa
			$pV = $palpite->golsVisitante; # palpite gols visitante
			# vencedor do jogo
			if($jC == $jV){
				$jVenc = self::VencEmpate;
			} else {
				$jVenc = $jC > $jV ? self::VencCasa : self::VencVisitante;
			}
			# palpite para vencedor
			if($pC == $pV){
				$pVenc = self::VencEmpate;
			} else {
				$pVenc = $pC > $pV ? self::VencCasa : self::VencVisitante;
			}

			if($jC == $pC && $jV == $pV){ # Acertou placar exato
				$pontos = self::PExato;
			} elseif($jVenc == $pVenc){ # Acertou o vencedor do jogo
				$pontos = ($jC == $pC || $jV == $pV) ? self::PVencedorEGols : self::PVencedor; # Acertou a qtd de gols de um dos times?
			} elseif($jC == $pC || $jV == $pV){ # Acertou somente o placar de um dos times
				$pontos = self::PUmPlacar;
			} else {
				$pontos = self::PNada;
			}
			return [$palpite,$pontos];
		}
	}

}
