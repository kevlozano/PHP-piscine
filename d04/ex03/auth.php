<?php
function auth($login, $passwd) {
    $accounts = unserialize(file_get_contents('../private/passwd'));
    $flag = 0;
    $i = -1;
    foreach ($accounts as $key => $value) {
        $i++;
        if ($value['login'] == $_SESSION['login']) {
            $key = $i;
            $flag = 1;
        }
    }
    $hashed_pw = hash('whirlpool', $passwd);
    if ($flag === 1) {
        if ($accounts[$key]['passwd'] === $hashed_pw) {
            return TRUE;
        }
        else
            return FALSE;
    }
    else
        return FALSE;
}
?>