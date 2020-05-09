
<?php
include 'header.php';

// A sample PHP Script to POST data using cURL
// Data in JSON format


if (isset($_POST['id']) ){

$id = $_POST["id"];
}

$data = array(
    'id' => $id,
);

 
$payload = json_encode($data);
echo($payload);

$url = 'http://localhost:8080/api/v1/creditcard/'.$id;
// Prepare new cURL resource

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_POSTFIELDS,$payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$response  = curl_exec($ch);

// Close cURL session handle
curl_close($ch);

?>