<?php
	ob_start();
	session_start();
	require_once 'db_conn.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: ../login/login.php");
		exit;
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Car Rental agency</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="bg-info">
  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	    <a class="navbar-brand" href="#">Car Rental</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarNav">
	        <ul class="navbar-nav">
		        <li class="nav-item active">
		            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
		        </li>
		        <li class="nav-item">
		            <a class="nav-link" href="insertcar.php">Insert Car</a>
		        </li>
	        </ul>
	        <ul class="navbar-nav ml-auto">
		        <li class="nav-item ">
		        	<a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning">Log out</a>
		        </li>
	        </ul>
	    </div>
    </nav>
    <div class="container mx-auto text-center">
    	<?php
	    if(isset($_POST["submit"])){
			$cls_cars_id = $_POST["id"];
			$userId = $_SESSION["user"];
			$booking_date_start = $_POST["booking_date_start"];
			$booking_date_end = $_POST["booking_date_end"];

			$sql = "INSERT INTO booking (booking_date_start, booking_date_end, userId, cls_cars_id) VALUES ('$booking_date_start','$booking_date_end',$userId,$cls_cars_id)";

			$sql2 = "UPDATE `classic_cars` SET `available`= 0 WHERE cls_cars_id = $cls_cars_id";

			if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
				echo "<h1>Booking success.</h1><br> ";
				header("Refresh: 3; url= ../index.php");
			}
		}
		?>
	</div>
</body>
</html>
<?php ob_end_flush(); ?>