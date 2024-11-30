<?php
require '../php/conexao.php'; 
if (isset($_SESSION['aluno_id'])) {
    $aluno_id = $_SESSION['aluno_id']; 

    $sql_aluno = "SELECT nome, email FROM aluno WHERE id = $aluno_id";
    $result_aluno = mysqli_query($conexao, $sql_aluno);

    if ($result_aluno) {
        $aluno = mysqli_fetch_assoc($result_aluno);
        $nome_aluno = $aluno['nome']; 
        $email_aluno = $aluno['email'];
    } else {
        $nome_aluno = "aluno não encontrado";
    }
}
?>