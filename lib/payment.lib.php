<?php

namespace argofire\request {

    class ArgoFirePayment extends ArgoFireRequest {
        public function processTransaction($paymentProfile, $paymentType = "CreditCard") {
            switch ($paymentType) {
                case "CreditCard" : {
                    if (isset($paymentProfile['CcInfoKey'])) {
                        $paymentObject = new ArgoFireRecurringCreditCardPayment();
                    } else {
                        $paymentObject = new ArgoFireCreditCardPayment();
                    }
                } break;
                case "Check" : {
                    if (isset($paymentProfile['CheckInfoKey'])) {
                        $paymentObject = new ArgoFireRecurringCheckPayment();
                    } else {
                        $paymentObject = new ArgoFireCheckPayment();
                    }
                }
            }

            if ($paymentObject)
                return $paymentObject->submitTransaction($paymentProfile);
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ManagePaymentResponse($response, $this->_wsdlResponseMethod);
        }

    }


    class ArgoFireCreditCardPayment extends ArgoFireRequest {
        protected $_wsdlPath = "transaction";
        protected $_wsdlRequestMethod = "ProcessCreditCard";
        protected $_wsdlResponseMethod = "ProcessCreditCardResult";

        public function submitTransaction($paymentProfile) {
            $paymentProfile += \argofire\types\ArgoFirePayment::$ccFields;
            $this->_setRequestData($paymentProfile);

            return $this->_sendRequest();
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ProcessCreditCardResponse($response, $this->_wsdlResponseMethod);
        }

    }

    class ArgoFireRecurringCreditCardPayment extends ArgoFireRequest {
        protected $_wsdlPath = "recurring";
        protected $_wsdlRequestMethod = "ProcessCreditCard";
        protected $_wsdlResponseMethod = "ProcessCreditCardResult";

        public function submitTransaction($paymentProfile) {
            $paymentProfile += \argofire\types\ArgoFirePayment::$ccFieldsRecurring;
            $this->_setRequestData($paymentProfile);

            return $this->_sendRequest();
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ProcessRecurringCreditCardResponse($response, $this->_wsdlResponseMethod);
        }

    }

    class ArgoFireCheckPayment extends ArgoFireRequest {
        protected $_wsdlPath = "smartpayments";
        protected $_wsdlRequestMethod = "ProcessCheck";
        protected $_wsdlResponseMethod = "ProcessCheckResult";

        public function submitTransaction($paymentProfile) {
            $paymentProfile += \argofire\types\ArgoFirePayment::$checkFields;
            $this->_setRequestData($paymentProfile);

            return $this->_sendRequest();
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ProcessCheckResponse($response, $this->_wsdlResponseMethod);
        }
    }

    class ArgoFireRecurringCheckPayment extends ArgoFireRequest {
        protected $_wsdlPath = "recurring";
        protected $_wsdlRequestMethod = "ProcessCheck";
        protected $_wsdlResponseMethod = "ProcessCheckResult";

        public function submitTransaction($paymentProfile) {
            $paymentProfile += \argofire\types\ArgoFirePayment::$checkFieldsRecurring;
            $this->_setRequestData($paymentProfile);

            return $this->_sendRequest();
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ProcessRecurringCheckResponse($response, $this->_wsdlResponseMethod);
        }

    }

}

namespace argofire\response {

    class ManagePaymentResponse extends ArgoFireResponse {
        //
    }

    class ProcessCreditCardResponse extends ArgoFireResponse {

        public function isOk() {
            return ($this->getResultCode() == 0);
        }

        public function getResponseMessage() {
            return $this->_getElementContents("Message");
        }

        public function getResultCode() {
            return $this->_getElementContents("Result");
        }

        public function getResultMessage() { # Poorly Named in ArgoFire
            return $this->_getElementContents("Error");
        }

        public function getAuthCode() {
            return $this->_getElementContents("AuthCode");
        }

        public function getReferenceCode() {
            return $this->_getElementContents("PNRef");
        }

        public function getAVSResult() {
            return $this->_getElementContents("GetAVSResult");
        }

        public function getCVResult() {
            return $this->_getElementContents("GetCVResult");
        }

    }

    class ProcessRecurringCreditCardResponse extends ArgoFireResponse {

        public function isOk() {
            return ($this->getResultCode() == 0);
        }

        public function getResponseMessage() {
            return $this->_getElementContents("Message");
        }

        public function getResultCode() {
            return $this->_getElementContents("Result");
        }

        public function getAuthCode() {
            return $this->_getElementContents("AuthCode");
        }

        public function getReferenceCode() {
            return $this->_getElementContents("PNRef");
        }

    }

    class ProcessCheckResponse extends ArgoFireResponse {

        public function isOk() {
            return ($this->getResultCode() == 0);
        }

        public function getResponseMessage() {
            return $this->_getElementContents("Message");
        }

        public function getResultCode() {
            return $this->_getElementContents("Result");
        }

        public function getResultMessage() { # Poorly Named in ArgoFire
            return $this->_getElementContents("Error");
        }

        public function getAuthCode() {
            return $this->_getElementContents("AuthCode");
        }

        public function getReferenceCode() {
            return $this->_getElementContents("PNRef");
        }

    }


    class ProcessRecurringCheckResponse extends ArgoFireResponse {

        public function isOk() {
            return ($this->getResultCode() == 0);
        }

        public function getResponseMessage() {
            return $this->_getElementContents("Message");
        }

        public function getResultCode() {
            return $this->_getElementContents("Result");
        }

        public function getResultMessage() { # Poorly Named in ArgoFire
            return $this->_getElementContents("Error");
        }

        public function getAuthCode() {
            return $this->_getElementContents("AuthCode");
        }

        public function getReferenceCode() {
            return $this->_getElementContents("PNRef");
        }

    }

}