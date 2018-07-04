<?php

//init session 
session_start(); 

include 'user.php';

//check to see if user is logging out 
if(isset($_GET['out'])){
    //destroy session 
    session_unset(); 
    $_SESSIon = array();
     unset($_SESSION['user'], $_SESSION['access']);
     session_destroy();
     header("location:login.php");
}

//check to see if login form has been submitted 
if(isset($_POST['userLogin'])){
    //run information through authenticator 
    if(authenticate($_POST['userLogin'], $_POST['userPassword'])){
        //authentication passwd 
        header("Location: protected.php");
        die();
        
    }else{
        //authentication error 
        $error = 1; 
        
    }
}

//output error to user 
if(isset($error)) echo 'Login failed: Incorrect username, password or rights <br />';

//output logoutsuccess 
if(isset($_GET['out'])) echo "Logout succesful";
   

?> 

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" acction="login.php" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Log In to Monitor</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> 
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="userLogin" placeholder="Username" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="userPassword" placeholder="Your Password" />
        </div>
       
     	<hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
      	<br />
            
      </form>

    </div>
    
</div>

</body>
</html>