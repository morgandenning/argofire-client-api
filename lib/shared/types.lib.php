<?php

namespace argofire\types;

    class ArgoFireCustomer {
        static public $customerFields = array(
            'TransType'=> '',
            'CustomerKey'=> '',
            'CustomerID'=> '',
            'CustomerName'=> '',
            'FirstName'=> '',
            'LastName'=> '',
            'Title'=> '',
            'Department'=> '',
            'Street1'=> '',
            'Street2'=> '',
            'Street3'=> '',
            'City'=> '',
            'StateID'=> '',
            'Province'=> '',
            'Zip'=> '',
            'CountryID'=> '',
            'Email'=> '',
            'DayPhone'=> '',
            'NightPhone'=> '',
            'Fax'=> '',
            'Email'=> '',
            'Mobile'=> '',
            'Status'=> '',
            'ExtData' => ''
        );
    }

    class ArgoFirePayment {

        static public $ccFields = array(
            'CcInfoKey' => '',
            'TransType' => '',
            'CardNum' => '',
            'ExpDate' => '',
            'NameOnCard' => '',
            'Amount' => '',
            'InvNum' => '',
            'PNRef' => '',
            'Zip' => '',
            'Street' => '',
            'CVNum' => '',
            'ExtData' => '<TaxAmt>0.00</TaxAmt>'
        );

        static public $checkFields = array(
            'TransType' => '',
            'CheckNum' => '',
            'TransitNum' => '',
            'AccountNum' => '',
            'Amount' => '',
            'MICR' => '',
            'NameOnCheck' => '',
            'DL' => '',
            'SS' => '',
            'DOB' => '',
            'StateCode' => '',
            'CheckType' => '',
            'ExtData' => '',
            'ACH_Payment_Type' => 'PPD'
        );

        //

        static public $ccFieldsRecurring = array(
            'CcInfoKey' => '',
            'Amount' => '',
            'InvNum' => '',
            'ExtData' => '<TaxAmt>0.00</TaxAmt>'
        );

        static public $checkFieldsRecurring = array(
            'CheckInfoKey' => '',
            'CheckType' => '',
            'AccountType' => '',
            'CheckNum' => '',
            'MICR' => '',
            'RawMICR' => '',
            'AccountNum' => '',
            'TransitNum' => '',
            'SS' => '',
            'DOB' => '',
            'BranchCity' => '',
            'DL' => '',
            'StateCode' => '',
            'NameOnCheck' => '',
            'Email' => '',
            'DayPhone' => '',
            'Street1' => '',
            'Street2' => '',
            'Street3' => '',
            'City' => '',
            'StateID' => '',
            'Province' => '',
            'PostalCode' => '',
            'CountryID' => '',
            'ExtData' => ''
        );
    }

    class ArgoFireTransaction {
        public $amount;
        public $tax;
        public $lineItems = array();
        public $customerProfileId;
        public $customerPaymentProfileId;
        public $creditCardNumberMasked;
        public $bankRoutingNumberMasked;
        public $bankAccountNumberMasked;
        public $cardCode;
        public $approvalCode;
        public $transId;

        //
    }

    class ArgoFirePaymentProfile {
        static public $ccFields = array(
            'TransType' => '',
            'CustomerKey' => '',
            'CardInfoKey' => '',
            'CcAccountNum' => '',
            'CcExpDate' => '',
            'CcNameOnCard' => '',
            'CcStreet' => '',
            'CcZip' => '',
            'ExtData' => '<TaxAmt>0.00</TaxAmt>'
        );

        static public $checkFields = array(
            'CheckInfoKey' => '',
            'CheckType' => '',
            'AccountType' => '',
            'CheckNum' => '',
            'MICR' => '',
            'RawMICR' => '',
            'AccountNum' => '',
            'TransitNum' => '',
            'SS' => '',
            'DOB' => '',
            'BranchCity' => '',
            'DL' => '',
            'StateCode' => '',
            'NameOnCheck' => '',
            'Email' => '',
            'DayPhone' => '',
            'Street1' => '',
            'Street2' => '',
            'Street3' => '',
            'City' => '',
            'StateID' => '',
            'Province' => '',
            'PostalCode' => '',
            'CountryID' => '',
            'ExtData' => ''
        );
    }