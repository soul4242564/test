<?php

$username = $_POST['username'];
$Password = $_POST['password'];
$conPassword = $_POST['conPassword'];
$email = $_POST['fName'];
$email = $_POST['lName'];
$email = $_POST['email'];
$email = $_POST['phoneNum'];

if (!empty($username) || !empty($password) || !empty($conpassword) || !empty($fName) || !empty($lName) || !empty($email) || !empty($phoneNum) ) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "userdata";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } 
    else {
     $SELECT = "SELECT email From user Where email = ? Limit 1";
     $INSERT = "INSERT Into user (username, password, conpassword, fName ,lName ,email ,phoneNum,) values(?, ?, ?, ?, ?, ?, ?)";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssii", $username, $password, $email);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } 
     else {
      echo "Someone already some one used this email";
     }
     $stmt->close();
     $conn->close();
    }
} 
else {
    echo "All field are required";
    die();
}
?>
