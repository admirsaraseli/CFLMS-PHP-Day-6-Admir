<?php
	ob_start();
	session_start();
	require_once 'actions/db_conn.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: login/login.php");
		exit;
	}

	if($_GET["id"]){
		$id = $_GET["id"];
		
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
    <header>
        <div class="jumbotron main_header" >
            <h1 class="display-4">Car Rental agency</h1>
            <p class="lead">Enjoy your ride.</p>
        </div>
    </header>
	<div class="container mx-auto font-weight-bold ">
		<div class="form-group mx-auto w-50 text-center">
			<form action="actions/a_booking.php" method="post">
				<input type= "hidden" name= "id" value="<?php echo $id ?>" />
				<input type="date" name="booking_date_start" class="form-control">
				<input type="date" name="booking_date_end" class="form-control">
				<input type="submit" name="submit" class="form-control btn btn-danger w-50">
			</form>
		</div>
	</div>
</body>
</html>
<?php }ob_end_flush(); ?>