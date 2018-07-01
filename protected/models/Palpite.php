<?php

class Palpite extends CActiveRecord {

	public function tableName() {
		return 'palpite';
	}

	public function rules() {
		return [
			['idUsuario, idBolao, idJogo, golsMandante, golsVisitante', 'required'],
			['idUsuario, idBolao, idJogo, pontos', 'numerical', 'integerOnly'=>true],
			['golsMandante, golsVisitante', 'numerical', 'min' => 0, 'max' => 100],
			['golsMandante, golsVisitante','default','setOnEmpty'=>true],
			['vencedor', 'length', 'max'=>1],
			['idUsuario, idBolao, idJogo, golsMandante, golsVisitante, vencedor, pontos', 'safe', 'on'=>'search'],
		];
	}

	public function relations() {
		return [];
	}

	public function attributeLabels() {
		return [
			'idUsuario' => 'Id Usuario',
			'idBolao' => 'Id Bolao',
			'idJogo' => 'Id Jogo',
			'golsMandante' => 'Gols Mandate',
			'golsVisitante' => 'Gols Visitante',
			'vencedor' => 'Vencedor',
			'pontos' => 'Pontos',
		];
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

}