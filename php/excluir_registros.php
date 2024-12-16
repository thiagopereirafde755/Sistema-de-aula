<?php
require 'conexao.php';

$tempo_limite = 15;

$sql_delete_referencias = "DELETE FROM alunos_salas WHERE aluno_id IN (SELECT id FROM aluno WHERE confirmado = 0 AND TIMESTAMPDIFF(MINUTE, data_registro, NOW()) > ?)";
$stmt_referencias = mysqli_prepare($conexao, $sql_delete_referencias);
mysqli_stmt_bind_param($stmt_referencias, 'i', $tempo_limite);
mysqli_stmt_execute($stmt_referencias);

$sql_delete_aluno = "DELETE FROM aluno WHERE confirmado = 0 AND TIMESTAMPDIFF(MINUTE, data_registro, NOW()) > ?";
$stmt_aluno = mysqli_prepare($conexao, $sql_delete_aluno);
mysqli_stmt_bind_param($stmt_aluno, 'i', $tempo_limite);

if (mysqli_stmt_execute($stmt_aluno)) {
    
} else {
   
}

mysqli_close($conexao);
?>
