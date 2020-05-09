<html>


<?php
include 'header.php';
$url = "http://localhost:8080/api/v1/creditcard"; // path to your JSON file
$data = file_get_contents($url); // put the contents of the file into a variable
$cards = json_decode($data); // decode the JSON feed

?>


  <br>  
<h3 class="text-center" class="display-4">List of The cards</h3>
    <br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Number</th>
      <th scope="col">Expiry Date</th>
      <th scope="col">Control Number</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  <?php foreach ($cards as $card) : ?>
  <tbody>
  
    <tr>
        <td> <?php echo $card->id; ?> </td>
        <td> <?php echo $card->number; ?> </td>
        <td> <?php echo $card->expiryDate; ?> </td>
        <td> <?php echo $card->controlNumber; ?> </td>
        <td> <?php echo $card->type; ?> </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</html>