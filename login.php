<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 1/10/19
 * Time: 7:14 PM
 */


include ('db_adapter.php');
session_start();

if (isset ($_SESSION["id"]))
{
	unset ($_SESSION["id"]);
}
$isSuccessful = false;
$adapter = new dbadapter();


$username = $password = "";
$username_err = $password_err = "";

if($_POST){
    $username = $_POST["username"];
    $password = $_POST["password"];


    if (($id =$adapter->login($username,$password))!= -1){
        $_SESSION["id"] = $id;
        echo "Success";
        header ("location: dashboard.php");
        
    }else{
        $username_err= "$username invalid username or password";
    }


}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" type="image/png" href="images/favicon/ll_logo.png"/>
    <link rel="stylesheet" href="css/materialize.css">

</head>

<body>
<!--<script type="text/javascript" src="js/materialize.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/countrySelect.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>


<div class="container">
    <a href="login.php"><img src="images/favicon/ll_logo.png" style="width: 200px; left: 10px"></a>
</div>
<div class="body-wrapper light-green lighten-5">
    <div class="page-wrapper">

        <main style="margin-top:5vh;">
            <div class="mdc-layout-grid">


                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                        <div class="mdc-card">
                            <section class="mdc-card__primary bg-white">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="msg msg-error <?php echo  !empty( $username_err )?"":"hide"?>">
                                            <p>

                                                <?php echo $username_err?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="card-panel teal lighten-2">-->
<!--                                    Returning user-->
<!--                                </div>-->

                                <div class="teal-text text-lighten-2 text-center font-weight-bold">
                                   <h5 class="form-signin-heading"> Account Login</h5>
                                </div>

                                <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                                    <div class="row">
                                        <div class="input-field col s12 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                            <input id="username" type="text"  name = "username" class="validate" required>
                                            <label for="username">Username</label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input type="password" name="password" class="validate" minlength="4" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="input-field col s4">
                                        <p><a href="reset_password.php" class="teal-text" target="_blank">Reset your password</a></p>
                                    </div>


                                        <div class="input-field col s4">
                                            <button class="btn btn-small btn-register waves-effect waves-light" type="submit" name="action">Login
                                                <i class="material-icons right">done</i>
                                            </button>
                                        </div>


                                    <div class="input-field col s4">
                                        <p>Don't have an account? <a href="register.php" class="teal-text">Register here</a></p>
                                    </div>
                                    </div>
                                </form>


                            </section>
                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                    </div>
                </div>
            </div>
        </main>

    </div>

</div>

<footer>
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                <span class="text-muted">Copyright © 2019 <a class="text-green" href="http://coen.boisestate.edu/cs/" target="_blank">Boise State University CS Department</a>. All rights reserved.</span>
            </div>
            <!--                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6 d-flex justify-content-end">-->
            <!--                        <span class="mt-0 text-right">Hand-crafted &amp; made with <i class="mdi mdi-heart text-red"></i></span>-->
            <!--                    </div>-->
        </div>
    </div>
</footer>
<!-- body wrapper -->
<!-- plugins:js -->
<!--<script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>-->
<!--<script src="../../node_modules/jquery/dist/jquery.min.js"></script>-->
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<!--<script src="js/misc.js"></script>-->
<!--<script src="js/material.js"></script>-->
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>
