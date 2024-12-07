<?php
 require ('../../../php/conexao.php'); 
    $aluno =  $_POST['aluno']; 
    $sala =  $_POST['sala']; 


    $sql = "INSERT INTO alunos_salas (aluno_id, salas_id) VALUES ('$aluno','$sala')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../aluno-sala.php'; 
      </script>";
        // header("Location: ../aluno-sala.php");
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }

mysqli_close($conexao);
?>
