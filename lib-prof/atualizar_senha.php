<?php
include '../php/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($nova_senha === $confirmar_senha) {
        $query = "UPDATE professores SET senha='$nova_senha', codigo_recuperacao=NULL WHERE codigo_recuperacao IS NOT NULL";
        mysqli_query($conexao, $query);
        echo "<script type='text/javascript'>
        alert('Senha Alterada com sucesso!');
        window.location.href = '../login-professor.html'; 
      </script>";
        // header('Location: ../login-aluno.html');
    } else {
        echo "<script type='text/javascript'>
        alert('As senhas não coincidem!');
        window.location.href = 'alterar-senha.html'; 
      </script>";
        // echo "As senhas não coincidem!";
    }
}
?>