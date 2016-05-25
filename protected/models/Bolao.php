<?php

/**
 * This is the model class for table "bolao".
 *
 * The followings are the available columns in table 'bolao':
 * @property string $codCampeonato
 * @property integer $idBolao
 * @property string $tipoInscricao
 * @property integer $valorInscricao
 * @property integer $prazo
 */
class Bolao extends CActiveRecord
{

	const TipoPago = 1;
	const TipoAberto = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bolao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('codCampeonato, tipoInscricao, valorInscricao, prazo', 'required'),
			array('valorInscricao, prazo', 'numerical', 'integerOnly'=>true),
			array('codCampeonato', 'length', 'max'=>5),
			array('tipoInscricao,isAtivo', 'length', 'max'=>1),
			array('codCampeonato, idBolao, tipoInscricao, valorInscricao, prazo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$semanaPasada = time() - 14*24*60*60;
		return array(
			'participantes'=>[self::MANY_MANY,'User','user_bolao(idBolao,idUsuario)',
				'condition' => 'participantes_participantes.status = ' . UserBolao::StatusAtivo
										. ' OR (participantes_participantes.status = ' . UserBolao::StatusPendente . ' AND participantes_participantes.dataInscricao > ' . $semanaPasada . ')'
			],
			'posicoes'=>[self::HAS_MANY,'Ranking','idBolao','order'=>'pontos DESC,qtdExatos DESC,qtdVencedores DESC'],
			'campeonato'=>[self::BELONGS_TO,'Campeonato','codCampeonato'],
			'emailDoDia'=>[self::HAS_ONE,'BolaoEmail','idBolao',
				'condition' => "dia='".date('Y-m-d')."'",
			],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codCampeonato' => 'Cod Campeonato',
			'idBolao' => 'Id Bolao',
			'tipoInscricao' => 'Tipo Inscricao',
			'valorInscricao' => 'Valor Inscricao',
			'prazo' => 'Prazo',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bolao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function userNaoInscrito(){
		$criteria = new CDbCriteria();
		$criteria->addNotInCondition('idBolao',array_keys(Yii::app()->controller->user->boloesInscritos));
		$this->getDbCriteria()->mergeWith($criteria);
		return $this;
	}

	public function scopes(){
		return [
			'ativo' => [
				'condition'=>'isAtivo=1',
			],
		];
	}

	/**
	 * Define o horário de fechamento de acordo com o lista de $jogos e o prazo
	 * definido para o bolão
	 */
	public function getHoraFechamento($jogos){
		$menor = false;
		foreach ($jogos as $j) {
			if(!$menor || strtotime($j->data) < $menor)
				$menor = $j->data;
		}
		return strtotime($menor) - ($this->prazo * 60);
	}

	/**
	 *
	 */
	public function isUserPendente(){
		return $this->isInscricaoPendente(Yii::app()->user->id);
	}

	public function isInscricaoPendente($userId){
		$userBolao = UserBolao::model()->findByPk([
			'idUsuario'=>$userId,
			'idBolao'=>$this->idBolao,
		]);
		return is_null($userBolao) || $userBolao->status == UserBolao::StatusPendente;
	}

	public function getInscricao($userId){
		return UserBolao::model()->findByPk([
			'idUsuario'=>$userId,
			'idBolao'=>$this->idBolao,
		]);
	}

	public function getJogosEmAberto(){
		return $this->filtraJogosDoDia(true);
	}

	public function getJogosFechados(){
		return $this->filtraJogosDoDia(false);
	}

	private function filtraJogosDoDia($abertos=true){
		$dias = $abertos ? $this->campeonato->jogosPorDiaEmAberto() : $this->campeonato->jogosPorDiaFechados();
		$primeiro = key($dias);
		if($abertos && $this->campeonato->temJogosHoje() && $this->isDiaFechado()){
			unset($dias[$primeiro]);
		}
		if(!$abertos && !$this->isDiaFechado()){
			unset($dias[$primeiro]);
		}
		return $dias;
	}

	public function isDiaFechado(){
		$inicioDoDiaDeHoje = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d'),date('Y')));
		$finalDoDiaDeHoje = date('Y-m-d H:i:s',mktime(23,59,59,date('m'),date('d'),date('Y')));
		$primeiroJogo = Jogo::model()->find([
			'order'=>'data ASC',
			'condition'=>"codCampeonato='{$this->codCampeonato}' AND data>'{$inicioDoDiaDeHoje}' AND data<'{$finalDoDiaDeHoje}'"
		]);
		if(is_null($primeiroJogo)){ # Nenhum jogo no dia.
			return true;
		} else {
			$limiteDia = time()+($this->prazo*60);
			return $primeiroJogo->data <= date('Y-m-d H:i:s',$limiteDia);
		}
	}

}
