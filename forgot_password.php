<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 1/10/19
 * Time: 7:14 PM
 */


include ('db_adapter.php');
session_start();

if (isset ($_COOKIE["id"]))
{
	unset ($_COOKIE["id"]);
}
$isSuccessful = false;
$adapter = new dbadapter();


$username = $password = "";
$username_err = $password_err = "";

if($_POST){
    $username = $_POST["username"];
   // $password = $_POST["password"];


    if (($id =$adapter->forgotPassword($username))!= -1){
        $_SESSION["id"] = $id;
       // header("Location: dashboard.php");
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
    <title>Forgot Password</title>
    <!-- plugins:css -->
    <!--<link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">-->
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
    <link rel="stylesheet" href="css/materialize.css">

</head>

<body>
<!--<script type="text/javascript" src="js/materialize.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/countrySelect.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<script src="js/countrySelect.min.js"></script>
<div class="body-wrapper">
    <div class="page-wrapper">
        <main class="content-wrapper auth-screen">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                        <div class="mdc-card">
                            <section class="mdc-card__primary bg-white">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="msg msg-info <?php echo $isSuccessful?"":"hide"?>">
                                            <p>
                                                Your password have been sent to your registered email. <br/>
                                                Kindly follow <a href="login.php"  class = "white-text font-weight-bold"><u>This Link</u></a> to login


                                            </p>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="row">-->
<!--                                    <div class="col s12">-->
<!--                                        <div class="msg msg-error --><?php //echo  !empty( $username_err )?"":"hide"?><!--">-->
<!--                                            <p>-->
<!---->
<!--                                                --><?php //echo $username_err?>
<!--                                            </p>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <!--                                <div class="card-panel teal lighten-2">-->
                                <!--                                    Returning user-->
                                <!--                                </div>-->



                                <form class="<?php echo $isSuccessful?"hide":""?>" action="" method="post">
                                    <div class="teal-text text-lighten-2 text-center font-weight-bold">
                                        <h5 class="form-signin-heading">Forgot Password</h5>
                                    </div>


<!--                                    <form class="form-signin" method="POST">-->
<!--                                        <h2 class="form-signin-heading">Forgot Password</h2>-->
                                        <div class="input-group">
<!--                                            <span class="input-group-addon" id="basic-addon1">@</span>-->
                                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <br />
                                        <button class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
                                    <div class="input-field col s4">
                                        <p>Want to reset your password? Click <a href="reset_password.php" class="teal-text">here</a>.</p>
                                        <p>Click to Login <a href="login.php" class="teal-text">here</a>.</p>
                                    </div>
<!--                                        <a class="btn btn-lg btn-primary btn-block" href="login.php">Login</a>-->
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

