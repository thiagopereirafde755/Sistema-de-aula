<?php
session_start();
require 'conexao.php';
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql = "SELECT * FROM professores WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conexao, $sql); 

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['professor_id'] = $row['id'];
        header("Location: ../professor/pagina_professor.php");
        exit;
    } else {
        echo "<script type='text/javascript'>
        alert('Email ou senha errado!');
        window.location.href = '../login-professor.html'; // Redireciona para a página de login
      </script>";
        // echo "Email ou senha inválidos.";
    }
?>

