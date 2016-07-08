<?php
class Configuracao extends CFormModel {

	public $emailFechaDia;
	public $emailAvisoFechaDia;
	public $faceAvisoFechaDia;

    public function rules() {
	    return array(
	        array('emailFechaDia,emailAvisoFechaDia,faceAvisoFechaDia', 'required'),
	        array('emailFechaDia,emailAvisoFechaDia,faceAvisoFechaDia', 'boolean'),
	    );
    }

    public function attributeLabels() {
	    return array(	
            'emailFechaDia' => 'Email com o resultado das apostas do dia',
            'emailAvisoFechaDia' => 'Email avisando que as apostas do dia irão fechar',
            'faceAvisoFechaDia' => 'Notificação pelo Facebook avisando que as apostas do dia irão fechar',
    	);
	}
}	