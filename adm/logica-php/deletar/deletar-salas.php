<?php
require ('../../../php/conexao.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_check = "SELECT COUNT(*) AS total FROM alunos_salas WHERE salas_id = $id";
    $result_check = mysqli_query($conexao, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    
    if ($row_check['total'] > 0) {
        $sql_delete_dependents = "DELETE FROM alunos_salas WHERE salas_id = $id";
        if (mysqli_query($conexao, $sql_delete_dependents)) {
            echo " excluídos<br>";
        } else {
            echo "Erro ao excluir  " . mysqli_error($conexao) . "<br>";
        }
    }

    $sql = "DELETE FROM salas WHERE id = $id";
    if (mysqli_query($conexao, $sql)) {
        header("Location: ../../salas.php"); 
        exit;
    } else {
        echo "Erro ao excluir a sala: " . mysqli_error($conexao); 
    }
}

mysqli_close($conexao);
?>
