<?php

function download_image1($image_url, $image_file){
    $fp = fopen ($image_file, 'w+');              // open file handle

    $ch = curl_init($image_url);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($ch);

    curl_close($ch);                              // closing curl handle
    fclose($fp);                                  // closing file handle
}

//iniates connection with given website
$c = curl_init($argv[1]);
if (!file_get_contents($argv[1]))
	exit();
else
	$str = file_get_contents($argv[1]);

//gets all the <img> tags from str and puts them in match
preg_match_all('/<img.{0,}src=["|\/|h][[:graph:]]+/', $str, $match);

//prepare to loop
$i = count($match);
$j = 0;

//array to store img urls
$urls = [];
for ($j; $j <= $i; $j++) {
	//grab the imgs url weather theyre complete or not (strlen - 11 bc of initial img tag offset)
	if ($match[0][$j][10] == '/') {
		$urls[$j] = $argv[1] . substr($match[0][$j], 10, (strlen($match[0][$j])-11));
	}
	else {
		$urls[$j] = substr($match[0][$j], 10, (strlen($match[0][$j])-11));
	}
}

//directory name
$easy_url = substr($argv[1], 7, strlen($argv[1])-7);
if (file_exists($easy_url) == FALSE)
	mkdir($easy_url, 0777);
$k = 0;
$size_urls = count($urls);
for ($k = 0; $k < $size_urls; $k++) {
	$img_name = basename($urls[$k]);
	download_image1($urls[$k], $img_name);
	rename($img_name, $easy_url."/".$img_name);
}
 
?>