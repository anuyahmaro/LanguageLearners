<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 1/10/19
 * Time: 11:44 PM
 */
include ('db_adapter.php');
session_start();
if (!isset ($_SESSION["id"]))
{

    header("Location: login.php");
    exit();
}
//echo "logged in ".$_SESSION["id"];
$isSuccessful =false;
$adapter = new dbadapter();

$enrollment = $adapter->getStudentEnrollment();
$language_category = $adapter->getLanguageCatGroups();
$tester_information = $adapter->getTesterGroups();
$study_abroad_information = $adapter->getStudyAbroadStats();
$native_english_information = $adapter->getNativeEnglishSpeakerStats();
//$student_rate_levels = $adapter->getRateLevelGroups();
$comparable_categories = $adapter->getComparableCategories();
$comparable_levels_categories = $adapter->getComparableLevelCategories();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" type="image/png" href="images/favicon/ll_logo.png"/>
</head>

<body>
<div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-persistent-drawer mdc-persistent-drawer--open">
        <nav class="mdc-persistent-drawer__drawer">
            <div class="mdc-persistent-drawer__toolbar-spacer">
                <a href="dashboard.php" class="brand-logo">
<!--                    <img src="images/logo.svg" alt="logo">-->
                </a>
            </div>
            <div class="mdc-list-group">
                <nav class="mdc-list mdc-drawer-menu">
                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="dashboard.php">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">desktop_mac</i>
                            Dashboard
                        </a>
                    </div>


                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="student-records.php">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grid_on</i>
                            Student Records
                        </a>
                    </div>

                    <div class="mdc-list-item mdc-drawer-item">
                        <a class="mdc-drawer-link" href="student_grade.php">
                            <i class="material-icons mdc-list-item__start-detail mdc-drawer-item-icon" aria-hidden="true">grade</i>
                            Grade Student
                        </a>
                    </div>


                </nav>
            </div>
        </nav>
    </aside>
    <!-- partial -->
    <!-- partial:partials/_navbar.html -->
    <header class="mdc-toolbar mdc-elevation--z4 mdc-toolbar--fixed">
        <div class="mdc-toolbar__row">
            <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
                <a href="#" class="menu-toggler material-icons mdc-toolbar__menu-icon">menu</a>
                <span class="mdc-toolbar__input">
            <div class="mdc-text-field">
