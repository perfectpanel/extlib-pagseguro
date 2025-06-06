<?php
/*
 ************************************************************************
 Copyright [2014] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 ************************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

class NotificationListener
{

    public static function main()
    {

        $code = (isset($_POST['notificationCode']) && trim((string) $_POST['notificationCode']) !== "" ?
            trim((string) $_POST['notificationCode']) : null);
        $type = (isset($_POST['notificationType']) && trim((string) $_POST['notificationType']) !== "" ?
            trim((string) $_POST['notificationType']) : null);

        if ($code && $type) {

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
                    LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");

            }

            self::printLog($strType);

        } else {

            LogPagSeguro::error("Invalid notification parameters.");
            self::printLog();

        }

    }

    private static function transactionNotification($notificationCode)
    {

        $credentials = PagSeguroConfig::getAccountCredentials();

        try {
            $transaction = PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
            // Do something with $transaction
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function authorizationNotification($notificationCode)
    {

        $credentials = PagSeguroConfig::getApplicationCredentials();

        try {
            $authorization = PagSeguroNotificationService::checkAuthorization($credentials, $notificationCode);

            // Do something with $authorization
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function preApprovalNotification($preApprovalCode)
    {

        $credentials = PagSeguroConfig::getAccountCredentials();

        try {
            $preApproval = PagSeguroNotificationService::checkPreApproval($credentials, $preApprovalCode);
            // Do something with $preApproval
            
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    private static function printLog($strType = null)
    {
        $count = 4;
        echo "<h2>Receive notifications</h2>";
        if ($strType) {
            echo "<h4>notifcationType: $strType</h4>";
        }
        echo "<p>Last <strong>$count</strong> items in <strong>log file:</strong></p><hr>";
        echo LogPagSeguro::getHtml($count);
    }
}

NotificationListener::main();
