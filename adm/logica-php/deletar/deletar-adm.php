<?php
require ('../../../php/conexao.php'); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM adm WHERE id = $id";

    if (mysqli_query($conexao, $sql)) {
        echo "Usuário excluído com sucesso!";
        header("Location: ../../adm.php"); 
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }
}

// Fecha a conexão
mysqli_close($conexao);
?>
