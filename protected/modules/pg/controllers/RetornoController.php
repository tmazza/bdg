<?php
/**
 * RetornoController
 *
 * @author tmazza
 */
class RetornoController extends PgController {

    public function actionIndex($transaction_id=false) {
      if($transaction_id && !Yii::app()->user->isGuest){
        Yii::log("RETORNO após PG U:".Yii::app()->user->id . ' T: ' . $transaction_id , 'pg', 'pg.RetornoController.index');
        HView::fsuc('Seu pedido <b>'.$transaction_id.'</b> foi recebido. Estamos aguardando a confirmação de pagamento.');
      } else {
        HView::finf("Pedido aguardando pagamento.");
      }
      $this->redirect($this->createUrl('/site/index'));
    }

}
