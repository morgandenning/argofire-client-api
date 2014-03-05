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
            'ExtData' => ''
        );

        static public $checkFields = array(
            //
        );

        //

        static public $ccFieldsRecurring = array(
            'CcInfoKey' => '',
            'Amount' => '',
            'InvNum' => '',
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
            'ExtData' => ''
        );

        static public $checkFields = array(
            'TransType' => '',
            'CustomerKey' => '',
            'CheckInfoKey' => '',
            'CheckType' => '',
            'AccountType' => '',
            'CheckNum' => '',
            'MICR' => '',
            'AccountNum' => '',
            'TransitNum' => '', // Routing Number
            'SS' => '', // Account Holder Social Security Number
            'DOB' => '', // Account Holder DOB
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
            'CountryID' => '',
            'ExtData' => ''
        );
    }