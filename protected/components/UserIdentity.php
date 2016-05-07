<?php
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $user = User::model()->findByAttributes(array(
            'email' => $this->username,
        ));
        if (is_null($user)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif (!CPasswordHelper::verifyPassword($this->password, $user->senha)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->setInfosNaSessao($user);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function setInfosNaSessao($user) {
        $this->_id = $user->id;
        Yii::app()->user->setState('nome', is_null($user->nome) ?  '--' : $user->nome);
        Yii::app()->user->setState('tipo', $user->tipo);
    }

    public function getId() {
        return $this->_id;
    }

}
