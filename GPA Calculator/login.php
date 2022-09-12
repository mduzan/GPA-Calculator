<?php
session_start();

if(isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] === true){
    header("location: Create_Course_List.php");
    exit;
}
$login_error = False;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require_once "config.php";

    $username = trim(htmlspecialchars($_POST["username"]));
    $password = trim(htmlspecialchars($_POST["password"])); 

    $check_user = "SELECT username, password FROM users 
    WHERE username = '$username' and password = '$password';";

    $num_users = mysqli_query($linkid, $check_user);
    $user_count = mysqli_num_rows($num_users);

    if ($user_count == 1) {
        $_SESSION['login_username'] = $username;
        $_SESSION['user_logged_in'] = true;

        $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password';";
        $get_id = mysqli_query($linkid, $sql);

        while ($record = mysqli_fetch_row($get_id)){
	        $find_id[] = $record;
        }
        $real_id = $find_id[0][0];
        $_SESSION['login_id'] = $real_id;

        header("location: Create_Course_List.php");
    } else {
        $login_error = True;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
	
<h2>Login</h2>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	<label>Username</label><br>
	<input type="text" name="username" required/><br><br>

	<label>Password</label><br>
	<input type="password" name="password" required/><br><br>

	<input type="submit" name="submit" class="btn btn-primary" value="Login">
	<input type="reset" class="btn btn-secondary ml-2" value="Reset"><br><br>

    <a href="register.php">Sign up here</a>
<?php
if ($login_error) {
    echo "Username or password is invalid!";
}
?>
</form>
</body>
</html>