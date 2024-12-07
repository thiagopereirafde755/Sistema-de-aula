<?php
require '../php/conexao.php'; 

if (isset($_SESSION['professor_id'])) {
    $professor_id = $_SESSION['professor_id']; 
    $sql_professor = "SELECT nome, email FROM professores WHERE id = $professor_id";
    $result_professor = mysqli_query($conexao, $sql_professor);

    if ($result_professor) {
        $professor = mysqli_fetch_assoc($result_professor);
        $nome_professor = $professor['nome']; 
        $email_professor = $professor['email']; 
    } else {
        $nome_professor = "Professor não encontrado";
        $email_professor = "Email não disponível"; 
    }
}
?>
