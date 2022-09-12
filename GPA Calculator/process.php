<?php
require_once "config.php";

if (isset($_POST["save"]) && $_POST["save"] == 'Save') {
    echo $_POST["save"];
    $real_id = $_SESSION['login_id'];

    $course = $_POST["course_name"];
    $grade = $_POST["grade"];
    $credits = $_POST["credits"];
    //echo $course, $grade, $credits;
    $sql = "INSERT INTO courses (PersonID, CourseName, Grade, Credits) VALUES ('$real_id', '$course', '$grade', '$credits');";
    $insert_into_db = mysqli_query($linkid, $sql);

}

?>