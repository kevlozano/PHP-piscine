<?php
session_start();
if (!$_POST['login'] === "" || $_POST['oldpw'] === "" || $_POST['newpw'] === "" || $_POST['submit'] !== "OK")
    {
        echo "ERROR<br>";
        return ;
    }
if (($_POST['submit']) === 'OK') {
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['oldpw'] = $_POST['oldpw'];
    $_SESSION['newpw'] = $_POST['newpw'];
}
else
    echo "ERROR<br>";
//check if login exists
$accounts = unserialize(file_get_contents('../private/passwd'));
$hashed_pw = hash('whirlpool', $_SESSION['oldpw']);
$flag = 0;
$i = -1;
foreach ($accounts as $key => $value) {
    $i++;
    if ($value['login'] == $_SESSION['login']) {
        $key = $i;
        $flag = 1;
    }
}

if ($flag === 1) {
    if ($accounts[$key]['passwd'] === $hashed_pw) {
        $accounts[$key]['passwd'] = hash('whirlpool', $_SESSION['newpw']);
        file_put_contents('../private/passwd', serialize($accounts));
        echo "OK\n";
    }
    else 
        "ERROR<br>";   
}
else
    echo "ERROR<br>"
?>