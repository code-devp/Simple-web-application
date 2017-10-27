<?php
	$randomString = md5(microtime());
	$resultString = substr($randomString,0,6);
	
	$captchaCreated = imagecreatefromjpeg("capture.jpg");
	
	$crossColor = imagecolorallocate($captchaCreated, 244, 66, 176);
	$dataColor = imagecolorallocate($captchaCreated, 119, 55, 0);
	
	imageline($captchaCreated, 0, 100, 50, 0, $crossColor);
	imageline($captchaCreated, 0, 12, 190, 70, $crossColor);
	imagestring($captchaCreated, 5, 20, 10, $resultString, $dataColor);
	
	setcookie('captchaText', $resultString, time()+3600);
	header("Content-type: image/png");
	imagejpeg($captchaCreated);
?>