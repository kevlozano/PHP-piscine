<?php
session_start();
//checks
if (!$_POST['login'] === "" || $_POST['passwd'] === "" || $_POST['submit'] !== "OK")
    {
        echo "ERROR\n";
        return ;
    }
if (($_POST['submit'] === 'OK')) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['passwd'] = $_POST['passwd'];
}
 
// put content on file
function store_info($login, $passwd, $new) {
    $hashed_pwd = hash('whirlpool', $passwd);
    $new_account['login'] = $login;
    $new_account['passwd'] = $hashed_pwd;
    if ($new == 1) {
        $accounts = unserialize(file_get_contents('../private/passwd'));
        $accounts[] = $new_account;
        file_put_contents('../private/passwd', serialize($accounts));
    }
    else {
        $accounts[] = $new_account;
        file_put_contents('../private/passwd', serialize($accounts));
    }
}

//prepare info
if (!file_exists('../private/passwd')) {
    mkdir('../private');
    store_info($_SESSION['login'], $_SESSION['passwd'], 0);
}
else {
    $accounts = file_get_contents('../private/passwd');
    $accounts = unserialize($accounts);
    $flag = 0;
    $i = -1;
    foreach ($accounts as $key => $value) {
        $i++;
        if ($value['login'] == $_SESSION['login']) {
            $key = $i;
            $flag = 1;
        }
    }
    print_r($accounts);
    if ($flag == 1) {
        echo $key."<br>";
        echo "ERROR\n";
    }
    else {
        store_info($_SESSION['login'], $_SESSION['passwd'], 1);
        echo "OK<br>";
    }
} 
?>