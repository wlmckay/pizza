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

$searchText = "";  if (isset($_POST["searchText"])) $searchText = $_POST["searchText"]; 
$fieldName = "";  if (isset($_POST["fieldName"])) $fieldName = $_POST["fieldName"]; 
?>
<html>
<head>
<title>home</title>
<link rel="stylesheet" type="text/css" href="pizzaStyle.css">
</Head>

<body>
	<nav>
		<ul>
			<li><a href =".">Home</a></li>
			<li><a href ="insert.php">Insert</a></li>
		</ul>
	</nav>
	<form method="POST" action="index.php">
	<table>
		<tr>
			<td><input type=textbox size=30 id=searchText name=searchText value="<?=$searchText?>"></td>
			<td><select id=fieldName name=fieldName>
				<option value=company>Company</option>
				<option value=pizzaName>Pizza Name</option>
				<option value=type>Type of Pizza</option>
				<option value=size>Size of Pizza</option>
				<option value=price>Price</option>
			</select>
			</td>
			<td><input type=submit value="Search"></td>
		</tr>
	</table>
	</form>
<?php
$sql = "SELECT id, company, pizzaName, `type`, `size`, price FROM pizzadata ";
if (!empty($fieldName)) $sql .= "WHERE " . $fieldName . " LIKE '%" . $searchText . "%' ";
$sql .= "ORDER BY size, pizzaName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?><table border=1 cellspacing=0 cellpadding=5>
<tr><th>ID</th><th>Company</th><th>Pizza Name</th><th>Type of Pizza</th><th>Size of Pizza</th><th>Price</th></tr><?php	
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["company"]. "</td><td>" . $row["pizzaName"]. "</td><td>" . $row["type"]. "</td><td>" . $row["size"]. "</td><td>" . $row["price"]. "</td></tr>";
  }
?></table><?php
} else {
  echo "0 results";
}
$conn->close();
?>
</body>
</html>
