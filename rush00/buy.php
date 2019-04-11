<?php
session_start();
print_r($_SESSION);
if ($_SESSION['logged_on_user'] == "") {
	header("Location: error.php");
}
else {
	if (isset($_POST["buy"]))
	{
		if ($_SESSION["cart"] && file_exists("./private/user"))
		{
			$user = unserialize(file_get_contents("./private/user"));
			for ($i = 0; $i < count($user); $i++)
				if ($_SESSION["logged_on_user"] === $user[$i]["email"])
				{

					$order = $_SESSION['cart'];
					$size = count($_SESSION['cart']) - 1;
					$i = 0;
					$order_toinput = array();
					while($i < $size) {
						
						$order_toinput[$i]['name'] = $order[$i]['name'];
						$order_toinput[$i]['price'] = $order[$i]['price'];
						$order_toinput[$i]['quantity'] = $order[$i]['quantity'];
						$i++;
					}
					$order_toinput[$i]['total'] = $order['subtotal'];
					if (file_exists('private/orders'))
					{
						echo "1<br>";
						$all_orders = unserialize(file_get_contents('./private/orders'));
						$all_orders[] = $order_toinput;
						file_put_contents('./private/orders', serialize($all_orders));
					}
					else {
						mkdir('private');
						file_put_contents('private/orders', serialize($order_toinput));
					}
					$user[$i]["orders"][] = $order_toinput;
					$_SESSION['order'] = $order_toinput;
					unset($_SESSION["cart"]);
					file_put_contents("/private/user", serialize($user));
					header("Location: order-archived.php");
					exit();
				}
		}
	}
	if (isset($_POST["clear"]))
	{
		unset($_SESSION["cart"]);
		header("Location: index.php");
		exit();
	}
}
exit();
?>

