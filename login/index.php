<?php
session_start();
$csrf = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["CSRF_TOKEN"] = $csrf;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading - ついすとーりー</title>
</head>
<body>
    <h1>Loading</h1>
    <script>
        fetch("/login/outh_token.php?csrf=<?=$csrf?>")
        .then(response => {
            return response.text();
        })
        .then(text => {
            if(text === "err"){
                alert("エラーが発生しました。TOPへ戻ります<2>");
                window.location = "/";
            }else{
                window.location = text;
            }
        })
        .catch(() => {
            alert("エラーが発生しました。TOPへ戻ります<1>");
            window.location = "/";
        });
    </script>
</body>
</html>