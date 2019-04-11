<?php
	session_start();
	if (!$_SESSION["admin"])
	{
		header("Location: index.php");
		exit();
	}
	include("header.php");
?>
<div class="content">
<h2> Admin Panel </h2>
<?php
	if(file_exists("./private/user"))
	{
		$tab = unserialize(file_get_contents("./private/user"));

		foreach ($tab as $user)
		{
			echo "<form class='admin-panel content' action='moduser.php' method='post'>";
			echo "<p><input type='number' name=".$user["id"]." value=".$user["id"]." readonly>";
			echo "<input type='email' name='email".$user["id"]."' value=".$user["email"].">";
			echo "<input type='text' name='fname".$user["id"]."' value=".$user["fname"].">";
			echo "<input type='text' name='lname".$user["id"]."' value=".$user["lname"].">";
			echo "<input type='checkbox' name='admin".$user["id"]."' value='admin'";
			if ($user["admin"])
				echo " checked";
			echo "><input type='checkbox' name='banned".$user["id"]."' value='banned'";
			if ($user["banned"])
				echo " checked";
			echo "><input type='submit' name='submit".$user["id"]."' value='apply'>";
			echo "<input type='submit' name='delete".$user["id"]."' value='delete'></form>";
		}
	}
	echo "<div class='orders_show'>";
	/* order forms should be put here" */
	echo "<h1 style='color: white;' id=orders-header>User orders</h1>";
	$orders_ = unserialize(file_get_contents('./private/orders'));
	for ($i = 0; $i < count($orders_); $i++) {
		echo "<p style='color: red;'>Order no: ".$i."</p>";
		$total_no = count($orders_[$i])-1;
		for ($j = 0; $j < $total_no; $j++) {
			echo "<p style='color: white;'> Item: ".$orders_[$i][$j]['name']."</h5><br>";
			echo "<p style='color: white;'> Price: $".$orders_[$i][$j]['price']."</h5><br>";
			echo "<p style='color: white;'> Quantity: ".$orders_[$i][$j]['quantity']."</h5><br>";
			echo "<br>";
			}
		echo "<p style='color: blue;'> TOTAL: $".$orders_[$i][$total_no]['total']."</h5><br>";
		echo "<br>";
		}
	echo "<div class='items_show' style='float: rigth;'>";
	$items_ = unserialize(file_get_contents('./private/item'));
	echo "</div>";
	?>
	<form action='delete-orders.php'>
	<input type='submit' value='Delete orders'>
	</form>
</div>
<?php
	include("footer.php");
?>