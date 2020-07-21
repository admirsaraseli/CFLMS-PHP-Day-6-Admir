<?php
	ob_start();
	session_start();
	require_once 'db_conn.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: ../login/login.php");
		exit;
	}
	
	// Create database
	$dbname = "car_rental_agency";
	
	$sql = "CREATE DATABASE $dbname";
	if  (mysqli_query($conn, $sql)) {
	   echo "Database $dbname created successfully! \n";
	} else {
	   echo "Error creating database $dbname: " . mysqli_error($conn);
	}
	

	// sql to create table
	$sql = "CREATE TABLE classic_cars (
	cls_cars_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	available BOOLEAN NOT NULL,
	brand VARCHAR(20) NOT NULL,
	year INT NOT NULL,
	price FLOAT(5),
	image VARCHAR(100),
	location VARCHAR(50)
	)" ;

	if (mysqli_query($conn, $sql)) {
	   echo "Table classic_cars created successfully"  . "\n";
	} else {
	   echo  "Error creating table: " . mysqli_error($conn) . "\n";
	}

	mysqli_close($conn);
?>