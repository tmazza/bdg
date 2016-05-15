<?php

/**
 * Gera link de solicitação de pagamento. Salva transação gerada.
 *
 * @author tmazza
 */
class PaymentRequestGenerator {

  /**
   * @param $id Bolao sendo comprado
   * @return (string) link para página de pagamento
   */
  public static function pagamentoBolao($bolao){
    $paymentRequest = new PagSeguroPaymentRequest();
    $paymentRequest->addItem('0001',$bolao->nome, 1, number_format($bolao->valorInscricao,2));

    $transaction = Yii::app()->db->beginTransaction();

    $pedido = new Pedido();
    $pedido->status = Pedido::StatusAguardando;
    $pedido->data = time();
    $pedido->idUsuario = Yii::app()->user->id;
    $pedido->idBolao = $bolao->idBolao;

    if(!$pedido->save())
      return false;

    $codPedido = str_pad($pedido->id,8,'0',STR_PAD_LEFT);
    $paymentRequest->setReference($codPedido);

    $sedexCode = PagSeguroShippingType::getCodeByType('NOT_SPECIFIED');
    $paymentRequest->setShippingType($sedexCode);
    $paymentRequest->setCurrency("BRL");

    try {
      $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
      $checkoutUrl = $paymentRequest->register($credentials);

      $pedido->linkTransacao = $checkoutUrl;
      $pedido->update(['linkTransacao']);

      $transaction->commit();
      return $checkoutUrl;
    } catch (PagSeguroServiceException $e) {

      $transaction->rollback();
      return false;
    }

  }

}
