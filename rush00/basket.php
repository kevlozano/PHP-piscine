<?php
session_start();
include("header.php");
?>
<main class="content">
<form action="buy.php" method="post" id="cart">
<table>
<h1 class="page-title">Cart</h1>
<tr>
	<th scope="col">Product</th>
	<th scope="col">Quantity</th>
	<th scope="col">Price</th>
</tr>
<?php
if (!file_exists("./private/item"))
{
	echo "<h2>Error: No Item Data!</h2>";
	exit();
}
else
{
	$sub = 0;
	for ($i = 0; $i < count($_SESSION["cart"]); $i++)
	{
		$item = $_SESSION["cart"][$i];
		$sub += $item["price"];
		?>
<tr>
	<td><?PHP echo $item["name"]; ?></td>
	<td><input type="text" value="1" class="qty" /></td>
	<td><?PHP echo $item["price"]; ?> USD</td>
</tr>
<?php
	}
	$_SESSION["cart"]["subtotal"] = $sub;
}
include("footer.php");
?>
<tr><th>Subtotal: <?php echo $sub." USD"; ?></th><?php  ?></tr>
</table>

<div>
		<input type="submit" value="Buy" id="buy" name="buy" />
		<input type="submit" value="Clear" name="clear" />
</div>
</form>

</main>