<!--              <input type="text" class="mdc-text-field__input card-panel teal lighten-2" id="css-only-text-field-box" placeholder="Search anything...">-->
            </div>
          </span>
            </section>
            <section class="mdc-toolbar__section mdc-toolbar__section--align-end" role="toolbar">
                <div class="mdc-menu-anchor">

                </div>

                <div class="mdc-menu-anchor mr-1">
                    <a href="#" class="mdc-toolbar__icon toggle mdc-ripple-surface" data-toggle="dropdown" toggle-dropdown="logout-menu" data-mdc-auto-init="MDCRipple">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <div class="mdc-simple-menu mdc-simple-menu--right" tabindex="-1" id="logout-menu">
                        <ul class="mdc-simple-menu__items mdc-list" role="menu" aria-hidden="true">
                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                <i class="material-icons mdc-theme--primary mr-1">settings</i>
                                Settings
                            </li>
                            <li class="mdc-list-item" role="menuitem" tabindex="0">
                                <i class="material-icons mdc-theme--primary mr-1">power_settings_new</i>
                                <a href="login.php"> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </header>
    <!-- partial -->
    <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-card">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-7">
                                    <section class="purchase__card_section">
                                        <h5 class="text-center">Language Categories</h5>
                                    </section>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                        <div class="mdc-layout-grid__inner">
                            
                            <?php 
                                 foreach ($language_category as $l){
                                  echo "<div class='mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6'>";
                                  echo "<div class='mdc-card py-3 pl-2 d-flex flex-row align-item-center'>";
                                  echo "<div class='mdc--tile mdc--tile-danger rounded'>";
                                  echo "<i class='mdi  text-white icon-md'></i>";
                                  echo "</div>";
                                  echo "<div class='text-wrapper pl-1'>";
                                  echo "<h3 class='mdc-typography--display1 font-weight-bold mb-1'>".$l["total"]."</h3>";
                                  echo "<p class='font-weight-normal mb-0 mt-0'>".$l["category"]."</p>";

                                  echo "</div>";
                                  echo "</div>";
                                  echo "</div>";
                          
                                 }
                            ?>
                            
                          
                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">

                            <div class="mdc-card">
                                <section class="mdc-card__primary">
                                    <h1 class="mdc-card__title mdc-card__title--large text-center">Students for each language category</h1>
                                </section>
                                <section class="mdc-card__supporting-text">
                                    <canvas id="doughnutChart_lang_cat" style="height:250px"></canvas>
                                </section>
                            </div>

                    </div>








                </div>
            </div>





            <!--            /*%%%%%%%%%%%%%%%%%%%--New Activity--%%%%%%%%%%%%%%%%%%%*/-->

            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-card">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-7">
                                    <section class="purchase__card_section">
                                        <h5 class="text-center">Tester Information</h5>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">
                        <div class="mdc-layout-grid__inner">

                            <?php
                            foreach ($tester_information as $t){
                                echo "<div class='mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6'>";
                                echo "<div class='mdc-card py-3 pl-2 d-flex flex-row align-item-center'>";
                                echo "<div class='mdc--tile mdc--tile-danger rounded'>";
                                echo "<i class='mdi text-white '></i>";
                                echo "</div>";
                                echo "<div class='text-wrapper pl-1'>";
                                echo "<h3 class='mdc-typography--display1 font-weight-bold mb-1'>".$t["total"]."</h3>";
                                echo "<p class='font-weight-normal mb-0 mt-0'>".$t["tester"]."</p>";

                                echo "</div>";
                                echo "</div>";
                                echo "</div>";

                            }
                            ?>


                        </div>
                    </div>
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">

                        <div class="mdc-card">
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large text-center">Students Assigned to Each Tester</h1>
                            </section>
                            <section class="mdc-card__supporting-text">
                                <canvas id="doughnutChart_tester_info" style="height:250px"></canvas>
                            </section>
                        </div>

                    </div>








                </div>
            </div>






            <!--            /*%%%%%%%%%%%%%%%%%%%--New Activity--%%%%%%%%%%%%%%%%%%%*/-->

            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                        <div class="mdc-card">
                            <div class="mdc-layout-grid__inner">
                                <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-7">
                                    <section class="purchase__card_section">
                                        <h5 class="text-center">Charts</h5>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>










                </div>
            </div>



