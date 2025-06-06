<?php
/**
 * 2007-2014 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 *Licensed under the Apache License, Version 2.0 (the "License");
 *you may not use this file except in compliance with the License.
 *You may obtain a copy of the License at
 *
 *http://www.apache.org/licenses/LICENSE-2.0
 *
 *Unless required by applicable law or agreed to in writing, software
 *distributed under the License is distributed on an "AS IS" BASIS,
 *WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *See the License for the specific language governing permissions and
 *limitations under the License.
 *
 *  @author    PagSeguro Internet Ltda.
 *  @copyright 2007-2014 PagSeguro Internet Ltda.
 *  @license   http://www.apache.org/licenses/LICENSE-2.0
 */

/***
 * Represent a list with accepted payment methods
 */
class PagSeguroAcceptedPaymentMethods
{

    /**
     * @var
     */
    private $acceptedPaymentsList;

    /**
     * @param array|null $config
     */
    public function __construct(?array $config = null)
    {
        if (!is_null($config) && count($config) > 0) {
            $this->setConfig($config);
        }
    }

    /**
     * @param PagSeguroAcceptedPayments $acceptedPayments
     */
    public function addConfig(PagSeguroAcceptedPayments $acceptedPayments)
    {
        $this->acceptedPaymentsList[] = $acceptedPayments;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        $this->acceptedPaymentsList = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        if ($this->acceptedPaymentsList == null) {
            $this->acceptedPaymentsList = array();
        }
        return $this->acceptedPaymentsList;
    }
}
