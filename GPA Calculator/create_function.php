<?php
//session_start();
require_once "config.php";
$update = false;

$edit_course = '';
$edit_grade = '';
$edit_credit = '';

if (isset($_POST["save"]) && $_POST["save"] == 'Save') {
    //echo $_POST["save"];
    $real_id = $_SESSION['login_id'];
    $course = trim(htmlspecialchars($_POST["course_name"]));
    $grade = trim(htmlspecialchars($_POST["grade"]));
    $credits = trim(htmlspecialchars($_POST["credits"]));

    $course = trim(htmlspecialchars($course));
    $grade = trim(htmlspecialchars($grade));
    $credits = trim(htmlspecialchars($credits));
    //echo $course, $grade, $credits;
    $sql = "INSERT INTO courses (PersonID, CourseName, Grade, Credits) VALUES ('$real_id', '$course', '$grade', '$credits');";
    $insert_into_db = mysqli_query($linkid, $sql);

}

if(isset($_POST['deleteEntry'])) {
    $delete_id = $_POST['deleteEntry'];
    echo "dog";
    $query = "DELETE FROM courses WHERE id = $delete_id;";
    $delete_entry = mysqli_query($linkid, $query);
    //header("location: Create_Course_List.php");
}

if(isset($_POST['editEntry'])) {
    $edit_id = $_POST['editEntry'];
    $update = true;
    $query = "SELECT * FROM courses WHERE id = $edit_id;";
    $get_row = mysqli_query($linkid, $query);
    $current_row = mysqli_fetch_assoc($get_row);

    $edit_course = $current_row['CourseName'];
    $edit_grade = $current_row['Grade'];
    $edit_credit = $current_row['Credits'];

    $course = $_POST["course_name"];
    $grade = $_POST["grade"];
    $credits = $_POST["credits"];

    //$edit_query = "UPDATE courses SET CourseName='$course', Grade='$grade', Credits='$credits' WHERE id='$edit_id';";
    //$update_entry = mysqli_query($linkid, $edit_query);
    

    echo $edit_course, $edit_grade, $edit_credit;
    //header("location: Create_Course_List.php");
}

?>