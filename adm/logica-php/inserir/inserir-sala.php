<?php
 require ('../../../php/conexao.php'); 
    $nome =  $_POST['nome']; 


    $sql = "INSERT INTO salas (nome) VALUES ('$nome')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../salas.php'; 
      </script>";
        // header("Location: ../salas.php");
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }

mysqli_close($conexao);
?>
