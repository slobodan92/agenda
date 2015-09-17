<?php
session_start();

if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$mysqli = new mysqli( 'localhost', 'root', '', 'shqdb');
	$sql = "SELECT * FROM users WHERE Username LIKE '$username' AND Password LIKE '$password'";
	$search = $mysqli->query($sql);
	if ($search->num_rows) {
		$myArray = array();
		foreach ($search as $key => $value) {
			$myArray[] = $value;
		}
		$_SESSION['UserId'] = $myArray[0]['UsernameId'];
		$_SESSION['Name'] = $myArray[0]['Username'];
		header('Location: index.php');
	}else{
		echo "Username or Password is incorect!";
	}
}else{
	echo "Please fill in all the fields!";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
</head>
<body style="text-align: center">
	<div  style="margin-left: 41%">
		<form method="post">
			<fieldset style="width: 210px">
				<legend>Log In</legend>
				Username: <input type="text" name="username"><br>
				Password: <input type="password" name="password"><br>
				<input type="submit" value="Login">
			</fieldset>
		</form>
	</div>
</body>
</html>