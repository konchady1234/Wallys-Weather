<?php
require_once('inc/recaptchalib.php');
$publickey = "6LeIvOoSAAAAAHp-zbE6aBeMDohqhH-shAo7V2Lm"; // you got this from the signup page
$privatekey = "6LeIvOoSAAAAABGMBPN8a9JqodDJGo8TROBTlxqr";


$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if ($resp->is_valid) {
    ?>success<?
}
else 
{
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
       "(reCAPTCHA said: " . $resp->error . ")");
}
?>