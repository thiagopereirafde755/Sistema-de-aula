<?php
require ('../../php/conexao.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_check = "SELECT COUNT(*) AS total FROM atividades WHERE professor_id = $id";
    $result_check = mysqli_query($conexao, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);
    
    if ($row_check['total'] > 0) {
        $sql_delete_dependents = "DELETE FROM atividades WHERE professor_id = $id";
        if (mysqli_query($conexao, $sql_delete_dependents)) {
            echo "Registros dependentes excluídos com sucesso!<br>";
        } else {
            echo "Erro ao excluir registros dependentes: " . mysqli_error($conexao) . "<br>";
        }
    }

    $sql = "DELETE FROM professores WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        echo "Professor excluído com sucesso!";
        header("Location: ../professor.php"); 
        exit; 
    } else {
        echo "Erro ao excluir o professor: " . mysqli_error($conexao); 
    }
}


mysqli_close($conexao);
?>
