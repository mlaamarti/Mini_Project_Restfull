<?php
include 'header.php';

// A sample PHP Script to POST data using cURL
// Data in JSON format


if (isset($_POST['id']) && isset($_POST['cardnumber']) && isset($_POST['expiryDate']) && isset($_POST['controlNumber']) && isset($_POST['type']) ){

$id = $_POST["id"];
$cardnumber = $_POST["cardnumber"];
$expiryDate = $_POST['expiryDate'];
$controlNumber = $_POST['controlNumber'];
$type = $_POST['type'];
}

$data = array(
    'id' => $id,
    'number' => $cardnumber,
    'expiryDate' => $expiryDate,
    'controlNumber' => $controlNumber,
    'type' => $type,
    
);

 
$payload = json_encode($data);

  echo($payload);

$url = 'http://localhost:8080/api/v1/creditcard/'.$id;
// Prepare new cURL resource
$ch = curl_init('http://localhost:8080/api/v1/creditcard/'.$id);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($payload )));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS,$payload );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response  = curl_exec($ch);

// Close cURL session handle
curl_close($ch);

?>