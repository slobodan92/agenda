<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
	Search by: <br>
	Last Name: <input type="text" name="lname"><br>
	OR<br>
	First Name: <input type="text" name="fname"><br>
	<input type="submit" value="Search">
</form>

<?php
if (!empty($_GET['lname'])) {

	$lastName = ucfirst($_GET['lname']);

	$mysqli = new mysqli ( 'localhost', 'root', '', 'shqdb' );

	$sqlSearch = "SELECT LastName FROM contact WHERE LastName LIKE '%.$lastName.%'";

	$search = $mysqli->query($sqlSearch);

	if ($search) {
		
		$sqlShow = 'SELECT contact.ContactId, contact.LastName, contact.FirstName, contactdetails.PhoneNumber, contactdetails.email, address.StreetName, address.StreetNumber, address.Bloc, address.Scale, address.Apartament FROM contact JOIN contactdetails ON contact.ContactId = contactdetails.ContactId JOIN address ON address.AddressId = contact.ContactId WHERE contact.LastName LIKE "%'.$lastName.'%"';

		$searchShow = $mysqli->query($sqlShow);

		echo "</div><div class=\"containerCenter\"><table border='2'>";

		echo "<th>Nr.</th><th>Last Name</th><th>First Name</th><th>Phone Number</th><th>e-Mail</th><th>Address</th>";

		foreach ($searchShow as $key => $value) {

			echo "<tr><td>" . ($key + 1) . "</td><td>" . $value['LastName'] . "</td><td>" . $value['FirstName'] . "</td><td>0" . $value['PhoneNumber'] . "</td><td>" . $value['email'] . "</td><td>" . $value['StreetName'] . " " . $value['StreetNumber'] . " Bl: " . $value['Bloc'] . " Sc: " . $value['Scale'] . " Ap: " . $value['Apartament'] . "</td>";

			if($_SESSION['UserId'] == 1){

				echo "<td><a href=\"update.php?ContactId=" . $value['ContactId'] . "\">Edit</a></td>";

				echo "<td><a href=\"delete.php?ContactId=" . $value['ContactId'] . "\">Delete</td></tr>";

			}elseif($_SESSION['UserId'] == 2){

				echo "<td><a href=\"update.php?ContactId=" . $value['ContactId'] . "\">Edit</a></td></tr>";

			}else{

				echo "</tr>";

			}
		}

		echo "</table>";
	}else{
		echo "The person you searched is not in our database!";
	}

}elseif (!empty($_GET['fname'])) {

	$firstName = ucfirst($_GET['fname']);

	$mysqli = new mysqli ( 'localhost', 'root', '', 'shqdb' );

	$sqlSearch = "SELECT FirstName FROM contact WHERE FirstName LIKE '%$firstName%'";

	$search = $mysqli->query($sqlSearch);

	if ($search) {

		$sqlShow = 'SELECT contact.ContactId, contact.LastName, contact.FirstName, contactdetails.PhoneNumber, contactdetails.email, address.StreetName, address.StreetNumber, address.Bloc, address.Scale, address.Apartament FROM contact JOIN contactdetails ON contact.ContactId = contactdetails.ContactId JOIN address ON address.AddressId = contact.ContactId WHERE contact.FirstName LIKE "%'.$firstName.'%"';

		$searchShow = $mysqli->query($sqlShow);

		echo "<table border='2'>";

		echo "<th>Nr.</th><th>Last Name</th><th>First Name</th><th>Phone Number</th><th>e-Mail</th><th>Address</th>";

		foreach ($searchShow as $key => $value) {

			echo "<tr><td>" . ($key + 1) . "</td><td>" . $value['LastName'] . "</td><td>" . $value['FirstName'] . "</td><td>0" . $value['PhoneNumber'] . "</td><td>" . $value['email'] . "</td><td>" . $value['StreetName'] . " " . $value['StreetNumber'] . " Bl: " . $value['Bloc'] . " Sc: " . $value['Scale'] . " Ap: " . $value['Apartament'] . "</td>";

			if($_SESSION['UserId'] == 1){

				echo "<td><a href=\"update.php?ContactId=" . $value['ContactId'] . "\">Edit</a></td>";

				echo "<td><a href=\"delete.php?ContactId=" . $value['ContactId'] . "\">Delete</td></tr>";

			}elseif($_SESSION['UserId'] == 2){

				echo "<td><a href=\"update.php?ContactId=" . $value['ContactId'] . "\">Edit</a></td></tr>";

			}else{

				echo "</tr>";
			}
		}

		echo "</table>";

	}else{
		echo "The person you searched is not in our database!";
	}

}