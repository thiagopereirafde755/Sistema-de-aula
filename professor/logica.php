<?php
require '../php/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: ../login-professor.html"); 
}

$professor_id = $_SESSION['professor_id'];

// Consulta SQL para pegar as matérias do professor
$sql_materias = "
    SELECT m.id, m.nome 
    FROM materias m
    JOIN professores_materias pm ON pm.materia_id = m.id
    WHERE pm.professor_id = $professor_id
";
$result_materias = mysqli_query($conexao, $sql_materias);

// Função para pegar as salas associadas a uma matéria
function getSalas($materia_id, $conexao) {
    $sql_salas = "
        SELECT s.id, s.nome
        FROM salas s
        JOIN salas_materias sm ON sm.salas_id = s.id
        WHERE sm.materias_id = $materia_id
    ";
    return mysqli_query($conexao, $sql_salas);
}
?>