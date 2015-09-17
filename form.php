<?php
$_SESSION['MessageA'] = "";
// define variables and set to empty values
$lnameErr = $emailErr = $numberErr = $fnameErr = "";
$lname = $email = $fname = $number = $adress = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if (empty($_POST["lname"])) {
     $lnameErr = "Name is required";
   } else {
     $lname = test_input($_POST["lname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
       $lnameErr = "Only letters and white space allowed";
     }
   }

   if (empty($_POST["fname"])) {
     $fnameErr = "Name is required";
   } else {
     $fname = test_input($_POST["fname"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
       $fnameErr = "Only letters and white space allowed";
     }
   }
  
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format";
     }
   }

   if (empty($_POST["phonenumber"])) {
     $numberErr = "You must insert 10 digits";
   }else{
    $number = test_input($_POST["phonenumber"]);
     if(!preg_match("/^[0-9]{10}$/", $number)) {
      $numberErr = "Invalid phone number format";
    }
   }
    
   if (empty($_POST["adress"])) {
     $adress = "";
   } else {
     $adress = test_input($_POST["adress"]);
   }

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	Last Name: <br><input type="text" name="lname">
	<span class="error">* <?php echo $lnameErr;?></span>
    <br><br>
	First Name: <br><input type="text" name="fname">
	<span class="error">* <?php echo $fnameErr;?></span>
    <br><br>
  Phone Number: <br><input type="text" name="phonenumber">
  <span class="error">* <?php echo $numberErr;?></span>
    <br><br>
	E-mail: <br><input type="text" name="email">
	<span class="error">* <?php echo $emailErr;?></span>
    <br><br>
	<u>Adress</u>: <br>
  Street Name: <br><input type="text" name="streetName"><br>
  Street Number: <br><input type="number" name="streetNumber"><br>
  Bloc: <br><input type="text" name="bloc"><br>
  Scale: <br><input type="text" name="scale"><br>
  Apartament: <br><input type="number" name="apartament"><br>
	<input type="submit" type="submit" value="ADD">
</form>
<?php 

if ( !empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['streetName']) && !empty($_POST['phonenumber']) && !empty($_POST['streetNumber']) && !empty($_POST['bloc']) && !empty($_POST['scale']) && !empty($_POST['apartament'])){

	$lname = $_POST["lname"];
	$fname = $_POST["fname"];
  $phoneNumber = $_POST["phonenumber"];
	$email = $_POST["email"];
	$streetName = $_POST["streetName"];
  $streetNumber = $_POST["streetNumber"];
  $bloc = $_POST["bloc"];
  $scale = $_POST["scale"];
  $apartament = $_POST["apartament"];

	$mysqli = new mysqli( "localhost", "root", "", "shqdb");

	if (mysqli_connect_errno()) {     
		echo 'Connect failed: ' . mysqli_connect_error();     
		exit; 
	}  

	$mysqli->autocommit(FALSE); 

	$mysqli->query(     
		              "INSERT INTO contact ( LastName, FirstName )      
		              VALUES ( '$lname', '$fname' )" 
                );
  $lastId = $mysqli->insert_id;
  $mysqli->query(
                  "INSERT INTO contactdetails ( PhoneNumber, email, ContactId )
                  VALUES ( '$phoneNumber', '$email','$lastId')"
                );
  $mysqli->query(
                  "INSERT INTO address ( StreetName, StreetNumber, Bloc, Scale, Apartament, ContactId )
                  VALUES ( '$streetName', '$streetNumber', '$bloc', '$scale', '$apartament', '$lastId')"
                );

	$_SESSION['MessageA'] = "The person has been added in our database!";

  if (!$mysqli->commit()) {     
    $mysqli->rollback(); 
  } 

  $mysqli -> close();
  
}else{
	echo "Please fill in the form!";
}

 ?>
