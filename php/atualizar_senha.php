<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nova_senha = $_POST['nova_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($nova_senha === $confirmar_senha) {
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

        $query = "UPDATE aluno SET senha='$senha_hash', codigo_recuperacao=NULL WHERE codigo_recuperacao IS NOT NULL";
        mysqli_query($conexao, $query);

        echo "<script type='text/javascript'>
        alert('Senha alterada com sucesso!');
        window.location.href = '../login-aluno.php'; 
      </script>";
    } else {
        echo "<script type='text/javascript'>
        alert('As senhas não coincidem!');
        window.location.href = '../lib/alterar-senha.html'; 
      </script>";
    }
}
?>
