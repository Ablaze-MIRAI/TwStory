<?php
session_start();
header("Content-type: text/html; charset=utf-8");
$CONF = json_decode(file_get_contents("./env/keys.json"), true);
require_once "./vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

if(empty($_SESSION["OT"]) || empty($_SESSION["OS"]) || empty($_GET["oauth_token"]) || empty($_GET["oauth_verifier"])){
    header("Location: /?403");
    exit;
}

if($_SESSION["OT"] !== $_GET["oauth_token"]) {
    header("Location: /403");
    exit;
}

$outh = new TwitterOAuth($CONF["CK"], $CONF["CS"], $_SESSION["OT"], $_SESSION["OS"]);
$ACSSES_TOKEN = $outh -> oauth("oauth/access_token", ["oauth_verifier" => $_GET["oauth_verifier"]]);
$_SESSION = [];
$_SESSION["ACSSES_TOKEN"] = $ACSSES_TOKEN;
header("Location: ./privacy/");
exit;