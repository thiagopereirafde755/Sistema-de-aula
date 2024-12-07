<?php
 require ('../../../php/conexao.php'); 
    $professor =  $_POST['professor']; 
    $sala =  $_POST['sala']; 


    $sql = "INSERT INTO professores_salas (professor_id, sala_id) VALUES ('$professor','$sala')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../prof-sala.php'; 
      </script>";
        // header("Location: ../prof-sala.php");
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }

mysqli_close($conexao);
?>
