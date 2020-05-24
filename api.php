<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 1/17/19
 * Time: 6:55 PM
 */

include ('db_adapter.php');
session_start();
if (!isset ($_SESSION["id"]))
{


    exit();
}

$isSuccessful =false;
$adapter = new dbadapter();

if ($_POST){
//    $userID =  $_POST["userid"];
//    $rate = $_POST["rate"];
//    $rate_level = $_POST["rate_level"];
//    $other_comments = $_POST["comments"];
//    $result =$adapter ->storeStudentGrade($userID, $rate, $rate_level, $other_comments);

    if($result===true){
        $response = array(
            "status" => "true"
        );
    }else{
        $response = array(
            "status" => "false"
        );
    }
    $jsonData =  json_encode($response);
    header("Content-type: application/json");
    echo $jsonData;
}
