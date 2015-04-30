<?php

namespace argofire\request;

    abstract class ArgoFireRequest {
        protected $_requestData;

        public function __construct() {}
        abstract protected function _handleResponse($response);

        protected function _sendRequest() {
            if ($this->_wsdlPath && $this->_wsdlRequestMethod && $this->_requestData) {
                $wsdlClient = new \SoapClient(\argofire\Config::getConfigOption('host') . \argofire\Config::getConfigOption("path_{$this->_wsdlPath}"), array('trace' => 1, 'exceptions' => true, 'features' => SOAP_SINGLE_ELEMENT_ARRAYS));
                $this->_requestData += array((in_array($this->_wsdlPath, ["transaction", "smartpayments"]) ? "UserName" : "Username") => \argofire\Config::getConfigOption('username'), 'Password' => \argofire\Config::getConfigOption('password'), 'Vendor' => \argofire\Config::getConfigOption('vendor'));

                $oRequest = $wsdlClient->{$this->_wsdlRequestMethod}($this->_requestData);

                return $this->_handleResponse($oRequest);
            }
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

    }

    class ProcessCreditCard {

        //

    }