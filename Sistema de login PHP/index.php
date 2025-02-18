<?php
include('conexao.php');
if(isset($_POST['usuario']) && isset($_POST['senha'])) {

    if(strlen($_POST['usuario']) == 0) {
        echo "Usuario não informado";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha = $mysqli->real_escape_string($_POST['senha']);
        $sql_code = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();
            if(!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: painel.php");
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('background.png');
            background-size: cover;
        }
        .tela-login{
            background-color: rgb(0, 0, 0, 0.8);
            position:absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 60px;
            border-radius: 20px;
            color: white;
            border: none
        }

        input{
            padding: 16px;
            border: none;
            outline: none;
            font-size: 18px;
            border-radius:25px
        }
        button{
            background-color: black;
            border: none;
            outline: none;
            padding: 16px;
            width: 100%;
            border-radius: 12px;
            color: white;
            font-size: 20px;
        }
        button:hover{
            background-color:white;
            cursor: pointer;
            color:black
        }
        .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        }

        video {
        width: 100%;
        height: 100%;
        object-fit: cover;  
        }

        .content {
        position: relative;
        z-index: 1;  
        color: white;
        text-align: center;
        padding: 50px;
        }


    </style>
</head>
<body>
<div class="video-background">
        <video autoplay muted loop>
            <source src="video.mp4" type="video/mp4">
            Seu navegador não suporta o formato de vídeo.
        </video>
    <div class="tela-login">
    <h1>Login</h1>
    <form action="" method="POST">
        <br>
            <input type="text" name="usuario" placeholder="Usuário">
            <br><br>      
            <input type="password" name="senha" placeholder="Senha">
            <br><br>   
            <button type="submit">Entrar</button>
    </form>
    </div>
</body>
</html>