<?php
session_start();
if (isset($_POST["submit"]))
{
	if ($_POST["name"] != "" && $_POST["path"] != "" && $_POST["quantity"] != "")
	{
		$item["name"] = $_POST["name"];
    $item["path"] = $_POST["path"];
		$item["price"] = $_POST["price"];
		$item["category"] = explode(" ", $_POST["category"]);
		$item["description"] = $_POST["description"];
    $item["quantity"] = $_POST["quantity"];
		if (!file_exists("./private"))
			mkdir("./private");
		if (file_exists("./private/item"))
		{
			$tab = unserialize(file_get_contents("./private/item"));
			foreach ($tab as $val)
			{
				if ($item["name"] === $val["name"])
				{
					header("Location: error.php");
					exit();
				}
			}
		}
		$tab[] = $item;
		file_put_contents("./private/item", serialize($tab));
		header("Location: additem.php");
		exit();
	}
	header("Location: error.php");
	exit();
}
include("header.php");
?>
<div class="form">
<!--	<h2 class="form-header">New Item</h2> -->
	<form id="newitem" class="form-container" action="additem.php" method="POST">
		<p><span style="color: white">Item name:</span>
			<input type="text" placeholder="Name" name="name" value=""></p>
		<p><span style="color: white">Item categories:</span>
			<input type="text" placeholder="categories" name="category" value=""></p>
    <p><span style="color: white">Path to image file:</span>
			<input type="text" placeholder="picture/path/to/file" name="path" value=""></p>
    <p><span style="color: white">Quantity:</span>
			<input type="number" min="1" max="42" placeholder="quantity in stock" name="quantity" value=""></p>
		<p><span style="color: white">Price in dollars:</span><input type="number" name="price" placeholder="42"></p>
    <p><span style="color: white">Description:</span>
			<textarea cols="55" rows="5" name="description" placeholder="Enter a description here..."></textarea></p>
    <p><input type="submit" name="submit" value="Create"></p>
	</form>
</div>
<?php
include("del_item.php");
include("footer.php"); ?>
