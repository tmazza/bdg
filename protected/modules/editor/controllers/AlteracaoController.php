<?php
/**
 * AlteracaoController
 *
 * @author tmazza
 */
class AlteracaoController extends EditorController {

  public function actionIndex() {
    $alteracoes = Alteracao::model()->findAll(['order'=>'status']);
    $this->render('index', [
      'alteracoes'=>$alteracoes,
    ]);
  }

  public function actionFechar($id) {
    $alteracao = Alteracao::model()->findByPk($id);
    $alteracao->status = Alteracao::StatusFechada;
    $alteracao->update(['status']);
    $this->redirect($this->createUrl('/editor/alteracao/index'));
  }

}
