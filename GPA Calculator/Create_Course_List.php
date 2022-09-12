<?php
session_start();
require_once "config.php";
include_once "create_function.php";

if(!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true){
    header("location: login.php");
    exit;
}

//$username = $_SESSION['login_username'];
$real_id = $_SESSION['login_id'];
$user_courses_array = array();
//echo $real_id;
$get_course_list_sql = "SELECT CourseName, Grade, Credits, id FROM courses  WHERE (courses.PersonID = '$real_id');";
$generate_course_list = mysqli_query($linkid, $get_course_list_sql);

$get_gpa_sql = "SELECT Grade, Credits FROM courses  WHERE (courses.PersonID = '$real_id');";
$get_gpa_list = mysqli_query($linkid, $get_gpa_sql);


$gpa_mult_credits = 0;
$total_credits = 0;
$gpa_grade = 0;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Course List</title>
</head>
<body>
	
<h2>Create Course List</h2>

<table>
    <thead>
        <tr>
            <th>Course Name</th>
            <th>Grade</th>
            <th>Credit</th>
            <th>Delete</th>
            <th>Edit</th>

            <?php
            while ($row = mysqli_fetch_assoc($generate_course_list)):
            ?>
            <tr>
                <?php 
                    if ($row["Grade"] == 'A'){
                        $gpa_grade = 4;
                    }else if ($row["Grade"] == 'A-'){
                        $gpa_grade = 3.7;
                    }else if ($row["Grade"] == 'B+'){
                        $gpa_grade = 3.3;
                    } else if ($row["Grade"] == 'B'){
                        $gpa_grade = 3;
                    }else if ($row["Grade"] == 'B-'){
                        $gpa_grade = 2.7;
                    }else if ($row["Grade"] == 'C+'){
                        $gpa_grade = 2.3;
                    } else if ($row["Grade"] == 'C'){
                        $gpa_grade = 2;
                    }else if ($row["Grade"] == 'C-'){
                        $gpa_grade = 1.7;
                    }else if ($row["Grade"] == 'D+'){
                        $gpa_grade = 1.3;
                    }else if ($row["Grade"] == 'D'){
                        $gpa_grade = 1;
                    }else if ($row["Grade"] == 'F'){
                        $gpa_grade = 0;
                    }
                    $gpa_mult_credits = ($gpa_grade * $row["Credits"]) + $gpa_mult_credits;
                    $total_credits = $total_credits + $row["Credits"];
                    // echo $gpa_mult_credits, "<br>";
                    // echo $total_credits, "<br>";
                    //echo "total GPA is: ", ($gpa_mult_credits / $total_credits), "<br>";
                ?>
                <td> <?php echo $row["CourseName"]?></td>
                <td> <?php echo $row["Grade"]?></td>
                <td> <?php echo $row["Credits"]?></td>
                <td> <form id="deleteForm"><input type="button" name="delete" onclick="delete_from_table(<?php echo $row['id']?>)" id="delete_button" value="Delete" /></form></td>               <?php //echo $row["id"]?> <!--<button name="button_delete" value='button_delete' id="<?php //echo $row["id"]?>">Delete</button>-->
                <td> <form id="editForm"><input type="button" name="edit" onclick="edit_entry(<?php echo $row['id']; ?>)" id="edit_button" value="Edit" /></form></td>
            </tr>
            <?php endwhile;?>
        </tr>
    </thead>
</table>

<?php echo "Total GPA is: ", round(($gpa_mult_credits / $total_credits),2), "<br>";?>

<script src="create_course_js_function.js"></script>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="saveForm" method="post">

<br><br><label>Course Name</label>
	<input type="text" name="course_name" value="<?php echo $edit_course;?>"/><br><br>

	<label>Grade</label>
	<select name="grade" id="grade">
    <option value="<?php echo $edit_grade?>" ></option>
        <option value="A">A</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B">B</option>
        <option value="B-">B-</option>
        <option value="C+">C+</option>
        <option value="C">C</option>
        <option value="C-">C-</option>
        <option value="D+">D+</option>
        <option value="D">D</option>
        <option value="F">F</option>
    </select><br><br>

    <div name="test"></div>

    <label>Credits</label>
    <input type="number" name="credits" id="credits" value="<?php echo $edit_credit;?>"/><br><br>
    
	<input type="submit" name="save" class="btn btn-primary" value="Save"><br><br>

    <a href="logout.php">Click here to Log out</a><br>
</form>
</body>
<?php //htmlspecialchars($_SERVER["PHP_SELF"]); ?>
<!-- value="<?php //echo $course?>"
value="<?php //echo $grade?>
value="<?php //echo $credit?>" -->
</html>