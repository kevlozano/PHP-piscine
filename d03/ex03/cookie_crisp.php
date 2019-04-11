<?php
if ($_GET['action'] == "set") {
    $cookie_name = 'php_cookie_test';
    $cookie_value = 'absolutely nothing';
    setcookie($cookie_name, $cookie_value);
}
else if ($_GET['action'] == 'get') {
    echo $_GET['name']."<br/>";
}
else if ($_GET['action'] == 'del') {
    if (isset($_COOKIE[$_GET['name']])) {
        unset($_COOKIE[$_GET['name']]);
        setcookie($_GET['name'], null, time() - 60);
    }
}
?>