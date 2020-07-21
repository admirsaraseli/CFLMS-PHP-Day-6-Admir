<?php
	ob_start();
	session_start();
	require_once 'actions/db_conn.php'; 

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
		header("Location: login.php");
		exit;
	}
	if( isset($_SESSION['user']) ) {
		header("Location: ../home.php");
		exit;
	}
	// select logged-in admins details
	$sql = "SELECT * FROM users where userId=".$_SESSION['admin'];
	$result = mysqli_query($conn, $sql);
	$userRow = mysqli_fetch_assoc($result);
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
    <div class="container row row-cols-1 row-cols-md-2 row-cols-lg-3 mx-auto">
    <?php
		$sql = "SELECT * FROM classic_cars";
		$result = mysqli_query($conn, $sql);
		// fetch the next row (as long as there are any) into $row
		while($row = mysqli_fetch_assoc($result)) {
			echo "
			<div class='col mb-4'>
				<div class='card px-1 py-1 bg-light'>
					<img src='img/" .$row['image']." ' class='card-img-top' alt='...' >
					<div class='card-body'>
						<h4 class='card-title'>";
						if ($row["available"] == 0) {
		                        echo "<b>available:</b> <span style='color:red'>No</span>";
		                    } else {
		                        echo "<b>available:</b> <span style='color:green'>Yes</span>";
		                    } 
		                    echo "</h4>
						<h4 class='card-text'>Brand:". $row['brand']."</h4>
						<h4 class = 'card-text text-info'>Price: ".$row['price']." Euro</h4>
						<h5 class='card-text'>Year: ".$row['year']."</h5>
					</div>
					<div class='card-footer text-center'>
						<span>
							<h5>Location: ".$row['location']."</h5>
						</span>
						<a href='update.php?id=".$row['cls_cars_id']."' class='btn btn-outline-warning mx-auto'>Update the car</a>
						<a href='deletecar.php?id=".$row['cls_cars_id']."' class='btn btn-outline-danger mx-auto'>Delete the car</a>
					</div>
				</div>
			</div>";
		}

		// Free result set
		mysqli_free_result($result);
		// Close connection
		mysqli_close($conn);

	?>
	</div>	
</body>
</html>
<?php ob_end_flush(); ?>