<?php

/**
 * Description of ShCadastro
 *
 * @author tmazza
 */
class CadastroForm extends CFormModel {

    public $nome;
    public $email;
    public $senha;
    public $senhaConfirma;

    public function rules() {
        return array(
            array('nome, email, senha, senhaConfirma', 'required'),
            array('email', 'email', 'message' => '{attribute} válido.'),
            array('email', 'validaEmailChoice'),
            array('senha', 'length', 'min' => 6, 'max' => 16, 'tooShort' => 'No mínimo {min} caracteres.', 'tooLong' => 'No máximo {max} caracteres.'),
            array('senhaConfirma', 'compare', 'compareAttribute' => 'senha', 'message' => 'Senhas devem ser iguais.'),
        );
    }

    public function validaEmailChoice($attribute, $params) {
        $user = User::model()->findByAttributes(array(
          'email' => $this->{$attribute},
        ));
        if(!is_null($user)){
          $this->addError('email', 'Email ' . $this->{$attribute} . ' já esta sendo utilizado. <br>' . CHtml::link('Recuperar senha', '#modal2',array('data-uk-modal'=>"{target:'#cadastro-rec-senha'}")));
        }
    }

    public function attributeLabels() {
        return array(
            'nome' => 'Nome',
            'email' => 'Email',
            'senha' => 'Senha',
            'senhaConfirma' => 'Repita a senha',
        );
    }

    public function logaUsuario($user) {
        $identity = new UserIdentity($this->email, $this->senha);
        $identity->errorCode = UserIdentity::ERROR_NONE;
        $identity->setInfosNaSessao($user);
        return Yii::app()->user->login($identity, 60 * 60 * 24 * 7);
    }

    public static function getForm() {
        return array(
            'elements' => array(
                'nome' => array(
                    'type' => 'text',
                    'maxlength' => 32,
                ),
                'email' => array(
                    'type' => 'text',
                ),
                'senha' => array(
                    'type' => 'password',
                    'minlength' => 6,
                    'maxlength' => 16,
                ),
                'senhaConfirma' => array(
                    'type' => 'password',
                    'minlength' => 6,
                    'maxlength' => 16,
                ),
                '<br>',
            ),
            'buttons' => array(
                'cadastro' => array(
                    'type' => 'submit',
                    'label' => 'Finalizar cadastro',
                    'class' => 'btn btn-success',
                ),
        ));
    }

}
