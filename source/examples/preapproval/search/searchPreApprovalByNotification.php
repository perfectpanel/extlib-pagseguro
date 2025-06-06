<?php
/*
 * ***********************************************************************
 Copyright [2015] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 * ***********************************************************************
 */

require_once "../../../PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the service PagSeguroPreApprovalService
 */
class SearchPreApproval
{

    public static function searchByNotification()
    {

        // Substitute the code below with a valid code notification for your account
        $notificationCode = "29B0BEC9D653D653435EE42F3FAEF4461091";

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::findByNotification($credentials, $notificationCode);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printResult($result, $initialDate = null, $finalDate = null)
    {


            echo mb_convert_encoding("<h2>Consulta de Assinatura:</h2>", 'ISO-8859-1');
            echo "<p><strong> Name: </strong>".$result->getName() ."</p> ";
            echo "<p><strong> Date: </strong>".$result->getDate() ."</p> ";
            echo "<p><strong> LastEventDate: </strong>".$result->getLastEventDate() ."</p> ";
            echo "<p><strong> Code: </strong>".$result->getCode() ."</p> ";
            echo "<p><strong> Tracker: </strong>".$result->getTracker() ."</p> ";
            echo "<p><strong> Reference: </strong>".$result->getReference() ."</p> ";
            echo "<p><strong> Status: </strong>".$result->getStatus()->getTypeFromValue() ."</p> ";
            echo "<p><strong> Charge: </strong>".$result->getCharge() ."</p> ";
            echo "<pre>";
    }
}

SearchPreApproval::searchByNotification();

