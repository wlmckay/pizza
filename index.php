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
<script>
  let sortDirection = [true, true]; // true = ascending

  function sortTable(columnIndex) {
    const table = document.getElementById("results");
    const rows = Array.from(table.rows).slice(1);
    const ascending = sortDirection[columnIndex];

    rows.sort((a, b) => {
      const valA = a.cells[columnIndex].innerText;
      const valB = b.cells[columnIndex].innerText;
      return ascending ? valA.localeCompare(valB, undefined, {numeric: true}) : valB.localeCompare(valA, undefined, {numeric: true});
    });

    rows.forEach(row => table.tBodies[0].appendChild(row));
    sortDirection[columnIndex] = !ascending;

    // Update arrow indicators
    const headers = table.querySelectorAll("th");
    headers.forEach((th, i) => {
      th.classList.remove("asc", "desc");
      if (i === columnIndex) {
        th.classList.add(ascending ? "asc" : "desc");
      }
    });
  }

</script>
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
	<form method="POST" action="index.php" id=searchForm name=searchForm>
	<table>
		<tr>
			<td><input type=textbox size=30 id=searchText name=searchText value="<?=$searchText?>"></td>
			<td><select id=fieldName name=fieldName>
				<option <?=($fieldName == "company") ? "SELECTED" : ""?> value=company>Company</option>
				<option <?=($fieldName == "pizzaName") ? "SELECTED" : ""?> value=pizzaName>Pizza Name</option>
				<option <?=($fieldName == "type") ? "SELECTED" : ""?> value=type>Type of Pizza</option>
				<option <?=($fieldName == "size") ? "SELECTED" : ""?> value=size>Size of Pizza</option>
				<option <?=($fieldName == "price") ? "SELECTED" : ""?> value=price>Price</option>
			</select>
			</td>
			<td><input type=submit value="Search"></td>
		</tr>
	</table>
	</form>
<?php
$sql = "SELECT id, company, pizzaName, `type`, `size`, price FROM pizzadata ";
if (!empty($fieldName)) {
	$sql .= "WHERE " . $fieldName;
	
	if ($fieldName == "price") {
		$sql .= " <= " . (float) $searchText . " ";
	} else {
		$sql .= " LIKE '%" . $searchText . "%' ";
	}
}
$sql .= "ORDER BY size, pizzaName";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
?><table cellspacing=0 cellpadding=5 id="results">
<tr><th>ID</th>
<th onclick="sortTable(1)">Company</th>
<th onclick="sortTable(2)">Pizza Name</th>
<th onclick="sortTable(3)">Type of Pizza</th>
<th onclick="sortTable(4)">Size of Pizza</th>
<th onclick="sortTable(5)" style="width:75px;">Price</th></tr><?php	
	
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["id"]. "</td><td>" . 
		$row["company"]. "</td><td>" . 
		$row["pizzaName"]. "</td><td>" . 
		$row["type"]. "</td><td>" . 
		$row["size"]. "</td><td style=\"text-align:right;\">&pound;" . 
		number_format($row["price"], 2) . "</td></tr>";
  }
?></table><?php
} else {
  echo "0 results";
}
$conn->close();
?>
</body>
</html>
