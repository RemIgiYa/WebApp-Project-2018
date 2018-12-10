<?php
$error=''; //Variable to Store error message;
if(isset($_POST['submit'])){
 if(empty($_POST['user']) || empty($_POST['pass'])){
 $error = "Username or Password is empty";
 }
 else
 {
 //Define $user and $pass
 $user=$_POST['user'];
 $pass=$_POST['pass'];
 
 
$enc = base64_encode ($pass);
 //Establishing Connection with server by passing server_name, user_id and pass as a patameter
 $conn = mysqli_connect("localhost", "root", "");
 //Selecting Database
 $db = mysqli_select_db($conn, "id8171017_testdb");
 //sql query to fetch information of registerd user and finds user match.
 $query = mysqli_query($conn, "SELECT * FROM userpass WHERE pass='$enc' AND user='$user'");
 // ;
 if(mysqli_num_rows($query) == 1){
 header("Location: productstock.php"); // Redirecting to other page
 }
 else
 {
 $error = "invalid username or password ";
 }
 mysqli_close($conn); // Closing connection
 }
}
if(isset($_POST['submit1'])){
	header("Location: registration.php");
}


?>