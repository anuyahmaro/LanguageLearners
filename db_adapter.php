<?php
/**
 * Created by IntelliJ IDEA.
 * User: maroanuyah
 * Date: 12/29/18
 * Time: 4:57 PM
 */


class dbadapter
{

    public $conn = null;


    function __construct(){
        date_default_timezone_set("America/Boise");
        $this-> conn = mysqli_connect("localhost:8889","root","root","LangLearnersDB");
//        if ($this->conn){
//            echo "connected";
//        }
    }

    function clear (){

    }

    function getconnection()
    {
        return $this->conn;
    }
    function __destruct(){
        $this->clear ();
    }


//
    function storeuserinfo ($first_name, $last_name, $student_id, $sp_class_id, $rate_id,  $category_id,
                            $native_english, $spanish_speaker, $study_abroad, $country_abroad,$major,
                            $minor, $tester_id, $study_year, $semester_id ){
        $guid = $this->guid();
//        $id =-1;
//        $now = date('Y-m-d H:i:s');


        $query= "insert into UserInfo (`FirstName`, `LastName`, `studentID`, `rate_id`, `category_id`, `NativeEnglishSpeaker`, `study_abroad_id`, `country_abroad`, `Major`, `Minor`, `tester_id`, `study_year`, `semester_id`, `guid`) 
                                      VALUES ('$first_name', '$last_name', '$student_id', '$rate_id',  '$category_id', '$native_english', '$study_abroad', '$country_abroad', '$major', '$minor', '$tester_id', '$study_year', '$semester_id','$guid')";

        ;

        if ($this->conn->query ($query)){
            //echo "successful";
            $query = "SELECT `id` FROM `UserInfo` WHERE `guid`='$guid';";
            $result = $this->conn->query ($query)->fetch_assoc();

            $id = $result["id"];
            $store = "INSERT INTO `spanish_speaking_category`(`userID`,`spanish_speaker_id`) VALUES ";
            $store_sp_class = "INSERT INTO `User_SpanishClass`(`userID`,`studentID`,`sp_class`) VALUES ('$id','$student_id', '$sp_class_id')";
            $store_tester_grade = "INSERT INTO `User_AssignedGrade`(`userID`, `rate_id`, `rate_level_id`, `other_comments`) VALUES ('$id', 5, 5, '***************')";
            $size = count($spanish_speaker);
            $count = 1;
            foreach($spanish_speaker as $s=>$value){

                $store.="('$id','$value')". ($count==$size?"":",");
                ++$count;

            }
            $store.=";";

            //echo  $store;
            $result = $this->conn->query($store);
            $result2 = $this->conn->query($store_sp_class);
            $result3 = $this->conn->query($store_tester_grade);
            if($result && $result2 ){
                return true;

            } else
                return false;


        }

        return false;
    }


    function storeAdminInfo ($first_name, $last_name, $email, $username, $password){
//        $searchuid = $this->guid();
//        $id =-1;
//        $now = date('Y-m-d H:i:s');
        $username = strtolower($username);

        $query= "insert into admin_information (`first_name`, `last_name`, `email` ,`username`, `password`) 
                                      VALUES ('$first_name', '$last_name', '$email','$username', '$password')";



        if ($this->conn->query ($query)){

            return true;
        }
        echo"failed";
        return false;
    }

    function getTesterInfo(){
        $query = "SELECT * FROM `TesterInfo`;";
        $result = $this->conn->query ($query);
        $testerInfo = array ();

        while ($row = $result->fetch_assoc()){

            $testerInfo[] = array (
                'id' => $row ['id'],
                'tester' => $row ['tester']
            );
        }
        return $testerInfo;
    }

    function userNameExists($username){
        $query = "SELECT COUNT(*) as total FROM `admin_information` WHERE username='$username';";
        $result = $this->conn->query ($query)->fetch_assoc();

        return $result["total"]>0;
    }

    function getSemester(){
        $query = "SELECT * FROM `Semester`;";
        $result = $this->conn->query ($query);
        $semester = array ();

        while ($row = $result->fetch_assoc()){

            $semester[] = array (
                'id' => $row ['id'],
                'semester' => $row ['semester']
            );
        }
        return $semester;
    }


