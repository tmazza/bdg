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
		return array(
			'bolaos' => array(self::HAS_MANY, 'Bolao', 'codCampeonato'),
			'jogos' => array(self::HAS_MANY, 'Jogo', 'codCampeonato'),
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('inicio',$this->inicio,true);
		$criteria->compare('fim',$this->fim,true);
		$criteria->compare('situacao',$this->situacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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

	public function jogosPorDia(){
		$dias = [];
		foreach ($this->jogos as $j) {
			list($dia,$mes,$ano) = explode('-',date('d-m-Y',strtotime($j->data)));
			$key = mktime(0,0,0,$mes,$dia,$ano);
			if(!isset($dias[$key]))
				$dias[$key] = [];
			$dias[$key][] = $j;
		}
		ksort($dias);
		return $dias;
	}

}
