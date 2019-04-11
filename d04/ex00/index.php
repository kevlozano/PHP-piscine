<?php
session_start();
if ($_GET['submit'] === 'OK') {
    $_SESSION['login'] = $_GET['login'];
    $_SESSION['passwd'] = $_GET['passwd'];
}
?>
<!doctype html>
<html>
<head>
<title>Ex00 / D04</title>
</head>
<body>
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="login" value="<?php if($_SESSION['login']){ echo $_SESSION['login'];} ?>">
        <br>
        <input type="text" name="passwd" value="<?php if($_SESSION['passwd']){ echo $_SESSION['passwd'];} ?>">
        <br>
        <input type="submit" name="submit" value="OK">
    </form>
</body>
</html>
