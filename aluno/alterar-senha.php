<?php
session_start();
require '../php/conexao.php'; // Arquivo de conexão com o banco

if (isset($_POST['alterar_senha'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha_atual = mysqli_real_escape_string($conexao, $_POST['senha-atual']);
    $nova_senha = mysqli_real_escape_string($conexao, $_POST['nova-senha']);
    $repetir_senha = mysqli_real_escape_string($conexao, $_POST['repetir-senha']);

    // Verifica se as senhas coincidem
    if ($nova_senha !== $repetir_senha) {
        echo "<script type='text/javascript'>
        alert('As senhas não coincidem. Tente novamente.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
    } else {
        // Verifica se o aluno existe e a senha atual fornecida corresponde ao hash armazenado
        $query = "SELECT * FROM aluno WHERE email = '$email'";
        $resultado = mysqli_query($conexao, $query);
        
        if (mysqli_num_rows($resultado) > 0) {
            $aluno = mysqli_fetch_assoc($resultado);

            // Verifica a senha atual com password_verify
            if (password_verify($senha_atual, $aluno['senha'])) {
                // Faz o hash da nova senha
                $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                
                // Atualiza a senha no banco de dados
                $query_update = "UPDATE aluno SET senha = '$nova_senha_hash' WHERE email = '$email'";
                if (mysqli_query($conexao, $query_update)) {
                    echo "<script type='text/javascript'>
                    alert('Senha alterada com sucesso.');
                    window.location.href = 'pagina-informacoes.php'; 
                  </script>";
                } else {
                    echo "<script type='text/javascript'>
                    alert('Erro ao alterar a senha.');
                    window.location.href = 'pagina-informacoes.php'; 
                  </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                alert('Senha atual incorreta.');
                window.location.href = 'pagina-informacoes.php'; 
              </script>";
            }
        } else {
            echo "<script type='text/javascript'>
            alert('Email não encontrado.');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
        }
    }
}
?>
