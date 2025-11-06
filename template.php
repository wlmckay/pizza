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