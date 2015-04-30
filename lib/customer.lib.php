<?php

namespace argofire\request {

    class ArgoFireCustomerPaymentMethods extends ArgoFireRequest {
        protected $_wsdlPath = "customerpaymethods";
        protected $_wsdlRequestMethod = "GetPaymentMethodsByCustomer";
        protected $_wsdlResponseMethod = "GetPaymentMethodsByCustomerResult";

        public function GetPaymentMethodsByCustomer($requestData = []) {
            $this->_setRequestData([
                'MerchantKey' => \argofire\Config::getConfigOption('vendor'),
                'CustomerKey' => (isset($requestData['CustomerKey']) ? $requestData['CustomerKey'] : false)
            ]);

            return $this->_sendRequest();
        }

        protected function _handleResponse($response) {
            return new \argofire\response\CustomerPaymentMethodsResponse($response, $this->_wsdlResponseMethod);
        }
    }

    class ArgoFireCustomer extends ArgoFireRequest {
        protected $_wsdlPath = "recurring";
        protected $_wsdlRequestMethod = "ManageCustomer";
        protected $_wsdlResponseMethod = "ManageCustomerResult";
        protected $_transactionTypes = array(
            'ADD', 'UPDATE', 'DELETE'
        );

        public function modifyCustomerProfile($transactionType = false, $customerProfile = []) {
            if (!in_array($transactionType, $this->_transactionTypes)) {
                return false;
            } else {
                $customerProfile += \argofire\types\ArgofireCustomer::$customerFields;
                $customerProfile['TransType'] = $transactionType;
                $this->_setRequestData($customerProfile);

                return $this->_sendRequest();
            }
        }

        public function modifyPaymentProfile($transactionType = false, $paymentProfile = [], $paymentType = "CreditCard") {
            switch ($paymentType) {
                case "CreditCard" : {
                    $paymentProfileObject = new ArgoFireCreditCardProfile();
                } break;
                case "Check" : {
                    $paymentProfileObject = new ArgoFireCheckProfile();
                } break;
            }

            if (isset($paymentProfileObject))
                return $paymentProfileObject->modifyPaymentProfile($transactionType, $paymentProfile);
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ManageCustomerResponse($response, $this->_wsdlResponseMethod);
        }

    }

    class ArgoFireCreditCardProfile extends ArgoFireRequest {
        protected $_wsdlPath = "recurring";
        protected $_wsdlRequestMethod = "ManageCreditCardInfo";
        protected $_wsdlResponseMethod = "ManageCreditCardInfoResult";
        protected $_transactionTypes = array(
            'ADD', 'UPDATE', 'DELETE'
        );

        public function modifyPaymentProfile($transactionType = false, $paymentProfile = []) {
            if (!in_array($transactionType, $this->_transactionTypes)) {
                return false;
            } else {
                $paymentProfile += \argofire\types\ArgoFirePaymentProfile::$ccFields;
                $paymentProfile['TransType'] = $transactionType;
                $this->_setRequestData($paymentProfile);

                return $this->_sendRequest();
            }
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ManageCreditCardInfoResult($response, $this->_wsdlResponseMethod);
        }

    }

    class ArgoFireCheckProfile extends ArgoFireRequest {
        protected $_wsdlPath = "recurring";
        protected $_wsdlRequestMethod = "ManageCheckInfo";
        protected $_wsdlResponseMethod = "ManageCheckInfoResult";
        protected $_transactionTypes = array(
            'ADD', 'UPDATE', 'DELETE'
        );

        public function modifyPaymentProfile($transactionType = false, $paymentProfile = []) {
            if (!in_array($transactionType, $this->_transactionTypes)) {
                return false;
            } else {
                $paymentProfile += \argofire\types\ArgoFirePaymentProfile::$checkFields;
                $paymentProfile['TransType'] = $transactionType;
                $this->_setRequestData($paymentProfile);

                return $this->_sendRequest();
            }
        }

        protected function _setRequestData($requestData) {
            $this->_requestData = $requestData;
        }

        protected function _handleResponse($response) {
            return new \argofire\response\ManageCheckInfoResult($response, $this->_wsdlResponseMethod);
        }

    }

}

namespace argofire\response {

    class CustomerPaymentMethodsResponse extends ArgoFireResponse {

        public function isOK() {
            return (bool)$this->_getElementContents("PayMethod");
        }

		public function currentAccountNumber($paymentProfileId = false) {
			foreach ($this->_response->{$this->_wsdlResponseMethod}->PayMethod as $payMethod) {
				if ($payMethod->Key == $paymentProfileId) {
					return $payMethod->AccountNumber;
				}
			}
            return false;
		}

		public function currentCardType($paymentProfileId = false) {
			foreach ($this->_response->{$this->_wsdlResponseMethod}->PayMethod as $payMethod) {
				if ($payMethod->Key == $paymentProfileId)
					return $payMethod->PaymentType;
			}
            return false;
		}

		public function currentExpDate($paymentProfileId = false) {
			foreach ($this->_response->{$this->_wsdlResponseMethod}->PayMethod as $payMethod) {
				if ($payMethod->Key == $paymentProfileId) {
					return $payMethod->ExpDate;
                }
			}
            return false;
		}

		public function allPaymentProfiles() {
            $payMethods = [];
            foreach ($this->_response->{$this->_wsdlResponseMethod}->PayMethod as $payMethod) {
                $payMethods[] = $payMethod;
            }

            return $payMethods;
		}
        
        public function hasPaymentMethod($iPaymentProfileId = false) {
            foreach ($this->_response->{$this->_wsdlResponseMethod}->PayMethod as $oPayMethod) {
                if ($oPayMethod->Key == $iPaymentProfileId)
                    return true;
            }
            
            return false;
        }
    }

    class ManageCustomerResponse extends ArgoFireResponse {

        public function getCustomerProfileId() {
            return $this->_getElementContents("CustomerKey");
        }

    }

    class ManageCreditCardInfoResult extends ArgoFireResponse {

        public function getPaymentProfileId() {
            return $this->_getElementContents("CcInfoKey");
        }

    }

    class ManageCheckInfoResult extends ArgoFireResponse {

        public function getPaymentProfileId() {
            return $this->_getElementContents("CheckInfoKey");
        }

    }

}