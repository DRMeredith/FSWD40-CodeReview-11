<?php
	$servername = 'localhost';
	$username = 'Sassy';
	$password = 'pipthe100';
	$dbname = 'cr11_dan_meredith_php_car_rental';

	$conn = mysqli_connect($servername,$username,$password,$dbname);

	if(!$conn){
		echo "not Connected";
	}
?>