    function getSpanishClass(){
        $query = "SELECT * FROM `SpanishClass`;";
        $result = $this->conn->query ($query);
        $class = array ();

        while ($row = $result->fetch_assoc()){

            $class[] = array (
                'id' => $row ['id'],
                'name' => $row ['name']
            );
        }
        return $class;
    }

    function getCountries(){
        $query = "SELECT * FROM `apps_countries`;";
        $result = $this->conn->query ($query);
        $countries = array ();

        while ($row = $result->fetch_assoc()){

            $countries[] = array (
                'id' => $row ['id'],
                'country_name' => $row ['country_name']
            );
        }
        return $countries;
    }

    function getRates(){
        $query = "SELECT * FROM `Rate`;";
        $result = $this->conn->query ($query);
        $rates = array ();

        while ($row = $result->fetch_assoc()){

            $rates[] = array (
                'id' => $row ['id'],
                'rate' => $row ['rate']
            );
        }
        return $rates;
    }

    function getRateLevel(){
        $query = "SELECT * FROM `RateLevel`;";
        $result = $this->conn->query ($query);
        $rate_levels = array ();

        while ($row = $result->fetch_assoc()){

            $rate_levels[] = array (
                'id' => $row ['id'],
                'rate_level' => $row ['rate_level']
            );
        }
        return $rate_levels;
    }

    function getCategory(){
        $query = "SELECT * FROM `Category`;";
        $result = $this->conn->query ($query);
        $category = array ();

        while ($row = $result->fetch_assoc()){

            $category[] = array (
                'id' => $row ['id'],
                'category' => $row ['category'],
                'hints' => $row ['hints']
            );
        }
        return $category;
    }

    function login($username, $password){
        $username = strtolower($username);
        //echo $username;
        //$hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT COUNT(`userID`) as total FROM `admin_information` WHERE username='$username';";
        $result = $this->conn->query ($query)->fetch_assoc();
        if($result["total"]>0){
            echo "record exists";
            $query = "SELECT `userID`,`password` FROM `admin_information` WHERE username='$username';";
            $result = $this->conn->query ($query)->fetch_assoc();
            echo $password;

            if (password_verify($password, $result["password"])){
                return $result["userID"];
                echo "password working";
            }else
                return -1;


        }else
            return -1;
    }


    function forgotPassword($username)
    {
        $username = strtolower($username);

        $query = "SELECT * FROM `admin_information` WHERE username = '$username'";
        $result = $this->conn->query($query);
        $count = mysqli_num_rows($result);
        //$admin_info = array();



        if ($count == 1) {
            $r = mysqli_fetch_assoc($result);
            $password = $r['password'];
            $to = $r['email'];
            $subject = "Your Recovered Password";



            $message = "Please use this password to login " . $password;
            // $message."$pwrurl = "www.yoursitehere.com/reset_password.php?q=\".$password";


            $headers = "From : noreply@languagelearners.edu";
//                if (mail($to, $subject, $message, $headers)) {
//                    echo "Your Password has been sent to your email id";
//                } else {
//                    echo "Failed to Recover your password, try again";
//                }

        } else {
            echo "User name does not exist in database";
        }


    }

    function changePassword($username, $password){
        $query = "SELECT * FROM `admin_information` WHERE username = '$username'";
        $result = $this->conn->query($query);
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $r = mysqli_fetch_assoc($result);
            $username = $r['username'];


            $query= "UPDATE `admin_information` SET `password` = '$password' WHERE username = '$username'";

            if ($this->conn->query ($query)){

                return true;
            }




            else{
                echo "Could not update the password";
            }


        } else {
            echo "User name does not exist in database";
        }


    }



    function guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
            return $uuid;
        }
    }


    function getAdminData(){
        $query = "SELECT * FROM `admin_information`;";
        $result = $this->conn->query ($query);
        $admin_info = array ();

        while ($row = $result->fetch_assoc()){

            $admin_info[] = array (
                'userID' => $row ['userID'],
                'username' => $row ['username'],
                'email' => $row ['email'],
                'first_name' => $row ['first_name'],
                'last_name' => $row ['last_name'],
                'password' => $row ['password'],
            );
        }
        return $admin_info;
    }


    function getStudyAbroad(){
        $query = "SELECT * FROM `StudyAbroad`;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'id' => $row ['id'],
                'name' => $row ['name']
            );
        }
        return $name;
    }

    function getSpanishSpeaker(){
        $query = "SELECT * FROM `SpanishSpeaker`;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'id' => $row ['id'],
                'name' => $row ['name']
            );
        }
        return $name;
    }

    function getLanguageCatGroups(){
        $query = "select c.category, count(*) as total  from Category as c JOIN UserInfo as U on c.id = U.category_id GROUP BY u.category_id ";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'category' => $row ['category'],
                'total' => $row ['total']
            );
        }
        return $name;
    }


