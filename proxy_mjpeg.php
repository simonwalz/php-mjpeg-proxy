<?php

// config:
$mjpeg_url = "http://mywebcam:8080/?action=stream";

// preparing http options:
$opts = array(
	'http'=>array(
		'method'=>"GET",
		'header'=>"Accept-language: en\r\n" .
		"Cookie: foo=bar\r\n"
	  )
);
$context = stream_context_create($opts);

// set no time limit and disable compression:
set_time_limit(0);
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);

/* Sends an http request
 *    with additional headers shown above */
$fp = fopen($mjpeg_url, 'r', false, $context);
if ($fp) {
	// send mjpeg header:
	header("Cache-Control: no-cache");
	header("Cache-Control: private");
	header("Pragma: no-cache");
	header("Content-type: multipart/x-mixed-replace; boundary=boundarydonotcross");

	// pass data
	fpassthru($fp);
	fclose($fp);
} else {
	// error: webcam probably offline
	// send alternative picture:
	$d = file_get_contents("webcam_offline.jpg");

	Header("Content-Type: image/jpeg");
	Header("Content-Length: ".strlen($d));
	header("Cache-Control: no-cache");
	header("Cache-Control: private");
	header("Pragma: no-cache");

	echo $d;
}

