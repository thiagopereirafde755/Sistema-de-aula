<?php
require ('../../../php/conexao.php'); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM professores_materias WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        header("Location: ../../prof-materia.php"); 
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>