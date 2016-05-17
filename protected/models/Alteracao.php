<?php

/**
 * This is the model class for table "alteracao".
 *
 * The followings are the available columns in table 'alteracao':
 * @property integer $id
 * @property string $codCampeonato
 * @property string $descricao
 * @property integer $numJogo
 * @property string $de
 * @property string $para
 * @property string $motivo
 * @property integer $data
 * @property integer $status
 */
class Alteracao extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alteracao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codCampeonato, numJogo, de, para, data', 'required'),
			array('numJogo, data, status', 'numerical', 'integerOnly'=>true),
			array('codCampeonato', 'length', 'max'=>5),
			array('descricao, motivo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codCampeonato, descricao, numJogo, de, para, motivo, data, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'codCampeonato' => 'Cod Campeonato',
			'descricao' => 'Descricao',
			'numJogo' => 'Num Jogo',
			'de' => 'De',
			'para' => 'Para',
			'motivo' => 'Motivo',
			'data' => 'Data',
			'status' => 'Status',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('codCampeonato',$this->codCampeonato,true);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('numJogo',$this->numJogo);
		$criteria->compare('de',$this->de,true);
		$criteria->compare('para',$this->para,true);
		$criteria->compare('motivo',$this->motivo,true);
		$criteria->compare('data',$this->data);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Alteracao the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
