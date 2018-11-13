<?php
/*
 * @description Cliente con las funciones para consumir el API
 * @author michel.lugo@pragma.com.co, jomgarci@bancolombia.com.co
 */
include 'awsSigner.php';

//$host = "api.sandbox.nequi.com";

$host = "a7zgalw2j0.execute-api.us-east-1.amazonaws.com";  
$channel = 'MF-001';

/**
 * Encapsula el consumo del servicio de validacion de cliente del API y retorna la respuesta del servicio
 */
function validateClient($clientId, $phoneNumber, $value) {
  /*$servicePath = "/qa/-services-clientservice-validateclient";
  $body = getBodyValidateClient($GLOBALS['channel'], $clientId, $phoneNumber, $value);
  $method = 'POST';*/
  
  $servicePath = "/qa/-services-paymentservice-generatecodeqr";
  $body = getBodyGenerateCodeQR($GLOBALS['channel'], $clientId, $value);
  $method = 'POST';

  /*$servicePath = "/qa/-services-paymentservice-getstatuspayment";
  $body = getBodyGetStatusPaymentRQ($GLOBALS['channel'], $clientId, "C001-10011-066327");
  $method = 'POST';*/

  /*$servicePath = "/partners/v1/-services-partnersservices-validate";
  $body = getBodyValidatePartnerRQ($GLOBALS['channel'], $clientId, "NIT", "1");
  $method = 'POST';*/
  
  $response = makeSignedRequest($GLOBALS['host'], $servicePath, $method, $body);  
  if(json_decode($response) == null){
    return $response;
  }else{
    return json_decode($response);
  }
}

/**
 * Forma el cuerpo para consumir el servicio de validación de cliente del API
 */
function getBodyValidateClient($channel, $clientId, $phoneNumber, $value){
  $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
  return array(
    "RequestMessage"  => array(
      "RequestHeader"  => array (
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId
      ),
      "RequestBody"  => array (
        "any" => array (
          "validateClientRQ" => array (
            "phoneNumber" => $phoneNumber,
            "value" => $value
          )
        )
      )
    )
  );
}

/**
 * Forma el cuerpo para consumir el servicio de generación de código QR del API
 */
function getBodyGenerateCodeQR($channel, $clientId, $value){
  $messageId =  substr(strval((new DateTime())->getTimestamp()), 0, 9);
  $body = array(
    "RequestMessage"  => array(
      "RequestHeader"  => array (
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId,
        "Destination" => array(
          "ServiceName" => "PaymentsService",
          "ServiceOperation" => "generateCodeQR",
          "ServiceRegion" => "C001",
          "ServiceVersion" => "1.0.0"
        )
      ),
      "RequestBody"  => array (
        "any" => array (
          "generateCodeQRRQ" => array (
            "code" => "NIT_1",
            "value" => $value,
            "reference1" => "reference1",
            "reference2" => "reference2",
            "reference3" => "reference3"
          )
        )
      )
    )
  );

  return $body;
}

/**
 * Forma el cuerpo para consumir el servicio de consulta del estado del pago con código QR del API
 */
function getBodyGetStatusPaymentRQ($channel, $clientId, $qrCode){
  $messageId = substr(strval((new DateTime())->getTimestamp()), 0, 9);
  $body = array(
    "RequestMessage" => array(
      "RequestHeader" => array(
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId,
        "Destination" => array(
          "ServiceName" => "PaymentsService",
          "ServiceOperation" => "getStatusPayment",
          "ServiceRegion" => "C001",
          "ServiceVersion" => "1.0.0"
        )
      ),
      "RequestBody" => array(
        "any" => array(
          "getStatusPaymentRQ" => array(
            "codeQR" => $qrCode
          )
        )
      )
    )
  );

  return $body;
}

/**
 * Forma el cuerpo para consumir el servicio de validación de comercios del API
 */
function getBodyValidatePartnerRQ($channel, $clientId, $type, $id){
  $messageId = substr(strval((new DateTime())->getTimestamp()), 0, 9);
  $body = array(
    "RequestMessage" => array(
      "RequestHeader" => array(
        "Channel" => $channel,
        "RequestDate" => gmdate("Y-m-d\TH:i:s\\Z"),
        "MessageID" => $messageId,
        "ClientID" => $clientId,
        "Destination" => array(
          "ServiceName" => "PartnersService",
          "ServiceOperation" => "validatePartner",
          "ServiceRegion" => "C001",
          "ServiceVersion" => "1.0.0"
        )
      ),
      "RequestBody" => array(
        "any" => array(
          "validatePartnerRQ" => array(
            "type" => $type,
            "id" => $id
          )
        )
      )
    )
  );

  return $body;
}

?>