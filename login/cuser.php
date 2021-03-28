<?php
session_start();
if(isset($_SESSION["CSRF_TOKEN"]) && !empty($_SESSION["CSRF_TOKEN"]) && isset($_GET["csrf"]) && !empty($_GET["csrf"])){
    if($_SESSION["CSRF_TOKEN"] === $_GET["csrf"]){
        $new_user = ["auth" => "allow", "screen" => $_SESSION["ACSSES_TOKEN"]["screen_name"], "at" => $_SESSION["ACSSES_TOKEN"]["oauth_token"], "as" => $_SESSION["ACSSES_TOKEN"]["oauth_token_secret"]];
        $uid = $_SESSION["ACSSES_TOKEN"]["user_id"];
        if(file_put_contents("../db/acsses_token/{$uid}.json", json_encode($new_user))){
            echo "done";
            exit;
        }else{
            echo "err <profile_err>";
            exit;
        }
    }else{
        echo "err <csrf_illegal>";
        exit;
    }
}else{
    echo "err <csrf_fount_pram>";
    exit;
}