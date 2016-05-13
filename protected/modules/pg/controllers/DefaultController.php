<?php
/**
 * DefaultController
 *
 * @author tmazza
 */
class DefaultController extends PgController {

    public function actionIndex() {
      $this->redirecionaParaPagamento();
      $this->render('index', []);
    }

    private function redirecionaParaPagamento(){
        $paymentRequest = new PagSeguroPaymentRequest();
        $paymentRequest->addItem('0001', 'Notebook', 1, 2430.00);
        $paymentRequest->addItem('0002', 'Mochila',  1, 150.99);

        $sedexCode = PagSeguroShippingType::getCodeByType('NOT_SPECIFIED');
        $paymentRequest->setShippingType($sedexCode);

        $paymentRequest->setSender(
        	'João Comprador',
        	'email@comprador.com.br',
        	'11',
        	'56273440',
        	'CPF',
        	'156.009.442-76'
        );

        $paymentRequest->setCurrency("BRL");
        // Referenciando a transação do PagSeguro em seu sistema
        $paymentRequest->setReference("REF123");
        // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento
        $paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");
        // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação
        $paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');

        try {
          $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
          $checkoutUrl = $paymentRequest->register($credentials);
          echo $checkoutUrl;
        } catch (PagSeguroServiceException $e) {
          die($e->getMessage());
        }
    }


}
