<?php
	session_start();
	if(isset($_SESSION['UserId'])){
		if($_SESSION['UserId'] == 1){
		echo "You are signed in as " . $_SESSION['Name'] . "!";
		echo "<a href=\"logout.php\"><button type=\"button\">Log Out</button></a>";
		}elseif($_SESSION['UserId'] == 2){
		echo "You are signed in as " . $_SESSION['Name'] . "!";
		echo "<a href=\"logout.php\"><button type=\"button\">Log Out</button></a>";
		}
	}else{
		echo "You are not signed in! ";
		echo "<a href=\"login.php\"><button type=\"button\">Log In</button></a>";

	}
?>