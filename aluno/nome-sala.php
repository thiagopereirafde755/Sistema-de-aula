<?php
require '../php/conexao.php';
$aluno_id = $_SESSION['aluno_id'];
$query_materias_salas = "
    SELECT m.id AS materia_id, m.nome AS materia_nome, s.nome AS sala_nome
    FROM materias m
    JOIN salas_materias sm ON sm.materias_id = m.id
    JOIN alunos_salas asls ON asls.salas_id = sm.salas_id
    JOIN salas s ON s.id = sm.salas_id
    WHERE asls.aluno_id = $aluno_id
    ORDER BY s.nome, m.nome
";
$resultado_materias_salas = mysqli_query($conexao, $query_materias_salas);
if (!$resultado_materias_salas) {
    die('Erro na consulta de matérias e salas: ' . mysqli_error($conexao));
}
?>