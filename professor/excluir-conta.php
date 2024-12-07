<?php
session_start();
require '../php/conexao.php'; 

if (isset($_POST['excluir_conta'])) {
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    
    // Verifica se o professor existe com o email e senha fornecidos
    $query = "SELECT * FROM professores WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $query);
    
    if (mysqli_num_rows($resultado) > 0) {
        $professor = mysqli_fetch_assoc($resultado);
        $professor_id = $professor['id'];
        
        // Excluir registros da tabela 'atividades_salas' que estão vinculados a atividades do professor
        $query_delete_atividades_salas = "DELETE FROM atividades_salas WHERE atividade_id IN (SELECT id FROM atividades WHERE professor_id = '$professor_id')";
        mysqli_query($conexao, $query_delete_atividades_salas);
        
        // Excluir registros da tabela 'atividades' que estão vinculados ao professor
        $query_delete_atividades = "DELETE FROM atividades WHERE professor_id = '$professor_id'";
        mysqli_query($conexao, $query_delete_atividades);
        
        // Agora exclui o professor
        $query_delete_professor = "DELETE FROM professores WHERE id = '$professor_id'";
        
        if (mysqli_query($conexao, $query_delete_professor)) {
            echo "<script type='text/javascript'>
            alert('Conta excluída com sucesso!');
            window.location.href = '../index.html'; 
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Erro ao excluir a conta. Tente novamente.');
            window.location.href = 'pagina-informacoes.php'; 
            </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Email ou senha incorretos.');
        window.location.href = 'pagina-informacoes.php'; 
        </script>";
    }
}
?>
