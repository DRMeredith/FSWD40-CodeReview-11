<?php

session_start();// start a new session or continues the previous
ob_start();
if( isset($_SESSION['myuser'])!="" ){
    header("Location: home.php"); // redirects to home.php
}
include_once 'dbconnect.php';
$error =false;
if(isset($_POST['btn-signup'])){
  // sanitize user input to prevent sql injection
  $first = trim($_POST['first']);
  $first = strip_tags($first);
  $first = htmlspecialchars($first);

  $last = trim($_POST['last']);
  $last = strip_tags($last);
  $last = htmlspecialchars($last);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
    // basic name validation

   if(empty($first)){
      $error=true;
      $firstError='Please enter your First Name.';
    } elseif(strlen($first)<3){
      $error=true;
      $firstError='First Name must have atleast 3 characters';
    } elseif (!preg_match("/^[a-zA-Z ]+$/",$first)){
      $error=true;
      $firstError = "First Name must contain letters and space .";
    }


  if(empty($last)){
      $error=true;
      $lastError='Please enter your Last Name.';
    } elseif(strlen($last)<3){
      $error=true;
      $lastError='last must have atleast 3 characters';
    } elseif (!preg_match("/^[a-zA-Z ]+$/",$last)){
      $error=true;
      $lastError = "Last Name must contain letters and space .";
    }


    // EMAIL VALIDATION //
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $error=true;
      $emailError ="Please enter valid email address.";
    } else {

      // CHECK DB FOR EMAIL //
      $query ="SELECT email FROM `user` WHERE email='$email'";
      $result =mysqli_query($conn,$query);
      $count = mysqli_num_rows($result);
      if($count!=0){
        $error=true;
        $emailError="Provided Email is already in use.";
      }
    }
    // PASSWORD VALIDATION //
    if(empty($pass)){
      $error=true;
      $passError="Please enter password";
    } elseif(strlen($pass)<6){
      $error=true;
      $passError="Password must have at least 6 characters";
    }
    
    // PASSWORD ENCRYPT //
    $password=hash('sha256',$pass);


    // CONTINUE TO SIGN UP / ALERT POP-UP //
    if(!$error){
      $query ="INSERT INTO `user`(first_name,last_name,email,password) VALUES ('$first','$last','$email','$password')";
      $rep =mysqli_query($conn,$query);

      if($rep){
        $errTyp ="success!";
        $errMSG ="<div class='alert alert-success'>Successfully registered! Log-in and get Ripped Off!</div>";
        unset($first);
        unset($last);
        unset($email);
        unset($pass);
      } else{
        $errTyp="danger";
        $errMSG="Looks like we got an error! Good luck getting your holiday rental now!";
      }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>
<link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <script
    src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
    crossorigin="anonymous"></script>   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>

.jumbotron {
    background-image: url("https://icdn-2.motor1.com/images/mgl/Jzmyn/s1/ferrari-250-gto-meeting.jpg") !important;
}

.btn-block {
    margin: 15px;
}

h2 {
    font-family: 'Quicksand', sans-serif;
}

</style>



</head>
<body>

    <!-- MAIN LANDING HEADER & BUTTONS -->
  <div class="jumbotron" style="padding-top: 450px;">
    <h2 class="text-center" style="color: white;">Welcome to Rip-Off-Rentals!</h2>
    <div class="container text-center" style="width: 80%;">
      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal5">Register Now</button>
      <div class="modal fade" id="myModal5" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Sign Up</h4>
          <img class="modal-title" src="https://www.registersigns.com/resources/images/referrer/RS_Logo_wh_bg.png" width="100">
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <?php
      if(isset($errMSG) ) {
      ?>
      <div class="alert">
        <?php echo $errMSG; ?>
      </div>
      <?php
      }
      ?>

      <!-- MODAL POP-UP REGISTRATION -->
      <input type="text" name="first" class="form-control" placeholder="Enter First Name" maxlength="50" value="<?php echo $first ?>" />
      <span class="text-danger"><?php echo $firstError; ?></span>
      <hr>
      <input type="text" name="last" class="form-control" placeholder="Enter Last Name" maxlength="50" value="<?php echo $last ?>" />
      <span class="text-danger"><?php echo $lastError; ?></span>
      <hr>
      <input type="email" name="email" class="form-control" placeholder="Enter Email" maxlength="40" value="<?php echo $email ?>" />
      <span class="text-danger"><?php echo $emailError; ?></span>
      <hr>
      <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
      <span class="text-danger"><?php echo $passError; ?></span>
      <hr>
      <button type="submit" class="btn btn-block btn-default" name="btn-signup">Sign Up</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <a href="index.php"><button type="button" class="btn btn-default btn-block" >Sign In</button></a>
  </div></div>
    
</body>
</html>

<?php ob_end_flush(); ?>

