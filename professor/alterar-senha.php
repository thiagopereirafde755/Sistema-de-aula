<?php
session_start();
require '../php/conexao.php'; 

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
        // Verifica se o professor existe e a senha atual corresponde ao hash armazenado
        $query = "SELECT * FROM professores WHERE email = '$email'";
        $resultado = mysqli_query($conexao, $query);
        
        if (mysqli_num_rows($resultado) > 0) {
            $professor = mysqli_fetch_assoc($resultado);
            
            // Verifica se a senha atual fornecida corresponde ao hash armazenado
            if (password_verify($senha_atual, $professor['senha'])) {
                // Hash da nova senha antes de armazená-la
                $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                
                // Atualiza a senha no banco de dados com o hash da nova senha
                $query_update = "UPDATE professores SET senha = '$nova_senha_hash' WHERE email = '$email'";
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
                alert('Senha atual incorreta.');
                window.location.href = 'pagina-informacoes.php'; 
              </script>";
                // echo "Senha atual incorreta.";
            }
        } else {
            echo "<script type='text/javascript'>
            alert('Email não encontrado.');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
            // echo "Email não encontrado.";
        }
    }
}
?>
