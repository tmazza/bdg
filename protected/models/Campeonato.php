<?php

/**
 * This is the model class for table "campeonato".
 *
 * The followings are the available columns in table 'campeonato':
 * @property string $codigo
 * @property string $nome
 * @property string $inicio
 * @property string $fim
 * @property string $situacao
 *
 * The followings are the available model relations:
 * @property Bolao[] $bolaos
 * @property Jogo[] $jogos
 */
class Campeonato extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'campeonato';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('codigo, nome, inicio, fim, situacao', 'required'),
			array('codigo', 'length', 'max'=>5),
			array('nome', 'length', 'max'=>80),
			array('situacao', 'length', 'max'=>1),
			array('codigo, nome, inicio, fim, situacao', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$inicioDoDiaDeHoje = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d'),date('Y')));
		return array(
			'boloes' => array(self::HAS_MANY, 'Bolao', 'codCampeonato'),
			'jogos' => array(self::HAS_MANY, 'Jogo', 'codCampeonato', 'order'=>'data ASC'),
			'jogosEmAberto' => [self::HAS_MANY, 'Jogo', 'codCampeonato',
				'condition'=>"data > '{$inicioDoDiaDeHoje}'",
			],
			'jogosFechados' => [self::HAS_MANY, 'Jogo', 'codCampeonato',
				'condition'=>"data <= '{$inicioDoDiaDeHoje}'",
			],
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'codigo' => 'Codigo',
			'nome' => 'Nome',
			'inicio' => 'Inicio',
			'fim' => 'Fim',
			'situacao' => 'Situacao',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Campeonato the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function jogosNesteDia($dia){
		list($d,$m,$y) = [date('d',$dia),date('m',$dia),date('Y',$dia)];
		return Jogo::model()->findAll([
			'condition' => "codCampeonato = '{$this->codigo}' " .
							"AND data >= '{$y}-{$m}-{$d} 00:00:00' ".
							"AND data <= '{$y}-{$m}-{$d} 23:59:59'",
		]);
	}

	public function jogosNesteDiaNaoProcessados($dia){
		list($d,$m,$y) = [date('d',$dia),date('m',$dia),date('Y',$dia)];
		return Jogo::model()->findAll([
			'condition' => "codCampeonato = '{$this->codigo}' " .
							"AND data >= '{$y}-{$m}-{$d} 00:00:00' ".
							"AND data <= '{$y}-{$m}-{$d} 23:59:59' ".
							"AND status != " . Jogo::StatusFechado,
		]);
	}

	public function jogosPorDiaFechados(){
		return $this->jogosPorDia($this->jogosFechados,false);
	}

	public function jogosPorDiaEmAberto(){
		return $this->jogosPorDia($this->jogosEmAberto);
	}

	/**
	 * Agrupa lista de jogos por dia
	 */
	public function jogosPorDia($jogos,$ascendente=true){
		$dias = [];
		foreach ($jogos as $j) {
			list($dia,$mes,$ano) = explode('-',date('d-m-Y',strtotime($j->data)));
			$key = mktime(0,0,0,$mes,$dia,$ano);
			if(!isset($dias[$key]))
				$dias[$key] = [];
			$dias[$key][] = $j;
		}
		if($ascendente){
			ksort($dias);
		} else {
			krsort($dias);
		}
		return $dias;
	}

}
