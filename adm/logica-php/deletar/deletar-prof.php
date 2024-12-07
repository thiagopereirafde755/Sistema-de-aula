<?php
require ('../../../php/conexao.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_delete_dependents = "DELETE FROM atividades_salas WHERE atividade_id IN (SELECT id FROM atividades WHERE professor_id = $id)";
    if (mysqli_query($conexao, $sql_delete_dependents)) {
        echo "Registros dependentes excluídos com sucesso!<br>";
    } else {
        echo "Erro ao excluir registros dependentes: " . mysqli_error($conexao) . "<br>";
    }

    $sql_delete_atividades = "DELETE FROM atividades WHERE professor_id = $id";
    if (mysqli_query($conexao, $sql_delete_atividades)) {
        echo "Registros de atividades excluídos com sucesso!<br>";
    } else {
        echo "Erro ao excluir registros de atividades: " . mysqli_error($conexao) . "<br>";
    }

    $sql = "DELETE FROM professores WHERE id = $id";
    if (mysqli_query($conexao, $sql)) {
        echo "Professor excluído com sucesso!";
        header("Location: ../../professor.php"); 
        exit; 
    } else {
        echo "Erro ao excluir o professor: " . mysqli_error($conexao); 
    }
}

mysqli_close($conexao);
?>