<!--            /*******Paste the Chart! /-->


            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
<!--                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">-->
<!--                        <div class="mdc-card">-->
<!--                            <section class="mdc-card__primary">-->
<!--                                <h1 class="mdc-card__title mdc-card__title--large">OPI Ratings Performance</h1>-->
<!--                            </section>-->
<!--                            <section class="mdc-card__supporting-text">-->
<!---->
<!--                                <div id="barchart_material" style="height: 32.5vh;"></div>-->
<!---->
<!--                            </section>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-12-desktop">
                        <div class="mdc-card">
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large">OPI Levels Performance</h1>
                            </section>
                            <section class="">


                                <div id="barchart_levels" ></div>

                            </section>
                        </div>
                    </div>





                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
                        <div class="mdc-card">
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large">Studying Abroad Information</h1>
                            </section>
                            <section class="mdc-card__supporting-text">
                                <canvas id="barChart_StudyAbroad" style="height:11.8vh"></canvas>
                            </section>
                        </div>
                    </div>




                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
                        <div class="mdc-card">
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large">Native English Speaking Students</h1>
                            </section>
                            <section class="mdc-card__supporting-text">
                                <canvas id="NativeEnglishpieChart" style="height:11.8vh"></canvas>
                            </section>
                        </div>
                    </div>


<!--                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">-->
<!--                        <div class="mdc-card">-->
<!--                            <section class="mdc-card__primary">-->
<!--                                <h1 class="mdc-card__title mdc-card__title--large">Line chart</h1>-->
<!--                            </section>-->
<!--                            <section class="mdc-card__supporting-text">-->
<!--                                <canvas id="lineChart" style="height:250px"></canvas>-->
<!--                            </section>-->
<!--                        </div>-->
<!--                    </div>-->

                    <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6">

                        <div class="mdc-card">
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large">Enrollment Information</h1>
                            </section>
                            <section class="mdc-card__supporting-text">
                                <canvas id="doughnutChart_enrollment" style="height:11.8vh"></canvas>
                            </section>
                        </div>

                    </div>

<!--                    <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6">-->
<!--                        <div class="mdc-card">-->
<!--                            <section class="mdc-card__primary">-->
<!--                                <h1 class="mdc-card__title mdc-card__title--large">Ratings</h1>-->
<!--                            </section>-->
<!--                            <section class="mdc-card__supporting-text">-->
<!--                                <canvas id="barChart_RateLevel" style="height:11.8vh"></canvas>-->
<!--                            </section>-->
<!--                        </div>-->
<!--                    </div>-->






                </div>
            </div>






<!--                %%%%%%%%%% End of Chart-->



        </main>
        <!-- partial:partials/_footer.html -->
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
        <!-- partial -->
    </div>
</div>
<!-- body wrapper -->
<!-- plugins:js -->
<script src="assets/material-components-web/dist/material-components-web.min.js"></script>
<script src="assets/jquery/dist/jquery.min.js"></script>
<!-- endinject -->

<!-- endinject -->
<!-- Plugin js for this page-->
<script src="assets/chart.js/dist/Chart.min.js"></script>

<script src="assets/progressbar.js/dist/progressbar.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/misc.js"></script>
<script src="js/material.js"></script>



<script type="application/javascript" >
    $(function () {
        var colors = [

        <?php
            foreach($enrollment as $e){
                $r = rand(0,255);
                $b = rand(0,255);
                $g = rand(0,255);
                $a = 0.5;
                echo "'rgba($r, $g, $b, $a)',";
            }
            ?>

            ];

        var doughnutPieData_enrollment = {
            datasets: [{
                data: [
                    <?php
                    foreach($enrollment as $e){
                        echo "".$e["total"].",";
                    }
                    ?>
                ],
                backgroundColor:colors,
                borderColor: colors,
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                <?php
                    foreach($enrollment as $e){
                        echo "'".$e["semester"]." ".$e["study_year"]."',";
                    }
                ?>

            ]
        };

        var doughnutPieOptions_enrollment = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        if ($("#doughnutChart_enrollment").length) {
            var doughnutChartCanvas_enrollment = $("#doughnutChart_enrollment").get(0).getContext("2d");
            var doughnutChart_enrollment = new Chart(doughnutChartCanvas_enrollment, {
                type: 'doughnut',
                data: doughnutPieData_enrollment,
                options: doughnutPieOptions_enrollment
            });
        }
    });


</script>

<script type="application/javascript">
    $(function () {
        var colors = [

            <?php
            foreach($language_category as $l){
                $r = rand(0,255);
                $b = rand(0,255);
                $g = rand(0,255);
                $a = 0.5;
                echo "'rgba($r, $g, $b, $a)',";
            }
            ?>

        ];

        var doughnutPieData_lang_cat = {
            datasets: [{
                data: [
                    <?php
                    foreach($language_category as $l){
                        echo "".$l["total"].",";
                    }
                    ?>
                ],
                backgroundColor:colors,
                borderColor: colors,
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                <?php
                foreach($language_category as $l){
                    echo "'".$l["category"]."',";
                }
                ?>

            ]
        };

        var doughnutPieOptions_lang_cat = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        if ($("#doughnutChart_lang_cat").length) {
            var doughnutChartCanvas_lang_cat = $("#doughnutChart_lang_cat").get(0).getContext("2d");
            var doughnutChart_lang_cat = new Chart(doughnutChartCanvas_lang_cat, {
                type: 'doughnut',
                data: doughnutPieData_lang_cat,
                options: doughnutPieOptions_lang_cat
            });
        }
    });


</script>

<script type="application/javascript">
    $(function () {
        var colors = [

            <?php
            foreach($tester_information as $t){
                $r = rand(0,255);
                $b = rand(0,255);
                $g = rand(0,255);
                $a = 0.5;
                echo "'rgba($r, $g, $b, $a)',";
            }
            ?>

        ];

        var doughnutPieData_tester_info = {
            datasets: [{
                data: [
                    <?php
                    foreach($tester_information as $t){
                        echo "".$t["total"].",";
                    }
                    ?>
                ],
                backgroundColor:colors,
                borderColor: colors,
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                <?php
                foreach($tester_information as $t){
                    echo "'".$t["tester"]."',";
                }
                ?>

            ]
        };

        var doughnutPieOptions_tester_info = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        if ($("#doughnutChart_tester_info").length) {
            var doughnutChartCanvas_tester_info = $("#doughnutChart_tester_info").get(0).getContext("2d");
            var doughnutChart_tester_info = new Chart(doughnutChartCanvas_tester_info, {
                type: 'doughnut',
                data: doughnutPieData_tester_info,
                options: doughnutPieOptions_tester_info
            });
        }
    });


</script>


<script type="application/javascript">
    $(function () {
        var colors = [

            <?php
            foreach ($study_abroad_information as $sa) {
                $r = rand(0, 255);
                $b = rand(0, 255);
                $g = rand(0, 255);
                $a = 0.5;
                echo "'rgba($r, $g, $b, $a)',";
            }
            ?>

        ];


        var data = {
            labels: ["Not", "Summer", "Semester", "A year", "1.5+ years"],
            datasets: [{
                label: '# of Students',
                data: [
                    <?php
                    foreach ($study_abroad_information as $sa) {
                        echo "" . $sa["total"] . ",";
                    }
                    ?>
                ],
                backgroundColor: colors,
                borderColor: colors,
                borderWidth: 1
            }]
        };

        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };


        if ($("#barChart_StudyAbroad").length) {
            var barChartCanvas_study_abroad = $("#barChart_StudyAbroad").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart_studyabroad = new Chart(barChartCanvas_study_abroad, {
                type: 'bar',
                data: data,
                options: options
            });
        }
    });

</script>

<script>
    $(function () {
        var colors = [

            <?php
            foreach ($native_english_information as $ns) {
                $r = rand(0, 255);
                $b = rand(0, 255);
                $g = rand(0, 255);
                $a = 0.5;
                echo "'rgba($r, $g, $b, $a)',";
            }
            ?>

        ];


        var NativeEnglishPieData = {
            datasets: [{
                data: [
                    <?php
                    foreach ($native_english_information as $ns) {
                        echo "" . $ns["total"] . ",";
                    }
                    ?>
                ],

                backgroundColor: colors,
                borderColor: colors,
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                "Yes", "No",
            ]
        };

        var NativeEnglishPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };


        if ($("#NativeEnglishpieChart").length) {
            var NativeEnglishpieChartCanvas = $("#NativeEnglishpieChart").get(0).getContext("2d");
            var NativeEnglishpieChart = new Chart(NativeEnglishpieChartCanvas, {
                type: 'pie',
                data: NativeEnglishPieData,
                options: NativeEnglishPieOptions
            });
        }



    });


</script>





<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var High = "High";
        var Medium = "Medium";
        var Low = "Low";
        var Superior = "Superior";
        var data = google.visualization.arrayToDataTable([
            ['Level', 'HLL', 'ES', 'SL', "NS", "LDS", "Uncategorized"],
            <?php
            foreach ($comparable_levels_categories as $cl) {
                echo "[ '" .$cl["Level"] ."', " .$cl["HL"]." , ".$cl["ES"]." , ".$cl["SL"]." , ".$cl["NS"]." , ".$cl["LDS"].",".$cl["Not_sure"]."], ";
            }
            ?>
            // ['2014', 1000, 400, 200],
            // ['2015', 1170, 460, 250],
            // ['2016', 660, 1120, 300],
            //  ['2017', 1030, 540, 350]

        ]);
        console.log(data);

        var options = {
            chart: {
                // title: 'OPI Rate',
                // subtitle: 'Students OPI levels performance',

            },
            bars: 'vertical' ,// Required for Material Bar Charts.
            legend: { position: 'top', alignment: 'start'},
            // width: 900,
             height: $(window).height()*0.35,
            bar: {groupWidth: "98%"},
            // colors: ['#ccccff', '#b30000', '#33ffff', '#f5ccff']
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_levels'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>












<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>


<script src="assets/material-components-web/dist/material-components-web.min.js"></script>
<script src="assets/jquery/dist/jquery.min.js"></script>
<!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="assets/chart.js/dist/Chart.min.js"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/misc.js"></script>
<script src="js/material.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/chart.js"></script>
<!-- End custom js for this page-->
</body>

</html>
