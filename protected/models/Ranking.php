<?php

/**
 * This is the model class for table "ranking".
 *
 * The followings are the available columns in table 'ranking':
 * @property integer $idBolao
 * @property integer $idUsuario
 * @property integer $qtdExatos
 * @property integer $qtdVencedores
 * @property integer $pontos
 */
class Ranking extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ranking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idBolao, idUsuario', 'required'),
			array('idBolao, idUsuario, qtdExatos, qtdVencedores, pontos', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idBolao, idUsuario, qtdExatos, qtdVencedores, pontos', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idBolao' => 'Id Bolao',
			'idUsuario' => 'Id Usuario',
			'qtdExatos' => 'Qtd Exatos',
			'qtdVencedores' => 'Qtd Vencedores',
			'pontos' => 'Pontos',
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

		$criteria->compare('idBolao',$this->idBolao);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('qtdExatos',$this->qtdExatos);
		$criteria->compare('qtdVencedores',$this->qtdVencedores);
		$criteria->compare('pontos',$this->pontos);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ranking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
