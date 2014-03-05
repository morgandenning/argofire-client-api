argofire-client-api
===================

ArgoFire Client API (PHP)
-- Allows Interaction with ArgoFire Server API via PHP

-- Requirements: PHP 5.4+, Zend Framework 1.1+ (Zend_Config_Ini)


Usage:

<pre>
require_once "/path/to/argofire.lib.php"; # Include Library Wrapper
new \argofire\Config("/path/to/config.ini"); # Initialize Config Values

# One-Time Payment
$paymentObject = new \argofire\request\ArgoFirePayment();
  $paymentResponse = $paymentObject->processTransaction([
    'TransType' => 'Auth',
    'CardNumber' => '0000000000000000',
    'ExpDate' => '0101',
    'NameOnCard' => 'First Last',
    'Amount' => '1.00'
  ]);
</pre>

Raw Response:
<pre>
object(argofire\response\ProcessCreditCardResponse)#10 (2) {
  ["_response":protected]=>
  object(stdClass)#8 (1) {
    ["ProcessCreditCardResult"]=>
    object(stdClass)#9 (8) {
      ["Result"]=>
      int(0)
      ["RespMSG"]=>
      string(8) "Approved"
      ["Message"]=>
      string(8) "APPROVED"
      ["AuthCode"]=>
      string(6) "099856"
      ["PNRef"]=>
      string(6) "441287"
      ["HostCode"]=>
      string(8) "00000000"
      ["GetCommercialCard"]=>
      string(5) "False"
      ["ExtData"]=>
      string(113) "InvNum=1,CardType=VISA,BatchNum=000000<BatchNum>000000</BatchNum><ExpDate>0520</ExpDate><LastFour>0019</LastFour>"
    }
  }
  ["_wsdlResponseMethod":protected]=>
  string(23) "ProcessCreditCardResult"
}
</pre>


Handling Response: 
<pre>
if ($paymentResponse->isOK()) {
  # Transaction Successful
    $refCode = $paymentResponse->getReferenceCode();
}
</pre>


Capturing Auth Transaction:
<pre>
$paymentObject = new \argofire\request\ArgoFirePayment();
  $paymentResponse = $paymentObject->processTransaction([
    'TransType' => 'Force',
    'PNRef' => $refCode
  ]);
</pre>
