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

    public static function searchByInterval()
    {

        // Substitute the code below
        $days = 20;

        try {

            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
            $credentials = PagSeguroConfig::getAccountCredentials();

            $result = PagSeguroPreApprovalSearchService::searchByInterval($credentials, $days);

            self::printResult($result);

        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public static function printResult($result, $initialDate = null, $finalDate = null)
    {

        echo mb_convert_encoding("<h2>Consulta de Assinatura:</h2>", 'ISO-8859-1');
        echo "<p><strong> Date: </strong>".$result->getDate() ."</p> ";
        echo "<p><strong> Results in this Page: </strong>".$result->getResultsInThisPage() ."</p> ";
        echo "<p><strong> Total Page: </strong>".$result->getTotalPages() ."</p> ";
        echo "<p><strong> Current Page: </strong>".$result->getCurrentPage() ."</p> ";

        echo "<h2>Assinaturas: </h2> ";

        $preApprovals = $result->getPreApprovals();
        
        if (is_array($preApprovals)) {
            $i = 1;

            foreach ($preApprovals as $preApproval ){
                if (is_array($preApproval)) {
                    $preApproval = new PagSeguroPreApproval($preApproval);
                }

                echo "<p><strong>Assinatura </strong>". $i++ . "</p>";
                echo "<p><strong> Name: </strong>".$preApproval->getName() ."</p> ";
                echo "<p><strong> Date: </strong>".$preApproval->getDate() ."</p> ";
                echo "<p><strong> LastEventDate: </strong>".$preApproval->getLastEventDate() ."</p> ";
                echo "<p><strong> Code: </strong>".$preApproval->getCode() ."</p> ";
                echo "<p><strong> Tracker: </strong>".$preApproval->getTracker() ."</p> ";
                echo "<p><strong> Reference: </strong>".$preApproval->getReference() ."</p> ";
                echo "<p><strong> Status: </strong>".$preApproval->getStatus()->getTypeFromValue() ."</p> ";
                echo "<p><strong> Charge: </strong>".$preApproval->getCharge() ."</p> ";
                echo "<br>";
            }
            echo "<pre>";    
        
        } else {
            
            echo "Sem resultados para o per&iacute;odo solicitado.";
        }
    }
}

SearchPreApproval::searchByInterval();
