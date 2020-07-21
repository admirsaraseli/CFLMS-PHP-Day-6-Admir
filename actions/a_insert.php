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
		            <a class="nav-link" href="../home.php">Home <span class="sr-only">(current)</span></a>
		        </li>
		        <li class="nav-item">
		            <a class="nav-link" href="../insertcar.php">Insert Car</a>
		        </li>
	        </ul>
	        <ul class="navbar-nav ml-auto">
		        <li class="nav-item ">
		        	<a href="login/logout.php?logout" class="nav-link  btn btn-outline-warning ">Log out</a>
		        </li>
	        </ul>
	    </div>
    </nav>
  
    <div class="container text-center mx-auto">
		<?php
			
			// Escape user inputs for security
			$available = mysqli_real_escape_string($conn, $_POST['available']);
			$brand = mysqli_real_escape_string($conn, $_POST[ 'brand']);
			$year = mysqli_real_escape_string($conn, $_POST['year']);
			$price = mysqli_real_escape_string($conn, $_POST['price']);
			$location = mysqli_real_escape_string($conn, $_POST['location']);
			$image = mysqli_real_escape_string($conn, $_POST['image']);
			// attempt insert query execution
			$sql = "INSERT INTO classic_cars (available, brand, year, price, image, location) 
			VALUES ('$available', '$brand', '$year', '$price', '$image', '$location')";
			if (mysqli_query($conn, $sql)) {
			    echo "<h1>New car created.</h1>";
			    header("Refresh: 3; url= ../index.php");
			} else {
			    echo "<h1>Record creation error for: </h1>" .
			         "<p>"  . $sql . "</p>" .
			         mysqli_error($conn);
			}
			mysqli_close($conn);
			
			/*$sql = "INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Bugatti', 1940, 600, 'bugatti.jpg', 'Vienna');
			INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Rolls', 1928, 700, 'rolls.jpg', 'Vienna');
			INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Mercedes', 1930, 500, 'mercedes.jpg', 'Vienna');
			INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Bmw', 1960, 300, 'bmw.jpg', 'Vienna');
			INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Porsche', 1959, 300, 'porsche.jpg', 'Vienna');
			INSERT INTO classic_cars (available, brand, year, price, image, location)
			VALUES (1, 'Ferrari', 1959, 400, 'ferrari.jpg', 'Vienna');
			";
			if (mysqli_multi_query($conn, $sql)) {
			    echo "New record created.\n";
			} else {
			   echo  "Record creation error for: " . $sql . "\n" . mysqli_error($conn);
			}
			mysqli_close($conn);*/
		?>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>