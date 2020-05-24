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


$username = $email = $password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

if($_POST){
   $username = $_POST["username"];
   $first_name = $_POST["first_name"];
   $last_name = $_POST["last_name"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];

   if (!$adapter->userNameExists($username)){
       $hashed_password = password_hash($password, PASSWORD_DEFAULT);
       $adapter->storeAdminInfo($first_name,$last_name,$email,$username, $hashed_password);
       $isSuccessful=true;
   }else{
       $username_err= "$username already exists";
   }


}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Material Admin</title>
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
                                        <div class="msg msg-info <?php echo $isSuccessful?"":"hide"?>">
                                            <p>
                                                Thank you for registering. <br/>
                                                Kindly follow <a href="login.php" >This Link</a> to login


                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <form class="<?php echo $isSuccessful?"hide":""?>" action="" method="post">
                                    <div class="teal-text text-lighten-2 text-center font-weight-bold">
                                        <h5>Create Account</h5>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s6">
                                            <input id="first_name" name ="first_name" id ="name_name" type="text" class="validate" required>
                                            <label for="first_name">First Name</label>
                                        </div>
                                        <div class="input-field col s6">
                                            <input id ="last_name" name ="last_name" type="text" class="validate" required>
                                            <label for="last_name">Last Name</label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="input-field col s12 <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                                            <input id="email" name = "email" type="email" class="validate" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="input-field col s12 ">
                                            <input id="username" type="text" value="<?php echo $username; ?>"  name = "username" class="validate <?php echo (!empty($username_err)) ? 'invalid' : 'valid'; ?>" required>
                                            <label for="username" data-error="<?php echo $username_err?>">Username</label>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="input-field col s12 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
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

                                    <div class="input-field col s4">
                                        <button class="btn btn-small btn-register waves-effect waves-light" value="Reset" type="submit" name="action">Register
                                            <i class="material-icons right">done</i>
                                        </button>
                                    </div>
                                    <div class="input-field col s4">
                                    <p>Already have an account? <a href="login.php" class="teal-text">Login here</a></p>
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
<script type="application/javascript">
    $(function(){

        function checkForm(form)
        {
            if(form.username.value == "") {
                alert("Error: Username cannot be blank!");
                form.username.focus();
                return false;
            }
            re = /^\w+$/;
            if(!re.test(form.username.value)) {
                alert("Error: Username must contain only letters, numbers and underscores!");
                form.username.focus();
                return false;
            }

            if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
                if(form.pwd1.value.length < 6) {
                    alert("Error: Password must contain at least six characters!");
                    form.pwd1.focus();
                    return false;
                }
                if(form.pwd1.value == form.username.value) {
                    alert("Error: Password must be different from Username!");
                    form.pwd1.focus();
                    return false;
                }
                re = /[0-9]/;
                if(!re.test(form.pwd1.value)) {
                    alert("Error: password must contain at least one number (0-9)!");
                    form.pwd1.focus();
                    return false;
                }
                re = /[a-z]/;
                if(!re.test(form.pwd1.value)) {
                    alert("Error: password must contain at least one lowercase letter (a-z)!");
                    form.pwd1.focus();
                    return false;
                }
                re = /[A-Z]/;
                if(!re.test(form.pwd1.value)) {
                    alert("Error: password must contain at least one uppercase letter (A-Z)!");
                    form.pwd1.focus();
                    return false;
                }
            } else {
                alert("Error: Please check that you've entered and confirmed your password!");
                form.pwd1.focus();
                return false;
            }

            alert("You entered a valid password: " + form.pwd1.value);
            return true;
        }


        $("#password").on("focusout", function (e) {
            if ($(this).val() != $("#passwordConfirm").val()) {
                $("#passwordConfirm").removeClass("valid").addClass("invalid");
            } else {
                $("#passwordConfirm").removeClass("invalid").addClass("valid");
            }
            console.log("asdf==");
        });

        $("#passwordConfirm").on("keyup", function (e) {
            if ($("#password").val() != $(this).val()) {
                $(this).removeClass("valid").addClass("invalid");
            } else {
                $(this).removeClass("invalid").addClass("valid");
            }
            console.log("sadfa");
        });
    });
</script>
</body>

</html>
