<?php
session_start();
require '../php/conexao.php';

if (isset($_GET['id'])) {
    $atividade_id = $_GET['id'];
    $professor_id = $_SESSION['professor_id']; 

    $query = "SELECT * FROM atividades WHERE id = '$atividade_id' AND professor_id = '$professor_id'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        $query_delete_salas = "DELETE FROM atividades_salas WHERE atividade_id = '$atividade_id'";
        mysqli_query($conexao, $query_delete_salas);

        $query_delete = "DELETE FROM atividades WHERE id = '$atividade_id'";
        if (mysqli_query($conexao, $query_delete)) {
            header("Location: atividades_enviadas.php");
            exit();
        } else {
            echo "Erro ao excluir a atividade.";
        }
    } else {
        echo "Atividade não encontrada ou você não tem permissão para excluir.";
    }
}
?>
