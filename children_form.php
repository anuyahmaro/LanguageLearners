<?php
include ('db_adapter.php');
session_start();
if (isset ($_COOKIE["id"]))
{
	unset ($_COOKIE["id"]);
}
$isSuccessful = false;
$adapter = new dbadapter();

//$cat_array = $adapter->getCategory();
//
//echo "<script>console.log( 'Debug Objects: " . $cat_array . "' );</script>"

if ($_POST) {
    $first_name =  $_POST["first_name"];
    $last_name =  $_POST["last_name"];
    $native_english =  $_POST["native_english"];
    $major =  $_POST["major"];
    $minor =  $_POST["minor"];
    $rateID =  $_POST["rates"];
//    $rate_levelID =  $_POST["rate_level"];
    $categoryID =  $_POST["categories"];
    $tester_infoID =  $_POST["tester_info"];
    $semester_infoID =  $_POST["semester_info"];
    $study_year =  $_POST["study_year"];
    $spanish_speaking =  $_POST["spanish_speaking"];
    $study_abroad =  $_POST["study_abroad"];
    $student_id =  $_POST["student_id"];
    $country_abroad = $_POST["country_abroad"];
    $class_info = $_POST["class_info"];

   $isSuccessful = $adapter->storeuserinfo($first_name, $last_name, $student_id, $class_info, $rateID,
      $categoryID, $native_english, $spanish_speaking, $study_abroad, $country_abroad, $major, $minor, $tester_infoID, $study_year, $semester_infoID);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Children Data Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon/ll_logo.png"/>
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

<script>

    $(document).ready(function() {
        //Autocomplete
        $(function() {
            $.ajax({
                type: 'GET',
                url: 'cdata2.json',
                success: function(response) {
                    var countryArray = response;
                    var dataCountry = {};
                    for (var i = 0; i < countryArray.length; i++) {
                        //console.log(countryArray[i].name);
                        dataCountry[countryArray[i].name] = countryArray[i].flag; //countryArray[i].flag or null
                    }
                    $('input.autocomplete').autocomplete({
                        data: dataCountry,
                        limit: 5, // The max amount of results that can be shown at once. Default: Infinity.
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('select').material_select();
    });



</script>






<div class="body-wrapper light-green lighten-5">
    <div class="page-wrapper">
        <main style="margin-top:5vh;">
            <div class="mdc-layout-grid light-green lighten-5">
                <div class="container">
                    <img src="images/languagelearners2.png" alt="https://i0.wp.com/revistavoces.net/wp-content/uploads/2017/05/cronin-169hero-englishlanglearners-shutterstock-.jpg">
                    <div class="centered"><h2><span class="white-text text-darken-2">Language Learners</span></h2></div>
                </div>
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                    </div>



                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4">
                        <div class="mdc-card">
                            <section class="mdc-card__primary bg-white <?php echo $isSuccessful?"hide":"" ?>" >
                                <form method="post" class="new_class">


                                    <div class="row">
                                        <div class="input-field col s6">
                                            <h6>First name <span style="color: red">*</span> </h6>
                                            <input placeholder="Queen" id="first_name"  name="first_name" type="text" class="validate" required="" aria-required="true">

                                            <!--                                            <input placeholder="Placeholder" id="first_name" type="text" class="validate">-->
<!--                                            <label for="first_name">First Name</label>-->

                                        </div>
                                        <div class="input-field col s6">
                                            <h6>Last name <span style="color: red">*</span> </h6>
                                            <input placeholder="Elizabeth" id="last_name"  name="last_name" type="text" class="validate" required="" aria-required="true">

                                            <!--                                            <input id="last_name" type="text" class="validate">-->
<!--                                            <label for="last_name">Last Name</label>-->
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col s12">
<!--                                            <h6>Please select your year and semester of study: </h6>-->
                                            <div class="input-field col s6">
                                                <h6>Student ID <span style="color: red">*</span> </h6>
                                                <input placeholder="ID Number" id="student_id" name="student_id" type="text" class="validate" required="" aria-required="true">
                                                <!--<label for="last_name"></label>-->
                                            </div>
                                            <div class="input-field col s6">
                                                <h6>Class <span style="color: red">*</span> </h6>
                                                <select name="class_info">
                                                    <?PHP
                                                    $class_info = $adapter->getSpanishClass();
                                                    foreach ($class_info as $cl){
                                                        echo "<option  value='".$cl["id"]."'>".$cl["name"]."</option>";
//
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col s12">
                                            <h6>Year and semester you are taking this OPI <span style="color: red">*</span> </h6>
                                            <div class="input-field col s6">
                                                <select name="semester_info">
                                                    <?PHP
                                                    $semester_info = $adapter->getSemester();
                                                    foreach ($semester_info as $si){
                                                        echo "<option  value='".$si["id"]."'>".$si["semester"]."</option>";
//
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="input-field col s6">

<!--                                                <select id="select2" name = "study_year">-->
<!--                                                    <option value="1"> 2012</option>-->
<!--                                                </select>-->

                                                <input placeholder="yyyy" id="input_text_year" name="study_year" type="text" class="validate" required="" minlength="4" aria-required="true">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col s12">

                                            <div class="input-field col s6">
                                                <h6>Major <span style="color: red">*</span> </h6>
                                                <!--<input type="text" id="autocomplete-input" class="autocomplete">-->
                                                <input type="text" placeholder="Major 1 / Major 2 / ..."   name = "major" id="country1" class="autocomplete validate" required="" aria-required="true">
                                                <!--<label for="country1">Major</label>-->
                                            </div>
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                    <div class="row">-->
<!--                                        <div class="col s12">-->

                                            <div class="input-field col s6">
                                                <h6>Minor</h6>
                                                <!--<input type="text" id="autocomplete-input" class="autocomplete">-->
                                                <input type="text" name = "minor" placeholder="Minor 1 / Minor 2 / ..."  id="country2" class="autocomplete">
                                                <!--<label for="country2">Minor</label>-->
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col s12 radioRequired">

                                            <h6>Are you a native English speaker?</h6>
                                            <div>
                                                <p>
                                                    <label>
                                                        <input name="native_english" value="1" class="with-gap" type="radio" checked />
                                                        <span>Yes</span>
                                                    </label>
                                                </p>
                                                <p>
                                                    <label>
                                                        <input name="native_english" value="0"  class="with-gap" type="radio" />
                                                        <span>No</span>
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col s12">
                                            <h6>Please answer the following <span style="color: red">*</span> </h6>

                                            <div class="col s12">
                                                <p class="font-weight-bold"></p>
                                                <?PHP
                                                $study_abroad = $adapter->getStudyAbroad();
                                                foreach ($study_abroad as $sab){
                                                    echo    "<p>";
                                                    echo "<label>";
                                                    echo   "<input name='study_abroad' value='".$sab["id"].
                                                        "' class='with-gap' type='radio' checked />";
                                                    echo "<span>".$sab["name"]."</span>";
                                                    echo "</label>";
                                                    echo "</p>";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12">

                                            <div class="input-field col s12">
                                                <h6> If you have studied, lived, or worked abroad, please tell us where: </h6>
<!--                                                <input type="text" name = "place_abroad">-->
                                                <div class="col s8">
                                                <input list="country_abroad_list" name="country_abroad">
                                                <datalist id = "country_abroad_list">

                                                    <?PHP
                                                    $country_abroad = $adapter->getCountries();
                                                    foreach ($country_abroad as $ca){
                                                       // "<option  value=".$ca["country_name"]"'>"."</option";
                                                        echo "<option  value='".$ca["country_name"]."'>".$ca["country_name"]."</option>";
//
                                                    }
                                                    ?>

                                                </datalist>
                                                </div>

                                    </div>
                                            </div>
                                        </div>


                                    <div class="row">
                                        <div class="col s12">
                                            <h6>Please answer any / all that apply <span style="color: red">*</span> </h6>

                                            <div class="col s12">
                                                <p class="font-weight-bold"></p>
                                                <?PHP
                                                $spanish_speaking = $adapter->getSpanishSpeaker();
                                                $count =0;
                                                foreach ($spanish_speaking as $spk){
                                                    echo    "<p>";
                                                    echo "<label>";
                                                    echo   "<input name='spanish_speaking[$count]' value='".$spk["id"].
                                                        "' class='filled-in' type='checkbox' />";
                                                    echo "<span>".$spk["name"]."</span>";
                                                    echo "</label>";
                                                    echo "</p>";
                                                    $count++;
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col s12">
                                            <h6>What rate do think you will score? </h6>

                                            <div class="col s6">
<!--                                                <p class="font-weight-bold">Rate</p>-->
                                                <?PHP
                                                $rates = $adapter->getRates();
                                                foreach (array_slice($rates, 0,5)as $rate){
                                                    echo    "<p>";
                                                    echo "<label>";
                                                    echo   "<input name='rates' value='".$rate["id"].
                                                        "' class='with-gap' type='radio' checked />";
                                                    echo "<span>".$rate["rate"]."</span>";
                                                    echo "</label>";
                                                    echo "</p>";
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>



<!--                                    <div class="row">-->
<!--                                        <div class="col s12">-->
<!--                                            <h6>What level of proficiency do you think you are? </h6>-->
<!--                                            <div class="col s6">-->
<!--                                                <p class="font-weight-bold">Level</p>-->
<!--                                                --><?PHP
//                                                    $rateLevels = $adapter->getRateLevel();
//                                                    foreach (array_slice($rateLevels, 0,3) as $ratel){
//                                                    echo    "<p>";
//                                                    echo "<label>";
//                                                    echo   "<input name='rate_level' value='".$ratel["id"].
//                                                        "' class='with-gap' type='radio' checked />";
//                                                    echo "<span>".$ratel["rate_level"]."</span>";
//                                                    echo "</label>";
//                                                    echo "</p>";
//                                                    }
//                                                ?>
<!---->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->



                                    <div class="row">
                                        <div class="col s12">
                                            <h6>What category best describes your language proficiency? <span style="color: red">*</span> </h6>

                                            <div class="col s12">
                                                <p class="font-weight-bold"></p>


                                                <?PHP
                                                $category_prof = $adapter->getCategory();
                                                foreach ($category_prof as $category){


                                                    echo    "<p>";
                                                    echo "<label>";
                                                    echo   "<input name='categories' value='".$category["id"].
                                                        "' class='with-gap ' type='radio' checked />";
                                                    echo "<span >".$category["category"]."</span>";
                                                    echo "<i data-id='".$category["id"]."' class=\"material-icons  mdc-list-item__start-detail mdc-drawer-item-icon info-ret \" ".
                                                             " aria-hidden=\"true\">info</i>";
//                                                    echo "<a tabindex='0' class='svg-glyph-info' role='button' data-toggle='popover'
//                                                    data-trigger='focus' title='Dismissible popover' data-content='And here is some amazing content.
//                                                    It is very engaging. Right'>"."Dismissible popover"."</a>";
                                                    echo "</label>";
                                                    echo "</p>";

                                                    echo "<div class='row'>";
                                                    echo "<div class='col s12'>";
                                                    echo "<div data-id='".$category["id"]."' class='alert alert-success info hide'>";
                                                    echo "<button type=\"button\" class=\"close-alert\">�</button>";
                                                    echo  "<p>";
                                                    echo  $category["hints"];
                                                    echo  "</p></div></div></div>";



                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>


<!--                                    <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover"
data-trigger="focus" title="Dismissible popover" data-content="And here's some amazing content.
It's very engaging. Right?">Dismissible popover</a>-->


<!--class='tooltipped' data-position='bottom' data-tooltip=
                                                        '".$category["hints"]."'-->



                                    <div class="row">
                                        <div class="input-field col s6">
                                            <h6>Who was your tester? <span style="color: red">*</span> </h6>
                                            <div>
                                                <!--<label>Choose Tester</label>-->
                                                <select name = "tester_info">

                                                    <?PHP
                                                    $tester_info = $adapter->getTesterInfo();
                                                    foreach ($tester_info as $ti){
                                                        echo "<option  value='".$ti["id"]."'>".$ti["tester"]."</option>";
//
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <button class="btn waves-effect waves-light" type="submit">Submit
                                        <i class="material-icons right">send</i>
                                    </button>

                                </form>
                            </section>
                            <section class="mdc-card__primary bg-white <?php echo !$isSuccessful?"hide":"" ?>" >
                               <p>Your information has been saved. Thank you</p>
                                <a class="btn waves-effect waves-light" href="children_form.php">Restart
                                    <i class="material-icons right">autorenew</i>
                                </a>
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


<script type="text/javascript" src='cdata.js'></script>
<script src="assets/bootstrap-4.0.0/popper.min.js"></script>

<script>

    var select = document.getElementById("select2"),
        startYear = 2013,
        endYear = 2019,
        arr = [];

    for (var i = startYear; i <= endYear; i++) {
        arr.push(i);
    }

    for (var i = 0; i < arr.length; i++) {
        //console.log(arr[i]);
        var options = document.createElement("OPTION"),
            txt = document.createTextNode(arr[i]);

        options.appendChild(txt);

        select.insertBefore(options, select.lastChild);

    }
   // console.log(arr);
    $(document).ready(function(){
        $('.tooltipped').tooltip();
        $('.info-ret').on("click", function() {

            var id = $(this).data("id");
            var relAlertInfo = $('.info[data-id=' + id + ']');
            if (relAlertInfo.hasClass("hide"))
                relAlertInfo.removeClass("hide");
            else
                relAlertInfo.addClass("hide");
        });

        $(".close-alert").click(function(e){
            $(this).parent().addClass("hide");
            e.preventDefault();
        });

    });


</script>

<!--<script>-->
<!---->
<!--    var countries = {};-->
<!--    var cArr = [];-->
<!---->
<!--    cArr.push("Queen");-->
<!--    cArr.push("Maro");-->
<!---->
<!--    var dataListS = document.getElementById("dataList1");-->
<!---->
<!--    var myInit = { method: 'GET',-->
<!--                headers: {-->
<!--        'Content-Type' : 'application/json'},-->
<!--        mode: 'cors',-->
<!--        cache: 'default'-->
<!--                };-->
<!---->
<!--    let myRequest = new Request("cdata.json", myInit);-->
<!---->
<!--    fetch(myRequest).then(function (resp) {-->
<!--        return resp.json();-->
<!--    }).then(function (data) {-->
<!---->
<!--        for (var i = 0; i < data.length; i++) {-->
<!---->
<!--            console.log(data[i].name);-->
<!--            cArr.push(data[i].name);-->
<!--        }-->
<!---->
<!---->
<!---->
<!---->
<!---->
<!--        // countries = data;-->
<!---->
<!--       // console.log(data);-->
<!--    });-->
<!---->
<!--    console.log(cArr);-->
<!---->
<!---->
<!---->
<!--</script>-->

<!--<script src="js/countrySelect.js"></script>-->
<!--<script>-->
<!--    $("#country_selector").countrySelect({-->
<!--        //defaultCountry: "jp",-->
<!--        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],-->
<!--        preferredCountries: ['ca', 'gb', 'us']-->
<!--    });-->
<!--</script>-->
<!-- body wrapper -->
<!-- plugins:js -->
<!--<script src="../../node_modules/material-components-web/dist/material-components-web.min.js"></script>-->
<!--<script src="../../node_modules/jquery/dist/jquery.min.js"></script>-->
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<!--<script src="../../js/misc.js"></script>-->
<!--<script src="../../js/material.js"></script>-->
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>