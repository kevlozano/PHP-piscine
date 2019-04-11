<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title class="title"> BUY BUY BUY </title>
		<base href="index.php">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/?family=Fjalla+One|Lobster|Exo+2|Pacifico">
	</head>
	<body>
		<header class="flex-header">
		<div class="container">
			<div class="navigation">
				<div>
					<div class="navigation-bar">
						<div class="nav-bar-left">
							<a href="index.php">
								<img class="logo" class="rotate-vert-center" src="img/logo-new.svg">
							</a>
						</div>
					<div class="nav-center">
<?php
if (isset($_SESSION["admin"])) {
if ($_SESSION["admin"])
	echo '<a class="nav-item" href="additem.php">Add Items</a>';
}
?>
							<!-- menu pages
						<table class="nav-list">
							<tr><a class="nav-item" href="Item_one.php">INSERT BODY TEXT PHP PAGE ONE</a></tr>
							<br/>
							<tr><a class="nav-item" href="Item_two.php">INSERT BODY TEXT PHP PAGE TWO</a></tr>
							<br/>
							<tr><a class="nav-item" href="Item_three.php">INSERT BODY TEXT PHP PAGE THREE</a></tr>
						</table>
							-->
					</div>
					<div class="nav-right">
						<!-- login and user boxes go here
							 need to add login and logout php files in this part of the php
													 -->
						<ul class="login-mod-base">
						<?php
							if (isset($_SESSION['logged_on_user']))
							{
								echo '<li class="login-mod-right"><a class="nav-item-login" href="logout.php">' .$_SESSION['logged_on_user'] . '  LOGOUT</a></li>';
								if ($_SESSION["admin"])
								{
									echo '<li class="login-mod-right"><a class="nav-item-login" href="admin_tools.php">' . ' tools</a></li>';
								}
							}
							else
							{
								echo '<li class="login-mod-right"><a class="nav-item-login" href="login.php">LOGIN</a></li>';
								echo '<li class="login-mod-right"><a class="nav-item-login" href="register.php">REGISTER</a></li>';
							}
						?>
					</div>
					<!-- cart icon and link -->
					<div class="cart">
						<a class="cart-img" href="basket.php"><img class="cart-img" src="http://www.thegunsworld.com/images/empty-cart-light.png"></a>
					</div>
				</div>
		</div>
				
		</header>
