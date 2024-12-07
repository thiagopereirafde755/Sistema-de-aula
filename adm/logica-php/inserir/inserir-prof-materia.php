<?php
 require ('../../../php/conexao.php'); 
    $professor =  $_POST['professor']; 
    $materia =  $_POST['materia']; 


    $sql = "INSERT INTO professores_materias (professor_id, materia_id) VALUES ('$professor','$materia')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../prof-materia.php'; 
      </script>";
        // header("Location: ../prof-materia.php");
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }

mysqli_close($conexao);
?>
