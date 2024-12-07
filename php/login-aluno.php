<?php
session_start();
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM aluno WHERE email = '$email' AND confirmado = 1";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($senha, $row['senha'])) {
        $_SESSION['aluno_id'] = $row['id'];
        header("Location: ../aluno/pagina_aluno.php");
        exit;
    } else {
        echo "<script type='text/javascript'>
                alert('Email ou senha incorretos.');
                window.location.href = '../login-aluno.php'; 
              </script>";
    }
} else {
    $sql_check = "SELECT * FROM aluno WHERE email = '$email'";
    $result_check = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script type='text/javascript'>
                alert('Conta ainda não confirmada. Verifique seu email para confirmar sua conta.');
                window.location.href = '../aluno/confirmacao.php?email=$email'; // Redireciona para a página de confirmação
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Email ou senha incorretos.');
                window.location.href = '../login-aluno.php'; 
              </script>";
    }
}
?>
