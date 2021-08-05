<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $showAlert = false;
    $showError = false;
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    //$exists=false;
    $existSql = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
      //$exists = true;
      $showError = "User Already Exist";
    }
    else{
      //$exists = false;

    if(($password == $cpassword)){
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ('$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result){
          $showAlert = true;
        }
    }  
    else{
      $showError = "Passwords do not match";
    }
}
}  
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php require 'partials/nav.php' ?>
    <?php if(!empty($showAlert)){?>
    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    
    }
    ?>
    <?php } ?>
    <?php if(!empty($showError)){?>

      <?php
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }
    ?>
    <?php } ?>
    <div class="container">
        <h1 class="text-center" >Signup to our website</h1>
        <form action="/phpMysql/Newpro/signup.php" method="post">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="12" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="20" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>