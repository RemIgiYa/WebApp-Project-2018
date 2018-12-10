<?php 


   $user = 'root';
   $pass = '';
   $db = 'id8171017_testdb';
   
   $conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
   
   if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
   }

   echo "Connected successfully <br> <br>";
   
   

	
	
	
	
	
	
	//insertuser
	if(isset($_POST['save']))
	{
		$password= $_POST["pass"];
$enc = base64_encode ($password);


		$sql = "INSERT INTO userpass ( user, pass)
		VALUES ('".$_POST["user"]."','".$enc."')";

		$result = mysqli_query($conn,$sql);
	}
	
	//updateuser
	if(isset($_POST['update']))
	{
		$password2= $_POST["pass2"];
		$enc2 = base64_encode ($password2);
		$sql="UPDATE userpass SET user='".$_POST["user2"]."', pass='".$enc2."' WHERE id='".$_POST["id2"]."'" or die ("this stuffed up");

		$result = mysqli_query($conn,$sql);
	}
	
	//deleteuser
	if(isset($_POST['delete']))
	{
		$sql="DELETE FROM userpass WHERE id='".$_POST["id3"]."'" or die ("this stuffed up");

		$result = mysqli_query($conn,$sql);
	}
	
	
	if(isset($_POST['login'])){
	header("Location: login.php");
	}
	if(isset($_POST['home'])){
	header("Location: index.html");
}
	$conn->close();

	
?>
 
 <html>
 <head>
  <title>registration</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
 <link rel="stylesheet" href="css/style.css" />
 </head>
 <body>
	
	<div class="modal-dialog text-center ">
 <div class="col-sm-8 main-section">
 <div class="modal-content">
	<form action="registration.php" method="post"> 
	<form action="" method="post" style="text-align:center;">
<input type="text" placeholder="Username" id="user" name="user"><br/><br/>
<input type="password" placeholder="Password" id="pass" name="pass"><br/><br/>



	
	<button type="submit" name="save">Add New Account</button><br/>
	
	<br>
	
	<form action="registration.php" method="post"> 
	
	
	<input type="text" placeholder="Enter your ID" id="first" name="id2"><br/><br/>
<form action="" method="post" style="text-align:center;">
<input type="text" placeholder="Enter new username" id="user2" name="user2"><br/><br/>
<input type="password" placeholder="Enter new password" id="pass2" name="pass2"><br/><br/>


	

	<button type="submit" name="update">update your account</button><br/><br/>
	
	
	<form action="registration.php" method="post"> 
	
<input type="text" placeholder="Enter your ID" id="first" name="id3"><br/><br/>

	<button type="submit" name="delete">delete</button><br/><br/>

	<button type="submit" name="login">Login</button>
	<button type="submit" name="home">back to home page</button>
	
	

 </body>
</html>