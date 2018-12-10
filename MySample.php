<?php
$results ='';
?>
<!-- Build the HTML page with values from the call response -->
<html>
<head>
<title>eBay Search products <?php echo $query; ?></title>

<link rel="stylesheet" href="css/bootstrap.min.css" />
<style>
body {
    background-color: #dfffef;
}
</style>
</head>
<body >

<br/><br/><br/><br/>

<form method="post" action="MySample.php">

		
<div class="container">
		<div class="row">
			<div class="col-md-12">
				<input class="form-control" name="search" id="origin" placeholder="Starting product you want search for" required/><br/><br/>
			</div>
			
			
			<div class="col-md-12">
				<button class="form-control" name="submit" > products available</button><br/><br/>
			</div>
			
		</div>
	</div>
</form>


		
<!--add images here-->
<center>
		<h1 style="color: green;">Have a nice shopping !</h1><br/><br/>
		<button style="color: green" onclick="myFunction2()">back to home page</button>
	</center>
	
	<script>
function myFunction2() {
    location.replace("index.html")
}
</script>
</body>
</html>

<?php

function constructPostCallAndGetResponse($endpoint, $query) {
	global $xmlrequest;

  // Create the XML request to be POSTed
  $xmlrequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
  $xmlrequest .= "<findItemsByKeywordsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
  $xmlrequest .= "<keywords>";
  //$xmlrequest .= $xmlfilter;
  $xmlrequest .= $query;
  $xmlrequest .= "</keywords>\n";
  $xmlrequest .= "<paginationInput>\n  <entriesPerPage>3</entriesPerPage>\n</paginationInput>\n";
  $xmlrequest .= "</findItemsByKeywordsRequest>";
   // Set up the HTTP headers
  $headers = array(
    'X-EBAY-SOA-OPERATION-NAME: findItemsByKeywords',
    'X-EBAY-SOA-SERVICE-VERSION: 1.3.0',
    'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
    'X-EBAY-SOA-GLOBAL-ID: EBAY-US',
    'X-EBAY-SOA-SECURITY-APPNAME: lamyanai-shoesonl-PRD-760bc87c7-0786ad17',
    'Content-Type: text/xml;charset=utf-8',
  );
   $session  = curl_init($endpoint);                       // create a curl session
  curl_setopt($session, CURLOPT_POST, true);              // POST request type
  curl_setopt($session, CURLOPT_HTTPHEADER, $headers);    // set headers using $headers array
  curl_setopt($session, CURLOPT_POSTFIELDS, $xmlrequest); // set the body of the POST
  curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    // return values as a string, not to std out
  $responsexml = curl_exec($session);                     // send the request
  curl_close($session);                                   // close the session
  return $responsexml;                                    // returns a string
}  // End of constructPostCallAndGetResponse function
?>
<?php
// define variables and set to empty values

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	////
	
	error_reporting(E_ALL);  // Turn on all errors, warnings, and notices for easier debugging

// API request variables
$endpoint = 'http://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
//$query = 'laptop';                  // Supply your own query keywords as needed
	
$query = $_POST["search"];
// Create a PHP array of the item filters you want to use in your request
$filterarray =
  array(
    array(
    'name' => 'MaxPrice',
    'value' => '25',
    'paramName' => 'Currency',
    'paramValue'  => 'USD'),
    array(
    'name' => 'FreeShippingOnly',
    'value' => 'true',
    'paramName' => '',
    'paramValue'  => ''),
    array(
    'name' => 'ListingType',
    'value' => array('AuctionWithBIN','FixedPrice'),
    'paramName' => '',
    'paramValue'  => ''),
  );
  // Generates an XML snippet from the array of item filters
function buildXMLFilter ($filterarray) {
  global $xmlfilter;
  // Iterate through each filter in the array
  foreach ($filterarray as $itemfilter) {
    $xmlfilter .= "<itemFilter>\n";
    // Iterate through each key in the filter
    foreach($itemfilter as $key => $value) {
      if(is_array($value)) {
        // If value is an array, iterate through each array value
        foreach($value as $arrayval) {
          $xmlfilter .= " <$key>$arrayval</$key>\n";
        }
      }
      else {
        if($value != "") {
          $xmlfilter .= " <$key>$value</$key>\n";
        }
      }
    }
    $xmlfilter .= "</itemFilter>\n";
  }
  return "$xmlfilter";
} // End of buildXMLFilter function

// Build the item filter XML code
buildXMLFilter($filterarray);
  
// Construct the findItemsByKeywords POST call
// Load the call and capture the response returned by the eBay API
// The constructCallAndGetResponse function is defined below
$resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query, $xmlfilter));
// Check to see if the call was successful, else print an error
if ($resp->ack == "Success") {
  $results = '';  // Initialize the $results variable

  // Parse the desired information from the response
  foreach($resp->searchResult->item as $item) {
    $pic   = $item->galleryURL;
    $link  = $item->viewItemURL;
    $title = $item->title;

    // Build the desired HTML code for each searchResult.item node and append it to $results
    $results .= "<tr><td><img src=\"$pic\"></td><td><a href=\"$link\">$title</a></td></tr>";
  }
}
else {  // If the response does not indicate 'Success,' print an error
  $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
  $results .= "AppID for the Production environment.</h3>";
}


	
	///
  $search = $_POST["search"];
  		///
		?> 
			
<table>
<tr>
  <td>
    <?php if($results===null){
		echo "no results found";
	}else{
		echo $results;
	}?>
  </td>
</tr>
</table><br/><br/>
 <?php
		
echo "<div style=\"text-align:center\">";
echo "<h2>you searched for:</h2>";
echo $search;
echo "</div>";
}

?>

<?php
$user = 'root';
   $pass = '';
   $db = 'testdb';
   
$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
   
   if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
   }

   echo "Connected successfully <br>";
$sql = "SELECT * FROM stock1";
$result = $conn->query($sql);
$sql = "UPDATE Counter SET visits = visits+1 WHERE id = 1";
    $conn->query($sql);

    $sql = "SELECT visits FROM Counter WHERE id = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $visits = $row["visits"];
        }
    } else {
        echo "no results";
    }


$conn->close();
?>