<?php
    ob_start();
    session_start();
    require_once '../actions/db_conn.php';

    // it will never let you open index(login) page if session is set
    if (isset($_SESSION['user'])!="") {
        header("Location: ../home.php");
        exit;
    }else if(isset($_SESSION['admin'])!=""){
        header("Location: ../admin.php");
        exit;
    }

    $error = false;

    if( isset($_POST['btn-login']) ) {

        // prevent sql injections/ clear user invalid inputs
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);

        $pass = trim($_POST[ 'pass']);
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

        if (empty($pass)){
            $error = true;
            $passError = "Please enter your password." ;
        }

        // if there's no error, continue to login
        if (!$error) {
            $password = hash( 'sha256', $pass); // password hashing
            $res=mysqli_query($conn, "SELECT * FROM users WHERE userEmail='$email'" );
            $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
            $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

            if( $count == 1 && $row['userPass' ]==$password ) {
                if ($row["status"] == 'admin'){
                    $_SESSION["admin"] = $row['userId'];
                    header( "Location: ../admin.php");
                }else{
                    $_SESSION['user'] = $row['userId'];
                    header( "Location: ../home.php");
                    //echo "<script>window.location.href='http://localhost/phpday4/home.php';</script>";        
                }
                
            }else {
                $errMSG = "Incorrect Credentials, Try again..." ;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Registration System</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="bg-info">
    <h3 class="text-center text-red pt-5"><?php if ( isset($errMSG) ) {echo  $errMSG; }?></h3>
    <div class="container bg-light w-50">
        <div id="login-row" class="row justify-content-center align-items-center">
          <div id="login-column" class="col-sm-8">
            <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
                <h3 class="text-center text-info">Login</h3>
                <div class="form-group">
                    <label for="username" class="text-info">Username:</label><br>
                    <input type="email" name="email" id="email" class="form-control" placeholder= "Your Email" value="<?php echo $email;?>" maxlength="40">
                    <span class="text-danger"><?php  echo $emailError; ?></span >
                </div>
                <div class="form-group">
                    <label for="password" class="text-info">Password:</label><br>
                    <input type="password" name="pass" id="password" class="form-control" placeholder="Your Password"  maxlength="15">
                    <span class="text-danger"><?php  echo $passError; ?></span>
                </div>
                <div class="form-group">
                    <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                    <input type="submit" name="btn-login" class="btn btn-info btn-md" value="Sign In">
                    <a href="register.php" class="ml-5 btn btn-outline-info ">
                    Sign up here 
                    </a>
                </div>
            </form>
          </div>
        </div>
    </div>  
</body>
</html>
<?php ob_end_flush(); ?>