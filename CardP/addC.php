<?php
include 'header.php';

// A sample PHP Script to POST data using cURL
// Data in JSON format


if (isset($_POST['cardnumber']) && isset($_POST['expiryDate']) && isset($_POST['controlNumber']) && isset($_POST['type']) ){

$cardnumber = $_POST["cardnumber"];
$expiryDate = $_POST['expiryDate'];
$controlNumber = $_POST['controlNumber'];
$type = $_POST['type'];
}

$data = array(
    'number' => $cardnumber,
    'expiryDate' => $expiryDate,
    'controlNumber' => $controlNumber,
    'type' => $type,
    
);
 
$payload = json_encode($data);
echo($payload);
// Prepare new cURL resource
$ch = curl_init('http://localhost:8080/api/v1/creditcard');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
 
// Set HTTP Header for POST request 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: '.strlen($payload))
);
 
// Submit the POST request
$result = curl_exec($ch);

// Close cURL session handle
curl_close($ch);

?>