<?php

/**
 * Email e tipo (caso não informados)
 */
class DadosAdicionaisForm extends CFormModel {

    public $email;
    public $time;

    public function rules() {
        return array(
            array('email, time', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'email' => 'Email',
            'time' => 'Time do coração',
        );
    }

}
