<?php
class NotificationListener {
    public static function main() {
        $code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== "" ?
            trim($_POST['notificationCode']) : null);
        $type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== "" ?
            trim($_POST['notificationType']) : null);

        if ($code && $type) {

            Yii::log("Cod: " . $code . ' tipo: ' . $type . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            switch ($strType) {
                case 'TRANSACTION':
                    self::transactionNotification($code);
                    break;
                case 'APPLICATION_AUTHORIZATION':
                    self::authorizationNotification($code);
                    break;
                case 'PRE_APPROVAL':
                    self::preApprovalNotification($code);
                    break;
                default:
                  Yii::log("Tipo de requisição desconhecido" . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
                  LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");
            }
            self::printLog($strType);
        } else {
            LogPagSeguro::error("Invalid notification parameters.");
            self::printLog();
        }
    }

    private static function transactionNotification($notificationCode) {
        Yii::log("Notificação do tipo TRANSACTION recebida." . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
        $credentials = PagSeguroConfig::getAccountCredentials();
        try {
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
            Yii::log("Conteudo not.: " . json_encode($transaction) . ' | ' . date("d/m/Y H:i:s"), 'pg', 'pg.DefaultController.listener');
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function authorizationNotification($notificationCode) {
        $credentials = PagSeguroConfig::getApplicationCredentials();
        try {
            $authorization = PagSeguroNotificationService::checkAuthorization($credentials, $notificationCode);
            // Do something with $authorization
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function preApprovalNotification($preApprovalCode) {
        $credentials = PagSeguroConfig::getAccountCredentials();
        try {
            $preApproval = PagSeguroNotificationService::checkPreApproval($credentials, $preApprovalCode);
            // Do something with $preApproval
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function printLog($strType = null) {
        $count = 4;
        echo "<h2>Receive notifications</h2>";
        if ($strType) {
            echo "<h4>notifcationType: $strType</h4>";
        }
        echo "<p>Last <strong>$count</strong> items in <strong>log file:</strong></p><hr>";
        echo LogPagSeguro::getHtml($count);
    }
}
