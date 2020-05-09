<!doctype html>
<html lang="en">
  <head>
    <?php include 'header.php'; ?>
  </head>
  <body>

  <form action="./deleteC.php" method="post">
   
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
             <button type="submit" class="btn btn-primary">Submit</button>
         </div>
    </div>
  </div>

</form>

  </body>
</html>