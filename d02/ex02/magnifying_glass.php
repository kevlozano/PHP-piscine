<?php
$str = file_get_contents ($argv[1]);
$str = preg_replace_callback('/(?<=(title="))(.|\n)*?(?=("))/', 'upper', $str);
$str = preg_replace_callback('/<a.*?>(.*?)</', 's_upper', $str);


function upper($match) {
    return strtoupper($match[0]);
}
function s_upper($match) {
    return (str_replace($match[1], strtoupper($match[1]), $match[0]));
}
echo $str;
?>