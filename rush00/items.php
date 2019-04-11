<div class="items">
<?php
if (!file_exists("./private/item"))
{
	echo "<h2>Error: No Item Data!</h2>";
	exit();
}
else
{
	$items = unserialize(file_get_contents("./private/item"));
	$categories = array();
			foreach ($items as $item)
			{
				if(isset($item['category']))
				{
					foreach ($item['category'] as $category)
					{
						if(!in_array($category, $categories))
							$categories[] = $category;
					}
				}
				?>
				<div class="item">
					<h2 class="item-header"><?PHP echo $item["name"]; ?></h2>
					<form class="item-container" action="addtocart.php" method="POST">
						<img src="
						<?php if (file_exists($item["path"]))
								echo $item["path"];
							else
								echo "<h2> RIP </h2>";
						 ?>
						 ">
						 <p class='item-description'><?PHP echo $item["description"];echo "<br><br><span class='price'> $"; echo $item['price'];  echo '</span>'?></p>
						 
						 <input type="hidden" name="item" value="<?php echo $item["name"]; ?>">
				    <p><input type="submit" name="submit" value="Add to cart"></p>
					</form>
				</div>
				<?php
			}
}
?>
</div>
<div class="cat-menu">
<?php
foreach ($categories as $category)
{
	echo "<div><a href='category.php?category=$category'>".$category."\t</a></div><p></p><br/>";
}
 ?>
</div>
