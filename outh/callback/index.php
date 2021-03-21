<?php
$ot = $_GET["oauth_token"];
$ov = $_GET["oauth_verifier"];
echo "TEST";
exec("python C:\Users\raisan\OneDrive\ドキュメント\project\twstory\System_API\callback_outh.py {$ot} {$ov}", $OPT);
var_dump($OPT);