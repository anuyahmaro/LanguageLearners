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

$students = $adapter->getStudentRecords();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Records</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="image/png" href="images/favicon/ll_logo.png"/>

</head>

<body>
<div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <aside class="mdc-persistent-drawer mdc-persistent-drawer--open">
        <nav class="mdc-persistent-drawer__drawer">
            <div class="mdc-persistent-drawer__toolbar-spacer">
                <a href="dashboard.php" class="brand-logo">

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
                            <section class="mdc-card__primary">
                                <h1 class="mdc-card__title mdc-card__title--large"></h1>
                            </section>
                            <div class="">
                                <table id="example" class="mdl-data-table responsive-table" >
<!--                                <table class="table js-exportable">-->
                                    <thead>
                                    <tr>
                                        <th class="text-left">Student ID</th>
                                        <th>Name</th>
                                        <th>Spanish Class</th>
                                        <th>Anticipated Rate</th>
                                        <th>OPI Score</th>
<!--                                        <th>Rate Level</th>-->
                                        <th>Category</th>
                                        <th>Major</th>
                                        <th>Minor</th>
                                        <th>Study Abroad Country</th>
                                        <th>Tester</th>
                                        <th>Semester</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($students as $st){
                                         echo   "<tr>";
                                         echo  "<td class='text-left'>".$st["studentID"]."</td>";
                                         echo  "<td >".$st["FirstName"]." ".$st["LastName"]."</td>";
                                         echo  "<td >".$st["SpanishClass"]."</td>";
                                         echo  "<td >".$st["anticipated_rate"]."</td>";
                                         echo  "<td >".$st["rate"]." ".$st["rate_level"]."</td>";
//                                         echo  "<td >".$st["rate"]."</td>";
//                                         echo  "<td >".$st["rate_level"]."</td>";
                                         echo  "<td >".$st["category"]."</td>";
                                         echo  "<td >".$st["Major"]."</td>";
                                         echo  "<td >".$st["Minor"]."</td>";
                                         echo  "<td >".$st["country_abroad"]."</td>";
                                         echo  "<td >".$st["tester"]."</td>";
                                         echo  "<td >".$st["semester"]." ".$st["study_year"]."</td>";

                                        }

                                    ?>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
<script src="http://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.material.min.js"></script>

<!--<script src="assets/jquery-datatable/jquery.dataTables.js"></script>-->
<!--<script src="assets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>-->
<script src="assets/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="assets/jquery-datatable/extensions/export/buttons.print.min.js"></script>





<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2,3 ],
                    className: 'mdl-data-table__cell--non-numeric dataTables_borderWrap'
                }
            ],
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            "sScrollX": "100%",
            "bScrollCollapse": true,
        "sScrollXInner": "120%",
            responsive: true,
            lengthChange:true,
        //   dom : 'BlftpS',
        });
    } );
//
//
//
//
// $(function () {
//
//     $('#example')
//         .wrap("<div class='dataTables_borderWrap ' />").DataTable({
//         dom: 'Bfrtip',
//         responsive: true,
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//
//         ],
//         columnDefs: [
//             {
//                 targets: [ 0, 1, 2,3 ],
//                 className: 'mdl-data-table__cell--non-numeric dataTables_borderWrap'
//             }
//         ],
//         "sScrollX": "100%",
//         "sScrollXInner": "120%",
//         "bScrollCollapse": true,
//         //     columnDefs: [
//         //         {
//         //             targets: [ 0, 1, 2 ],
//         //             className: 'mdl-data-table__cell--non-numeric'
//         //         }
//         //     ]
//         // } );
//     });
//
// });mdl-data-table__cell--non-numeric



    // $(document).ready(function() {
    //
    //     $('#example').DataTable({
    //         .wrap("<div class='dataTables_borderWrap mdl-data-table__cell--non-numeric' />").DataTable({
    //             dom: 'Bfrtip',
    //             responsive: true,
    //             buttons: [
    //                 'copy', 'csv', 'excel', 'pdf', 'print'
    //
    //             ],
    //             "sScrollX": "100%",
    //             "sScrollXInner": "120%",
    //             "bScrollCollapse": true,
    //         });
    //
    // })
    //     ;
    //
    // });



</script>




</body>

</html>
