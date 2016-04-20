<?php
/**
 * create a dynamic image from url parameters
 *
 * example usage: bar-generator.php?width=400&height=30&text=Exp&progress=75
 **/

// settings
$width    = (empty($_GET['width'])    ? 320       : $_GET['width']);
$height   = (empty($_GET['height'])   ? 32        : $_GET['height']);
$text     = (empty($_GET['text'])     ? 'current' : $_GET['text']);
$progress = (empty($_GET['progress']) ? 0         : $_GET['progress']);

$image = imagecreatetruecolor($width, $height); 

$backgroundcolor = imagecolorallocate($image, 255, 255, 255);
$bordercolor     = imagecolorallocate($image, 230,  67,  97);
$barcolor        = imagecolorallocate($image, 239, 135, 154);
$textcolor       = imagecolorallocate($image, 230,  67,  97);

// calculate the progress
if ($_GET['progress'] > 100 || is_numeric($_GET['progress']) != true) {
    return false;
}
$progressabsolute = ($width * $progress) / 100;

// background 
imagefill($image, 0, 0, $bordercolor);
// border
imagefilledrectangle($image, 2, 2, $width - 3, $height - 3, $backgroundcolor);
// bar
imagefilledrectangle($image, 2, 2, $progressabsolute, $height - 3, $barcolor);
// text
imagestring($image, 3, 16, 9,  $text, $textcolor);


// set header
header('Content-type: image/png');

imagepng($image); 
imagedestroy($image); 
?>
