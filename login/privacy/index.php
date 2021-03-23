<?php
session_start();
$csrf = $_SESSION["CSRF_TOKEN"];
if(isset($_SESSION["CSRF_TOKEN"]) && !empty($_SESSION["CSRF_TOKEN"]) && isset($_GET["csrf"]) && !empty($_GET["csrf"])){
    if($_SESSION["CSRF_TOKEN"] !== $_GET["csrf"]){
        header("Location: /home/?403");
        exit;
    }
}else{
    header("Location: /home/?403");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ついすとーりー</title>
</head>
<body>
    <button id="agree">同意する</button>
    <script>
        const agree = document.getElementById("agree");
        agree.onclick = () =>{
            fetch("../cuser.php?csrf=<?=$csrf?>")
            .then(response =>{
                return response.text();
            })
            .then(text =>{
                if(text === "done"){
                    window.location = "/home/?initial";
                }else{
                    alert("エラーが発生しました。TOPへ戻ります <SERVER: 500>");
                    window.location = "/";
                }
            })
            .catch((e) =>{
                alert(`エラーが発生しました。TOPへ戻ります <CRIENT: ${e}>`);
                window.location = "/";
            });
        }
    </script>
</body>
</html>