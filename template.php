<?php
$servername = "localhost";
$username = "pizza";
$password = "pizza";
$dbName = "pizza";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<html>
<head>
<title>Pizza Shop Ordering - <?=$title?></title>
<link rel="stylesheet" type="text/css" href="pizzaStyle.css">
</Head>

<body>
    <div>
	<nav>
		<ul>
			<li><a href =".">Home</a></li>
			<li><a href ="insert.php">Insert</a></li>
		</ul>
	</nav>
    </div>