<?php

//init session 
ini_set("display_errors",1);
 error_reporting(E_ALL);
session_start(); 
include('user.php');

//check to see if user is logging out 
if(isset($_GET['out'])){
    //destroy session 
    session_unset(); 
    $_SESSION = array();
     unset($_SESSION['user'], $_SESSION['access']);
     session_destroy();
    header("Location: index.php");
}

//check to see if login form has been submitted 
if(isset($_POST['userLogin'])){
    //run information through authenticator 
    if(authenticate($_POST['userLogin'], $_POST['userPassword'])){
        //authentication passwd 
        header("Location: unit.php");
        die();
        
    }else{
        //authentication error 
        $error = 1; 
        
    }
}

//output error to user 
if(isset($error)) echo 'Login failed: Incorrect username, password or rights <br/>';

//output logoutsuccess 
if(isset($_GET['out'])) echo "Logout succesful";
   

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
       


</head>
<body>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center text-black mb-4">Login in to Monitor</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" action="login.php" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <label for="userLogin">Username</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="userLogin" id="userLogin" required="">
                                    <div class="invalid-feedback">Please enter your Username.</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-0" name="userPassword" id="userPassword" required="" autocomplete="new-password">
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>
                                <div>
                                    <label class="custom-control custom-checkbox">
                                      <input type="checkbox" class="form-check form-check-inline">
                                      <span class="custom-control-indicator"></span>
                                      <span class="custom-control-description small text-dark">Remember me on this computer</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->


</body>
</html>