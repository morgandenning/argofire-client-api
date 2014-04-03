<?php

namespace argofire\response;

    abstract class ArgoFireResponse {
        protected $_response;
        protected $_wsdlResponseMethod;

        public function __construct($response, $wsdlResponseMethod) {
            $this->_wsdlResponseMethod = $wsdlResponseMethod;

            if (gettype($response->{$this->_wsdlResponseMethod}) == "string") {
                libxml_use_internal_errors(true);
                $response->{$this->_wsdlResponseMethod} = simplexml_load_string($response->{$this->_wsdlResponseMethod});

                if (count(libxml_get_errors()) > 0) {
                    $response->{$this->_wsdlResponseMethod} = new \stdClass();
                    $response->{$this->_wsdlResponseMethod}->code = false;
                }

                libxml_clear_errors();
            }

            $this->_response = $response;
        }


        public function isOk() {
            return ($this->getResultCode() == "OK");
        }

        public function getResultCode() {
            return $this->_getElementContents("code");
        }


        protected function _getElementContents($elementName = null) {
            if ($elementName)
                return $this->_response->{$this->_wsdlResponseMethod}->{$elementName};
        }
    }