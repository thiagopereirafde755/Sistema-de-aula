<?php
require '../php/conexao.php';

if (isset($_GET['materia_id'])) {
    $materia_id = $_GET['materia_id'];

   
    $sql = "
        SELECT s.id, s.nome
        FROM salas s
        JOIN salas_materias sm ON sm.salas_id = s.id
        WHERE sm.materias_id = $materia_id
    ";

    $result = mysqli_query($conexao, $sql);
    $salas = [];

    while ($sala = mysqli_fetch_assoc($result)) {
        $salas[] = $sala;
    }

    // Retorna as salas no formato JSON
    echo json_encode($salas);
} else {
    echo json_encode([]);
}
?>
