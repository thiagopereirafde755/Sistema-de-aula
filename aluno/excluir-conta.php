<?php
session_start();
require '../php/conexao.php'; 

if (isset($_POST['excluir_conta'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $query = "SELECT * FROM aluno WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $query);
    if (mysqli_num_rows($resultado) > 0) {
        $aluno = mysqli_fetch_assoc($resultado);
        $aluno_id = $aluno['id'];
        $query_delete_salas = "DELETE FROM alunos_salas WHERE aluno_id = '$aluno_id'";
        mysqli_query($conexao, $query_delete_salas);
        $query_delete_aluno = "DELETE FROM aluno WHERE id = '$aluno_id'";
        if (mysqli_query($conexao, $query_delete_aluno)) {
            echo "<script type='text/javascript'>
            alert('Conta excluída com sucesso!');
            window.location.href = '../index.html'; 
          </script>";
            // echo "Conta excluída com sucesso!";
        } else {
            echo "<script type='text/javascript'>
            alert('Erro ao excluir a conta. Tente novamente.');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
            // echo "Erro ao excluir a conta. Tente novamente.";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Email ou senha incorretos.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
        // echo "Email ou senha incorretos.";
    }
}
?>
