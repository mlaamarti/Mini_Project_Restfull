<!doctype html>
<html lang="en">
  <head>
    <?php include 'header.php'; ?>
  </head>
  <body>

  <form action="./updateC.php" method="post">
   
    <br>
  <div class="container">
  <div class="row">
        <div class="col-sm">
            <label for="id">id</label>
            <input type="text" class="form-control" name="id" aria-describedby="id" placeholder="Enter id">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <label for="cardnumber">Card Number</label>
            <input type="text" class="form-control" name="cardnumber" aria-describedby="cardnumber" placeholder="Enter Card Number">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <label for="expiryDate">Expiry Date</label>
            <input type="text" class="form-control" name="expiryDate" aria-describedby="expiryDate" placeholder="expiry Date">
          
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <label for="controlNumber">Control Number</label>
            <input type="text" class="form-control" name="controlNumber" aria-describedby="controlNumber" placeholder="Control Number">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm">
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" placeholder="type">
        </div>
    </div>
  <br>
    <div class="row">
        <div class="col-sm">
             <button type="submit" class="btn btn-primary">Submit</button>
         </div>
    </div>
  
  </div>

</form>

  </body>
</html>