

<?php
include("loginserv.php"); // Include loginserv for checking username and password

$key = "password";
$enc = base64_encode ($key);
$dec = base64_decode ($enc);
echo 'Encrypted : '.$enc.'<br>';
echo 'Decrypted : '.$dec.'<br>';
?>
 
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login  </title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
 <link rel="stylesheet" href="css/style.css" />
 <link rel="stylesheet" a href="css\font-awesome.min.css">

</head>
<body>
<div class="modal-dialog text-center ">
 <div class="col-sm-8 main-section">
 <div class="modal-content">
  <div class="col-12 user-img">
 <img  src="s.png">
 </div>
<div class="login">

<form action="" method="post" style="text-align:center;">
<input type="text" placeholder="Username" id="user" name="user"><br/><br/>
<input type="password" placeholder="Password" id="pass" name="pass"><br/><br/>
<input type="submit" value="Login" name="submit">
<input type="submit" value="register/manage account" name="submit1"><br></br>

<!-- Error Message -->
<span style="color:yellow"><?php echo $error; ?> </span>
</div>
</body>
</html










































 