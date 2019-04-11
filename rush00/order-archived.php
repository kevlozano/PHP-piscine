<?php
if (session_id() == "")
	session_start();
include("header.php");
?>
<div class="content">
	<div class="login-form"></div>
	<h2 class="login-header">Order submited!</h2>
    <?php
    echo "<div class='order'><p><p>YOUR INVOICE (please pay):</p>";
    $total_final = 0;
    $size = count($_SESSION['order']);
    for ($i = 0; $i < $size-1; $i++) {
        echo "Product: ".($_SESSION['order'][$i]['name'])."<br>";
        echo "Price: $".($_SESSION['order'][$i]['price'])."<br>";
        echo "Quantity: ".($_SESSION['order'][$i]['quantity'])."<br>";
        $total_final += ($_SESSION['order'][$i]['price']);
    }
    echo "<br>"."Total: $".$total_final."<br>";
    echo "</div>";
    ?>
</div>
<?php include("footer.php"); ?>
