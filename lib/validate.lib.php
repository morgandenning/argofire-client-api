<?php

namespace argofire\request {

    class ArgoFireValidate extends ArgoFireRequest {
        protected $_wsdlPath = "validate";
        protected $_wsdlRequestMethod = "ValidCard";
        protected $_wsdlResponseMethod = "ValidCardResult";

        public function ValidateCard(array $requestData = []) {
            $this->_setRequestData([
                'CardNumber' => (isset($requestData['CardNumber']) ? $requestData['CardNumber'] : false),
                'ExpDate' => (isset($requestData['ExpDate']) ? $requestData['ExpDate'] : false)
            ]);

            return $this->_sendRequest();
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ArgoFireValidateResponse($response, $this->_wsdlResponseMethod);
        }
    }

}

namespace argofire\response {

    class ArgoFireValidateResponse extends ArgoFireResponse {
        public function isValidCard() {
            if ($this->_response->{$this->_wsdlResponseMethod} === (int)0)
                return true;
            else
                return false;
        }

        public function isValidCardNum() {
            if ($this->_response->{$this->_wsdlResponseMethod} === (int)0)
                return true;
            else
                return false;
        }

        public function isValidExpDate() {
            if ($this->_response->{$this->_wsdlResponseMethod} !== (int)1002 && $this->_response->{$this->_wsdlResponseMethod} !== (int)1006)
                return true;
            else
                return false;
        }
    }

}