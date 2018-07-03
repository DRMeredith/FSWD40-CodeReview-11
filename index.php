<?php

 ob_start();
 session_start();
 require_once 'dbconnect.php';
 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['myuser'])!="" ) {
  header("Location: home.php");
  exit;
 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['password']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

 

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

 

  // if there's no error, continue to login

  if (!$error) {
   $password = hash('sha256', $pass); // password hashing using SHA256
   $res=mysqli_query($conn, "SELECT user_id, first_name, `password` FROM `user` WHERE email='$email'");
   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 && $row['password']==$password ) {
    $_SESSION['myuser'] = $row['user_id'];
    header("Location: home.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
  }
 }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Or Register</title>
<meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <script
    src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g="
    crossorigin="anonymous"></script>   
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
  
  .container {

  }

  a {
      color: white;
  }

  h2 {
      color: white;
      font-family: 'Quicksand', sans-serif;
  }

  
  
  </style>
</head>
<body background="https://icdn-2.motor1.com/images/mgl/Jzmyn/s1/ferrari-250-gto-meeting.jpg">
<div class="container" style="width: 30%;margin-top: 150px;border-radius: 15px; box-shadow: 1px 5px 10px black;">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
             <h2 id="indexsign">Sign In.</h2>
             <hr />
            <?php

   if ( isset($errMSG) ) {
    echo $errMSG; ?>
                <?php
    }
    ?>
      <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
      <span class="text-danger"><?php echo $emailError; ?></span>
      <hr>
      <input type="password" name="password" class="form-control" placeholder="Your Password"  />
      <span class="text-danger"><?php echo $passError; ?></span>
      <hr />
      <button type="submit" class="btn btn-block btn-default" name="btn-login">Sign In</button>
      <hr />
      <a href="register.php">Sign Up Here...</a>
    </form>
</div>
</body>
</html>
<?php ob_end_flush(); ?>