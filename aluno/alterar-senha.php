<?php
session_start();
require '../php/conexao.php'; // Arquivo de conexão com o banco

if (isset($_POST['alterar_senha'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha_atual = mysqli_real_escape_string($conexao, $_POST['senha-atual']);
    $nova_senha = mysqli_real_escape_string($conexao, $_POST['nova-senha']);
    $repetir_senha = mysqli_real_escape_string($conexao, $_POST['repetir-senha']);

    if ($nova_senha !== $repetir_senha) {
        echo "<script type='text/javascript'>
        alert('As senhas não coincidem. Tente novamente.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
        // echo "As senhas não coincidem. Tente novamente.";
    } else {
        $query = "SELECT * FROM aluno WHERE email = '$email' AND senha = '$senha_atual'";
        $resultado = mysqli_query($conexao, $query);
        
        if (mysqli_num_rows($resultado) > 0) {
            $query_update = "UPDATE aluno SET senha = '$nova_senha' WHERE email = '$email'";
            if (mysqli_query($conexao, $query_update)) {
                echo "<script type='text/javascript'>
        alert('Senha alterada com sucesso.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
                // echo "Senha alterada com sucesso.";
            } else {
                echo "<script type='text/javascript'>
                alert('Erro ao alterar a senha.');
                window.location.href = 'pagina-informacoes.php'; 
              </script>";
                // echo "Erro ao alterar a senha.";
            }
        } else {
            echo "<script type='text/javascript'>
            alert('Email ou senha atual incorretos.');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
            // echo "Email ou senha atual incorretos.";
        }
    }
}
?>
