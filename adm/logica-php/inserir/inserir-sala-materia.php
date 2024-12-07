<?php
require ('../../../php/conexao.php'); 

$materia = $_POST['materia']; 
$sala = $_POST['sala']; 

$sql_check_materia = "SELECT * FROM materias WHERE id = '$materia'";
$result_materia = mysqli_query($conexao, $sql_check_materia);

if (mysqli_num_rows($result_materia) > 0) {
    $sql_check = "SELECT * FROM salas_materias WHERE salas_id = '$sala' AND materias_id = '$materia'";
    $result_check = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
    } else {
        $sql_insert = "INSERT INTO salas_materias (salas_id, materias_id) VALUES ('$sala', '$materia')";
        if (mysqli_query($conexao, $sql_insert)) {
            echo "<script type='text/javascript'>
            alert('Cadastro realizado com sucesso!');
            window.location.href = '../../sala-materia.php'; 
          </script>";
        } else {
            echo "Erro: " . mysqli_error($conexao); 
        }
    }
} else {
    echo "<script type='text/javascript'>
    alert('A matéria informada não existe!');
    window.location.href = '../../sala-materia.php'; 
  </script>";
}
