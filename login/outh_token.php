<?php
ini_set("display_errors", 1);
session_start();
header("Content-type: text/html; charset=utf-8");
$CONF = json_decode(file_get_contents("../env/keys.json"), true);
require_once "../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;
if(isset($_SESSION["CSRF_TOKEN"]) && !empty($_SESSION["CSRF_TOKEN"]) && isset($_GET["csrf"]) && !empty($_GET["csrf"])){
    if($_SESSION["CSRF_TOKEN"] === $_GET["csrf"]){
        unset($_SESSION["CSRF_TOKEN"]);
        $outh = new TwitterOAuth($CONF["CK"], $CONF["CS"]);
        $request_token = $outh -> oauth("oauth/request_token", ["oauth_callback" => $CONF["CALL_BACK"]]);
        $_SESSION["OT"] = $request_token["oauth_token"];
        $_SESSION["OS"] = $request_token["oauth_token_secret"];
        $outh_url = $outh -> url("oauth/authenticate", ["oauth_token" => $_SESSION["OT"]]);
        echo $outh_url;
        exit;
    }else{
        echo "err";
        exit;
    }
}else{
    echo "err";
    exit;
}