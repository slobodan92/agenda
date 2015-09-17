<?php
session_start();
$_SESSION['MessageU'] = "";
$id = $_GET['ContactId'];
$mysqli = new mysqli( "localhost", "root", "", "shqdb");

if (mysqli_connect_errno()) {     
  echo 'Connect failed: ' . mysqli_connect_error();     
  exit; 
}
$sql = "SELECT * FROM contact JOIN contactdetails ON contactdetails.ContactId='$id' JOIN address ON address.ContactId='$id'";
$query = $mysqli->query($sql);
$myArray = array();
foreach ($query as $key => $value) {
  $myArray[] = $value;
}
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

  $mysqli->autocommit(FALSE); 

  $mysqli->query(     
                  "UPDATE contact     
                  SET LastName ='$lname', FirstName = '$fname'
                  WHERE ContactId = '$id'" 
                );
  $mysqli->query(
                  "UPDATE contactdetails
                  SET PhoneNumber = '$phoneNumber', email = '$email'
                  WHERE ContactId = '$id'"
                );
  $mysqli->query(
                  "UPDATE address
                  SET StreetName = '$streetName', StreetNumber = '$streetNumber', Bloc = '$bloc', Scale = '$scale', Apartament = '$apartament'
                  WHERE ContactId = '$id'"
                );

  $_SESSION['MessageU'] = "The account has been updated!";
  header('Location: index.php');

  if (!$mysqli->commit()) {     
    $mysqli->rollback(); 
  } 

  $mysqli -> close();
}
?>
<!DOCTYPE html>
<html>
  <head>
   <title></title>
  </head>
  <body>
    <div style="margin-left: 35%">
      <form method="post">
        Last Name: <br><input type="text" name="lname" value="<?php echo $myArray[0]['LastName']; ?>">
        <br><br>
        First Name: <br><input type="text" name="fname" value="<?php echo $myArray[0]['FirstName']; ?>">
        <br><br>
        Phone Number: <br><input type="text" name="phonenumber" value="0<?php echo $myArray[0]['PhoneNumber']; ?>">
        <br><br>
        E-mail: <br><input type="text" name="email" value="<?php echo $myArray[0]['email']; ?>">
        <br><br>
        <u>Adress</u>: <br>
        Street Name: <br><input type="text" name="streetName" value="<?php echo $myArray[0]['StreetName']; ?>"><br>
        Street Number: <br><input type="number" name="streetNumber" value="<?php echo $myArray[0]['StreetNumber']; ?>"><br>
        Bloc: <br><input type="text" name="bloc" value="<?php echo $myArray[0]['Bloc']; ?>"><br>
        Scale: <br><input type="text" name="scale" value="<?php echo $myArray[0]['Scale']; ?>"><br>
        Apartament: <br><input type="number" name="apartament" value="<?php echo $myArray[0]['Apartament']; ?>"><br>
        <input type="submit" type="submit" value="UPDATE">
      </form>
      <a href="index.php"><button type="button">Back</button>
    </div>
  </body>
</html>