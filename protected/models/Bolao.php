<?php

class Bolao extends CActiveRecord {

	const TipoPago = 1;
	const TipoAberto = 2;

	public function tableName() {
		return 'bolao';
	}

	public function rules() {
		return array(
			array('codCampeonato, tipoInscricao, valorInscricao, prazo', 'required'),
			array('valorInscricao, prazo', 'numerical', 'integerOnly'=>true),
			array('codCampeonato', 'length', 'max'=>5),
			array('tipoInscricao,isAtivo', 'length', 'max'=>1),
			array('codCampeonato, idBolao, tipoInscricao, valorInscricao, prazo', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {	
		$primeiroJogo = self::dataCarencia();
		$semanaPasada = time() - 14*24*60*60;


		$condCarenciaPag = ' OR (participantes_participantes.status = ' . UserBolao::StatusPendente . ' AND ';
		
		$condCarenciaPag .= '(';
		$condCarenciaPag .= '(participantes_participantes.dataInscricao < ' . $primeiroJogo . ' AND participantes_participantes.idBolao = 5)';
		$condCarenciaPag .= ' OR ';
		$condCarenciaPag .= '(participantes_participantes.dataInscricao > ' . $semanaPasada . ' AND participantes_participantes.idBolao != 5)';
		$condCarenciaPag .= ')';
		$condCarenciaPag .= ')';
		return array(
			'participantes'=>[self::MANY_MANY,'User','user_bolao(idBolao,idUsuario)',
				'condition' => 'participantes_participantes.status = ' . UserBolao::StatusAtivo
										. $condCarenciaPag,
			],
			'posicoes' => [self::HAS_MANY,'Ranking','idBolao',
				'order' => 'pontos DESC, qtdExatos DESC, qtdVencedores DESC'
			],
			'campeonato'=>[self::BELONGS_TO,'Campeonato','codCampeonato'],
			'emailDoDia'=>[self::HAS_ONE,'BolaoEmail','idBolao',
				'condition' => "dia='".date('Y-m-d')."'",
			],
			'palpitesProcessados'=>[self::HAS_MANY,'Palpite','idBolao',
				'condition'=>'pontos IS NOT NULL',
			],
			'userVencedor' => [self::BELONGS_TO,'User','vencedor'],
			'qualquerParticipante' => [self::MANY_MANY,'User','user_bolao(idBolao,idUsuario)', 
				'order' => 'qualquerParticipante.nome',
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
			'encerrado' => [
				'condition'=>'isEncerrado=1',
			],
			'naoEncerrado' => [
				'condition'=>'isEncerrado=0',
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

	public function getJogosFechados($limit){
		return $this->filtraJogosDoDia(false,$limit);
	}

	private function filtraJogosDoDia($abertos=true,$limit=false){
		$dias = $abertos ? $this->campeonato->jogosPorDiaEmAberto() : $this->campeonato->jogosPorDiaFechados();
		$primeiro = key($dias);
		if($abertos && $this->campeonato->temJogosHoje() && $this->isDiaFechado()){
			unset($dias[$primeiro]);
		}
		if(!$abertos && !$this->isDiaFechado()){
			unset($dias[$primeiro]);
		}
		return $limit ? array_slice($dias,0,$limit,true) : $dias;
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

	public function getPalpites(){
		$palpites = [];
		foreach ($this->palpitesProcessados as $j) {
			$key = $j->golsMandante.' x '.$j->golsVisitante;
			if(!isset($palpites[$key])) $palpites[$key]=['q'=>0,'p'=>0];
			$palpites[$key]['q']++;
			$palpites[$key]['p']+=$j->pontos;
		}
		return [
			'placares'=>$palpites,
			'totalQtd'=>array_sum(array_column($palpites, 'q')),
		];
	}

	public function getTextoVitoria(){
		return 'Campeã' . ($this->isVencedorFem ? '' : 'o') . ' do ' . $this->nome;
	}

	public static function dataCarencia() {
		return mktime(0,0,0,06,10,2018); # 1º jogo do brasil COP18
	}
}
