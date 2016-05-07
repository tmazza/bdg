<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $nome
 * @property string $email
 * @property string $senha
 */
class User extends CActiveRecord
{

	const TipoCliente = 0;
	const TipoGerente = 1;

	public $senha2;
	public $qtdLogins;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome, email', 'required'),
			array('nome', 'length', 'max'=>128),
			array('email', 'length', 'max'=>400),
			array('senha', 'compare','compareAttribute'=>'senha2','on'=>'register', 'message' => 'A senha deve ser exatamente repetida.'),
			array('id, nome, email, senha,social,social_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'logins' => array(self::HAS_MANY,'UserLogin','user_id'),
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
			'email' => 'Email',
			'senha' => 'Senha',
			'senha2' => 'Repita a senha',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * Busca um usuário pelo email. (usado por hoauth login)
	 * @param string $email
	 * @access public
	 * @return User
	 */
	public function findByEmail($email){
		return self::model()->findByAttributes(array('email' => $email));
	}

	public static function add($form){
		return self::addUser(User::TipoCliente,$form->nome,$form->email,$form->senha);
	}

	public static function addSocial($nome,$email,$socialId){
		return self::addUser(User::TipoCliente,$nome,$email,null,1,$socialId);
	}

	public static function addUser($tipo,$nome,$email,$senha=null,$social=0,$socialId=null){
		$model = new User();
		$model->nome = $nome;
		$model->senha = CPasswordHelper::hashPassword($senha);
		$model->email = $email;
		$model->social = $social;
		$model->social_id = $socialId;
		$model->tipo = $tipo;
		if($model->save()){
			Yii::app()->authManager->assign('cliente',$model->id);
			return $model;
		} else {
			return false;
		}
	}

	public function criarNovo(){
		$this->senha = CPasswordHelper::hashPassword($this->senha);
		return $this->save();
	}

	public static function saveLogin(){
		$userLogin = new UserLogin();
		$userLogin->user_id = Yii::app()->user->id;
		$userLogin->data = time();
		$userLogin->ip = $_SERVER['REMOTE_ADDR'];
		$userLogin->save();
	}

	public function scopes(){
		return array();
	}


}
