<?php
session_start();
require 'conexao.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta ao banco para obter os dados do professor com base no email
$sql = "SELECT * FROM professores WHERE email = '$email'";
$result = mysqli_query($conexao, $sql); 

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Verificando se a senha fornecida corresponde ao hash armazenado
    if (password_verify($senha, $row['senha'])) {
        $_SESSION['professor_id'] = $row['id'];
        header("Location: ../professor/pagina_professor.php");
        exit;
    } else {
        echo "<script type='text/javascript'>
                alert('Email ou senha incorretos!');
                window.location.href = '../login-professor.html'; // Redireciona para a página de login
              </script>";
    }
} else {
    echo "<script type='text/javascript'>
            alert('Email ou senha incorretos!');
            window.location.href = '../login-professor.html'; // Redireciona para a página de login
          </script>";
}
?>
