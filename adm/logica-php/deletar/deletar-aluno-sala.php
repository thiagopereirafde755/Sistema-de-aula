<?php
require ('../../../php/conexao.php'); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM alunos_salas WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../../aluno-sala.php"); 
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>
