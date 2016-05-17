<?php

/**
 * This is the model class for table "equipe".
 *
 * The followings are the available columns in table 'equipe':
 * @property integer $id
 * @property string $nome
 * @property string $abreviacao
 * @property string $brasao
 * @property integer $tipo
 */
class Equipe extends CActiveRecord
{

	const TFutSerieA = 1;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'equipe';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome, brasao, tipo', 'required'),
			array('tipo', 'numerical', 'integerOnly'=>true),
			array('abreviacao', 'length', 'max'=>10),
			array('brasao', 'length', 'max'=>120),
			array('id, nome, abreviacao, brasao, tipo', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'nome' => 'Nome',
			'abreviacao' => 'Abreviacao',
			'brasao' => 'Brasao',
			'tipo' => 'Tipo',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Equipe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function imagemBrasao($size='M',$htmlOptions=[]){
		$style = isset($htmlOptions['style']) ? $htmlOptions['style'] : '';
		if($size == 'PP')
			$style .= 'width:15px;';
		elseif($size == 'P')
			$style .= 'width:30px;';
		elseif($size == 'M')
			$style .= 'width:45px;';
		$htmlOptions['style'] = $style;
		return CHtml::image(Yii::app()->controller->assetsDir . '/images/equipes/' . $this->brasao,'',$htmlOptions);
	}

}
