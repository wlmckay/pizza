<?php
$title = "Insert New";
include("template.php");

$company = "";  if (isset($_POST["company"])) $company = $_POST["company"];
$pizzaName = "";  if (isset($_POST["pizzaName"])) $pizzaName = $_POST["pizzaName"];
$pizzaType = "";  if (isset($_POST["pizzaType"])) $pizzaType = $_POST["pizzaType"];
$pizzaSize = "";  if (isset($_POST["pizzaSize"])) $pizzaSize = $_POST["pizzaSize"];
$price = "";  if (isset($_POST["price"])) $price = $_POST["price"];

$valid = true;
if (empty($company) || empty($pizzaName) || empty($pizzaType) || empty($pizzaSize) || empty($price)) $valid = false;

?>
<body>
  <?php if ($valid) {
    $company = $conn->real_escape_string($company);
    $pizzaName = $conn->real_escape_string($pizzaName);
    $pizzaType = $conn->real_escape_string($pizzaType);
    $pizzaSize = $conn->real_escape_string($pizzaSize);

    $sql = "INSERT INTO `pizzadata` (`Company`, `PizzaName`, `Type`, `Size`, `Price`) VALUES ('" . 
      $company . "', '" . $pizzaName . "', '" . $pizzaType . "', '" . $pizzaSize . "', '" . $price . "');";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

  } else {?>
  <form method="POST" action="insert.php">
  <table border=1 cellspacing=0 cellpadding=5>
    <tr><th>Company</th><td><input type=textbox size=30 id="company" name="company" value="<?=$company?>"></td></tr>
    <tr><th>Pizza Name</th><td><input type=textbox size=40 id="pizzaName" name="pizzaName" value="<?=$pizzaName?>"></td></tr>
    <tr><th>Type of Pizza</th><td><input type=textbox size=20 id="pizzaType" name="pizzaType" value="<?=$pizzaType?>"></td></tr>
    <tr><th>Size of Pizza</th><td><input type=textbox size=20 id="pizzaSize" name="pizzaSize" value="<?=$pizzaSize?>"></td></tr>
    <tr><th>Price</th><td><input type=number size=10 id="price" name="price" value="<?=$price?>"></td></tr>
    <tr><td colspan=2><input type=submit name="Insert"></td></tr>
  </table>
  </form>
  <?php }?>
  </body>
</html>
