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
$isSuccessful =false;
$adapter = new dbadapter();


$username = $password = $confirm_password = "";
$username_err = $password_err = "";

if($_POST){
    $username = $_POST["username"];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($adapter->userNameExists($username)){
       // $_SESSION["id"] = $id;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $adapter->changePassword($username, $hashed_password);
        $isSuccessful=true;
    }else{
        $username_err= "$username does not exists";
    }
    // $password = $_POST["password"];


//    if (($id =$adapter->forgotPassword($username))!= -1){
//        $_SESSION["id"] = $id;
//        // header("Location: dashboard.php");
//    }else{
//        $username_err= "$username invalid username or password";
//    }


}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <!-- plugins:css -->
    <!--<link rel="stylesheet" href="../../node_modules/mdi/css/materialdesignicons.min.css">-->
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
<!--    <link rel="shortcut icon" href="/images/favicon.png" />-->
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
<!--        <main class="content-wrapper auth-screen">-->
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                        <div class="mdc-card">
<!--                            <section class="mdc-card__primary bg-white">-->
                            <section class="mdc-card__primary bg-white" >
                                <div class="row">
                                    <div class="col s12">
                                        <div class="msg msg-info <?php echo $isSuccessful?"":"hide"?>">
                                            <p>
                                                Your password have been successfully reset. <br/>
                                                Kindly follow <a href="login.php"  class = "white-text font-weight-bold"><u>This Link</u></a> to login


                                            </p>
                                        </div>
                                    </div>
                                </div>




                                <form class="<?php echo $isSuccessful?"hide":""?>" action="" method="post">
                                    <div class="teal-text text-lighten-2 text-center font-weight-bold">
                                        <h5 class="form-signin-heading">Reset Password</h5>
                                    </div>


                                    <!--                                    <form class="form-signin" method="POST">-->
                                    <!--                                        <h2 class="form-signin-heading">Forgot Password</h2>-->
<!--                                    <div class="input-group">-->
<!--                                        <!--                                            <span class="input-group-addon" id="basic-addon1">@</span>-->
<!--                                        <input type="text" name="password" class="form-control" placeholder="Password" required>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="input-group">-->
<!--                                        <!--                                            <span class="input-group-addon" id="basic-addon1">@</span>-->
<!--                                        <input type="text" name="confirm_password" class="form-control" placeholder="Confirm Password" required>-->
<!--                                    </div>-->

                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="username" type="text" value="<?php echo $username; ?>"  name = "username" class="validate" required>
                                            <label for="username" >Username</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input type="password" id="password" class="validate" name="password" value="<?php echo $password; ?>" minlength="4" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="passwordConfirm" type="password" name = "confirm_password" value="<?php echo $confirm_password; ?>" class="validate" minlength="4" required>
                                            <label id="lblPasswordConfirm" for="passwordConfirm" data-error="Password not match" data-success="Password Match">Confirm Password </label>
                                            <!--                                            <label for="password">Confirm Password</label>-->

                                        </div>
                                    </div>

                                    <br />
                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>

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

