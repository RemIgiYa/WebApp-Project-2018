<?php 
 $user = 'root';
   $pass = '';
   $db = 'id8171017_testdb';
   
$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
   
   if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
   }

   echo "Connected successfully <br>";
 
   echo "STOCK MANAGEMENT";
$sql = "SELECT * FROM stock1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	// output data of each row
	echo "<table style='margin: 0 auto; color:black' cellpadding='40'  border='3' >\n <tr style='padding: 2px'>\n"."<th style='padding: 2px'>ID</th><th style='padding: 2px'>name</th><th style='padding: 2px'>price</th><th style='padding: 2px'>brand</th></tr>";
	while($row = $result->fetch_assoc()) {
		echo 
		"<tr><td>{$row["id"]} </td>".
		"<td> {$row["name"]}</td>". "<td> {$row["price"]}</td>". "<td> {$row["brand"]} </td></tr>" ;
	
	}
	    echo '</table>';  
	} else {
	echo "0 results";
	}
	
	
//	$namy=$_POST["name"];
	//insertstock
	if(isset($_POST['save2']))
	{
		$sql = "INSERT INTO stock1 (name, price, brand)
		VALUES ('".$_POST["name"]."','".$_POST["price"]."','".$_POST["brand"]."')";

		$result = mysqli_query($conn,$sql);
	}
	
	//updatstock
	if(isset($_POST['update2']))
	{
		$sql="UPDATE stock1 SET name='".$_POST["name3"]."', price='".$_POST["price3"]."',brand='".$_POST["brand3"]."' WHERE id='".$_POST["id5"]."'" or die ("this stuffed up");

		$result = mysqli_query($conn,$sql);
	}
	
	//deletstock
	if(isset($_POST['delete2']))
	{
		$sql="DELETE FROM stock1 WHERE id='".$_POST["id4"]."'" or die ("this stuffed up");

		$result = mysqli_query($conn,$sql);
	}
	
	if(isset($_POST['home'])){
	header("Location: index.html");
}
	$conn->close();

?>
 
 <html>
 <head>
  <title>STOCK</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<style>
		body{
			background-color:#dfffef;
		}
		</style>
 </head>
 <body>
 
<div class="modal-dialog text-center ">
 <div class="col-sm-8 main-section">
 <div class="modal-content">
 
	<form action="productstock.php" method="post"> 
	<form action="" method="post" style="text-align:center;">
	
<input type="text" placeholder="add product name" id="first" name="name"><br/>
<input type="text" placeholder="add product brand" id="first" name="brand"><br/>
<input type="text" placeholder="add product price" id="first" name="price"><br/>

     
	<button type="submit" name="save2">Add New product</button><br/><br/>
	
	
	
	
	<form action="productstock.php" method="post"> 
	<input type="text" placeholder="add product id" id="first" name="id5"><br/>
	<input type="text" placeholder="add new product name" id="first" name="name3"><br/>
	<input type="text" placeholder="add new product price" id="first" name="price3"><br/>
	<input type="text" placeholder="add new product brand" id="first" name="brand3"><br/>
	

	<button type="submit" name="update2">update products details </button><br/><br/>
	
	
	<form action="productstock.php" method="post"> 
	<input type="text" placeholder="add product name" id="first" name="id4"><br/>


	<button type="submit" name="delete2">delete products</button><br/><br/>
	<br/>
	<button type="submit" name="home">back to home page</button><br/><br/>
	
 </body>
</html>