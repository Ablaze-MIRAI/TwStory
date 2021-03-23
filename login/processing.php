<?php
session_start();
if(isset($_SESSION["ACSSES_TOKEN"])){
    $user_id = $_SESSION["ACSSES_TOKEN"]["user_id"];
    if(file_exists("./db/acsses_token/{$user_id}.json")){
        if(json_decode(file_get_contents("./db/acsses_token/{$user_id}.json"), true)["auth"] === "allow"){
            header("Location: /home/");
        }else{
            header("Location: ./lock/");
        }
    }else{
        $csrf = bin2hex(openssl_random_pseudo_bytes(16));
        unset($_SESSION["CSRF_TOKEN"]);
        $_SESSION["CSRF_TOKEN"] = $csrf;
        header("Location: ./privacy/?csrf={$csrf}");
    }
}