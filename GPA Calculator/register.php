<?php

$username_empty = False;
$username_taken = False;
$password_error = False;
$accept_user = False;

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
	require_once "config.php";

	$username = trim(htmlspecialchars($_POST["username"])); 
    $password = trim(htmlspecialchars($_POST["password"])); 
	$confirm_password = trim(htmlspecialchars($_POST["confirm_password"]));

	//mysqli_real_escape_string($linkid,$username);
	$check_user = "SELECT * FROM users WHERE username = '$username';";
	$num_users = mysqli_query($linkid, $check_user);
	$user_count = mysqli_num_rows($num_users); 

	if (empty($username) || empty($password)){
		$username_empty = True;
	} else {
		if ($user_count > 0) {
			$username_taken = True;
		} else {
			if ($password == $confirm_password) {
				
				$new_user = "INSERT INTO users 
				(username, password) VALUES ('$username', '$password');";
				$create_user =  mysqli_query($linkid, $new_user);

				if ($create_user) {
					$accept_user = True;
				}
			} else {
				$password_error = True;
			}
		}
	}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
	
<h2>Sign Up</h2>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

	<label>Username</label><br>
	<input type="text" name="username" required/><br><br>

	<label>Password</label><br>
	<input type="password" name="password" required/><br><br>

	<label>Confirm Password</label><br>
	<input type="passwordt" name="confirm_password" required/><br><br>

	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
	<input type="reset" class="btn btn-secondary ml-2" value="Reset"><br><br>

	<a href="login.php">Login here</a>


</form>
<?php
	//printf("error: %s\n", mysqli_error($linkid));
?>
</body>

<?php
if ($username_empty) {
	echo "Please fill out the entire form!";
}
if ($username_taken) {
	echo "Username is unavailable!";
}
if ($password_error) {
	echo "The passwords do not match!";
}
if ($accept_user) {
	echo "Username and password accepted, Welcome!";
}
?>
</html>