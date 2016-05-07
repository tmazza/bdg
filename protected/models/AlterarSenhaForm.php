<?php

/**
 * Description of ShCadastro
 *
 * @author tmazza
 */
class AlterarSenhaForm extends CFormModel {

    public $senha;
    public $senhaConfirma;

    public function rules() {
        return array(
            array('senha, senhaConfirma', 'required'),
            array('senha', 'length', 'min' => 6, 'max' => 16, 'tooShort' => 'No mínimo {min} caracteres.', 'tooLong' => 'No máximo {max} caracteres.'),
            array('senhaConfirma', 'compare', 'compareAttribute' => 'senha', 'message' => 'Senhas diferentes.'),
        );
    }
    public function attributeLabels() {
        return array(
            'senha' => 'Nova senha',
            'senhaConfirma' => 'Confirmar senha',
        );
    }

}
