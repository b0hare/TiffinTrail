<?php

session_start();
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$len = strlen($characters);
$captcha = '';
for ($i = 0; $i < 6; $i++) {
    $captcha .= $characters[rand(0, $len - 1)];
}
$_SESSION['captcha'] = $captcha; // Store captcha in session
echo "$captcha";
 ?>