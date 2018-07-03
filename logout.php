<?php
 	session_start();
 	if (!isset($_SESSION['myuser'])) {
 	 	header("Location: index.php");
 	} else if(isset($_SESSION['myuser'])!="") {
 	 	header("Location: home.php");
 	}
 	if (isset($_GET['logout'])) {
 	 	unset($_SESSION['myuser']);
 	 	session_unset();
 	 	session_destroy();
 	 	header("Location: index.php");
 	 exit;
 	}
 ?>

