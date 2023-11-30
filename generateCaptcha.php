<?php
session_start();

// Generate a random captcha code
$captchaCode = generateRandomCode();

// Store the captcha code in the session for verification
$_SESSION['captcha_code'] = $captchaCode;

// Create a blank image with a white background
$image = imagecreatetruecolor(100, 40);
$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefilledrectangle($image, 0, 0, 100, 40, $bgColor);

// Add random lines to make it more challenging for bots
for ($i = 0; $i < 5; $i++) {
    $lineColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imageline($image, rand(0, 100), rand(0, 40), rand(0, 100), rand(0, 40), $lineColor);
}

// Add the captcha text to the image
$textColor = imagecolorallocate($image, 0, 0, 0);
imagestring($image, 5, 20, 10, $captchaCode, $textColor);

// Set the content type to PNG
header('Content-type: image/png');

// Output the image
imagepng($image);

// Free up memory
imagedestroy($image);

function generateRandomCode() {
    // Generate a random alphanumeric code (you can customize the length and characters)
    return substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
}
// Save the image to a file (for debugging purposes)
imagepng($image, 'captcha_image.png');

?>
