<?php
/**
 * EAuthUserIdentity class file.
 *
 * @author Maxim Zemskov <nodge@yandex.ru>
 * @link http://github.com/Nodge/yii-eauth/
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * EAuthUserIdentity is a base User Identity class to authenticate with EAuth.
 *
 * @package application.extensions.eauth
 */
class EAuthUserIdentity extends CBaseUserIdentity {

	const ERROR_NOT_AUTHENTICATED = 3;
	const ERROR_EMAIL_NAO_INFORMADO = 4;
	const ERROR_AO_CADASTRAR_USUARIO = 5;

	/**
	 * @var EAuthServiceBase the authorization service instance.
	 */
	protected $service;
	public $tipo=0;

	/**
	 * @var string the unique identifier for the identity.
	 */
	protected $id;

	/**
	 * @var string the display name for the identity.
	 */
	protected $name;

	/**
	 * Constructor.
	 *
	 * @param EAuthServiceBase $service the authorization service instance.
	 */
	public function __construct($service) {
		$this->service = $service;
	}

	/**
	 * Authenticates a user based on {@link service}.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate() {
		if ($this->service->isAuthenticated) {

			$id = $this->service->getAttribute('id',false);
			$nome = $this->service->getAttribute('name',false);
			$email = $this->service->getAttribute('email',false);

			if($email) {

					$this->errorCode = self::ERROR_NONE;

					$user = User::findByEmail($email);

					if(is_null($user)){ // Cadastro!
						$user = User::addSocial($nome,$email,$id);
						if(!$user) {
							HView::ferr("Erro ao cadastrar usuário.");
							$this->errorCode = self::ERROR_AO_CADASTRAR_USUARIO;
						} else {
							HEmail::templateSimples($user->email,"Bem-vindo(a)","Seja bem-vindo(a) ao Bolão do gordo<br><br>" . CHtml::link('Acesse sua conta',Yii::app()->params['domain']));
							HEmail::templateSimples(Yii::app()->params['adminEmail'],"Novo usuário!",$user->nome . ' <br> ' . $user->email);
						}
					}

					if(!$this->errorCode){
						$this->id = $user->id;
						$this->name = $user->nome;

						Yii::app()->user->setState('nome', is_null($user->nome) ?  '--' : $user->nome);
						Yii::app()->user->setState('tipo', $user->tipo);

					}

			} else {
					HView::ferr("Email não informado.");
					$this->errorCode = self::ERROR_EMAIL_NAO_INFORMADO;
			}
		} else {
			$this->errorCode = self::ERROR_NOT_AUTHENTICATED;
		}
		return !$this->errorCode;
	}

	/**
	 * Returns the unique identifier for the identity.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return string the unique identifier for the identity.
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Returns the display name for the identity.
	 * This method is required by {@link IUserIdentity}.
	 *
	 * @return string the display name for the identity.
	 */
	public function getName() {
		return $this->name;
	}
}
