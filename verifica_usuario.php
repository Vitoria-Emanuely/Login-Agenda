<?php

session_start();

$linkimg =  $_POST['link'];
$_SESSION['usuario_link'] =   $linkimg;


    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $usuarios = file_get_contents('usuarios.json');
    $usuarios = json_decode($usuarios, true);



function login()
{

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $usuarios = file_get_contents('usuarios.json');
    $usuarios = json_decode($usuarios, true);



    $usuario_existe = false;

    foreach ($usuarios as $usuario) {


        if ($login == $usuario['usuario'] && $senha == $usuario['senha']) {
            $usuario_existe = true;

            $_SESSION['usuario_nome']   = $usuario['nome'];
            $_SESSION['usuario_login']  = $login;
            $_SESSION['usuario_senha']  = $senha;
            $_SESSION['usuario_online'] = true;

            //redirecionar
            header('Location: index.phtml');
        }
    }
    if ($usuario_existe == false) {
        header('Location: login.php');

    }


}

function logout()
{

    session_destroy();
    header('Location: login.php');

}

//rotas
if ($_GET['acao'] == 'login') {
    login();
}

if ($_GET['acao'] == 'sair') {

    logout();
}