//    function getRateLevelGroups(){
//        $query = "select r.rate_level as level, rt.rate, COUNT(*) as total from UserInfo as U JOIN RateLevel as r on
//r.id = U.rate_level_id JOIN Rate as rt on rt.id = U.rate_id GROUP by r.rate_level, rt.rate; ";
//        $result = $this->conn->query ($query);
//        $name = array ();
//
//        while ($row = $result->fetch_assoc()){
//
//            $name [] = array (
//                'level' => $row ['level'],
//                'rate' => $row ['rate'],
//                'total' => $row ['total']
//            );
//        }
//        return $name;
//    }



    function getTesterGroups(){
        $query = "select t.tester, count(*) as total  from TesterInfo as t JOIN UserInfo as U on t.id = U.tester_id GROUP BY U.tester_id  ";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'tester' => $row ['tester'],
                'total' => $row ['total']
            );
        }
        return $name;
    }


    function getStudentEnrollment(){
        $query = "select s.semester, U.study_year, COUNT(*) as total from UserInfo as U JOIN Semester as s on s.id = U.semester_id GROUP by s.semester, u.study_year;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'semester' => $row['semester'],
                'study_year' => $row ['study_year'],
                'total' => $row ['total']

            );
        }
        return $name;
    }


    function getComparableCategories(){
        $query = "SELECT  Rate, 
                        sum(case when Category = 'Extended Study Abroad (ESA)' then Total else 0 end) 'ES',
                        sum(case when Category = 'Heritage Learner (HL)' then Total else 0 end) 'HL',
                        sum(case when Category = 'Second Language Learner (SLL)' then Total else 0 end) 'SL',
                        sum(case when Category = 'Native Speaker (NS)' then Total else 0 end) 'NS'
                        FROM (
                            select c.category as Category,  r.rate as Rate, COUNT(*) as Total from UserInfo as ui join Category as c on ui.category_id = c.id join User_AssignedGrade as ua on ui.id = ua.userID
                        join Rate as r on ua.rate_id = r.id where r.id != 5 GROUP by c.category, r.rate
                        ) t GROUP BY t.Rate;";

        $result = $this->conn->query ($query);

        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'Rate' => $row['Rate'],
                'ES' => $row ['ES'],
                'HL' => $row ['HL'],
                'SL' => $row ['SL'],
                'NS' => $row ['NS']

            );
        }
        return $name;

    }



    function getComparableLevelCategories(){
        $query = "SELECT  OPI,        sum(case when Category = 'Extended Study Abroad (ESA)' then Total else 0 end) 'ES',
                    sum(case when Category = 'Heritage Learner (HL)' then Total else 0 end) 'HL',
                    sum(case when Category = 'Second Language Learner (SLL)' then Total else 0 end) 'SL',
                    sum(case when Category = 'Native Speaker (NS)' then Total else 0 end) 'NS'
                    FROM (
                       select c.category as Category, CONCAT_WS( \" \",ra.rate, r.rate_level) as OPI, COUNT(*) as Total from UserInfo as ui join Category as c on ui.category_id = c.id join 	User_AssignedGrade as ua on ui.id = ua.userID
                    join RateLevel as r on ua.rate_level_id = r.id
                    join Rate as ra on ua.rate_id = ra.id
                    where r.id != 4 GROUP by c.category, ra.rate, r.rate_level
                    ) t  GROUP BY t.OPI;";

        $result = $this->conn->query ($query);

        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'Level' => $row['OPI'],
                'ES' => $row ['ES'],
                'HL' => $row ['HL'],
                'SL' => $row ['SL'],
                'NS' => $row ['NS']

            );
        }
        return $name;

    }


    function getStudyAbroadStats(){
        $query = "select sa.name, COUNT(*) as total from UserInfo as U JOIN StudyAbroad as sa on sa.id = U.study_abroad_id GROUP by sa.id;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'name' => $row['name'],
                'total' => $row ['total']

            );
        }
        return $name;
    }

    function getNativeEnglishSpeakerStats(){
        $query = "SELECT COUNT(*) AS total from UserInfo as u GROUP by u.NativeEnglishSpeaker;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'total' => $row ['total']

            );
        }
        return $name;
    }


    function getStudentRecords(){
        $query = "SELECT DISTINCT(ui.studentID), ui.FirstName, ui.LastName, r1.rate as anticipated_rate, r2.rate , rl.rate_level,  SpanishClass.name  as SpanishClass, category, country_abroad, Major, Minor, tester, study_year, semester from UserInfo as ui JOIN Rate as r1 ON ui.rate_id = r1.id 
                JOIN Category ON ui.category_id = Category.id 
                JOIN TesterInfo ON ui.tester_id = TesterInfo.id 
                JOIN Semester ON ui.semester_id = Semester.id
            	inner join User_SpanishClass ON ui.id = User_SpanishClass.userID
                JOIN SpanishClass ON User_SpanishClass.sp_class = SpanishClass.id
                join User_AssignedGrade as ua on ui.id=ua.userID 
                JOIN RateLevel as rl on ua.rate_level_id = rl.id
                join Rate as r2 on ua.rate_id = r2.id;";
        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'FirstName' => $row['FirstName'],
                'LastName' => $row ['LastName'],
                'rate' => $row ['rate'],
                'anticipated_rate' => $row['anticipated_rate'],
                'rate_level' => $row ['rate_level'],
                'category' => $row ['category'],
                'Major' => $row ['Major'],
                'Minor' => $row ['Minor'],
                'tester' => $row ['tester'],
                'study_year' => $row ['study_year'],
                'semester' => $row ['semester'],
                'studentID' => $row ['studentID'],
                'SpanishClass' => $row['SpanishClass'],
                'country_abroad' => $row ['country_abroad']


            );
        }
        return $name;
    }






    function gradeStudent(){

        $query = "select UserInfo.studentID, UserInfo.id as userID, UserInfo.FirstName, UserInfo.LastName, RateLevel.rate_level, Rate.rate, 
SpanishClass.name as SpanishClass, RateLevel.rate_level as scored_level, Rate.rate as scored_rate, 
User_AssignedGrade.rate_id as score_rate_id, User_AssignedGrade.rate_level_id as score_rate_level_id, User_AssignedGrade.other_comments
                    from UserInfo join User_AssignedGrade on UserInfo.id = User_AssignedGrade.userID JOIN RateLevel on 
                    RateLevel.id = User_AssignedGrade.rate_level_id JOIN Rate on User_AssignedGrade.rate_id = Rate.id
                    JOIN User_SpanishClass on UserInfo.id = User_SpanishClass.userID join SpanishClass on 
                    User_SpanishClass.sp_class = SpanishClass.id;";

        $result = $this->conn->query ($query);
        $name = array ();

        while ($row = $result->fetch_assoc()){

            $name [] = array (
                'FirstName' => $row['FirstName'],
                'LastName' => $row ['LastName'],
                'rate' => $row ['rate'],
                'rate_level' => $row ['rate_level'],
                'studentID' => $row ['studentID'],
                'userID' => $row['userID'],
                'SpanishClass' => $row['SpanishClass'],
                'scored_rate' => $row ['scored_rate'],
                'scored_level' => $row ['scored_level'],
                'score_rate_id' => $row['score_rate_id'],
                'score_rate_level_id' => $row['score_rate_level_id'],
                'other_comments' => $row['other_comments']


            );
        }
        return $name;
    }





    function getDashboard (){
        $languageProficiency = array();

        $testedBy = array();


        $dashboard=array(
            "language_proficiency" => $languageProficiency,
            "tested_by" =>$testedBy
        );
    }

    function execute ($querystring)
    {
        return $this->conn->query($querystring);
    }

    function storeStudentGrade($id, $rate_id, $rate_level_id, $other_comments){

        $query= "update `User_AssignedGrade` set `rate_id` = '$rate_id', `rate_level_id` = '$rate_level_id', `other_comments` = '$other_comments' where `userID` =  '$id';";



        if ($this->conn->query ($query)){

            return true;
        }
        echo"failed";
        return false;

    }
}








?>
