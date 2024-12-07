<?php 
require '../php/conexao.php'; 
if (isset($_SESSION['aluno_id'])) {
    $aluno_id = $_SESSION['aluno_id']; 
    $sql_sala = "SELECT salas_id FROM alunos_salas WHERE aluno_id = $aluno_id"; 
    $resultado_sala = mysqli_query($conexao, $sql_sala);
    if ($resultado_sala) {
        $sala = mysqli_fetch_assoc($resultado_sala);
        $sala_id = $sala['salas_id']; 

        $sql_materias = "SELECT materias.id, materias.nome 
                         FROM salas_materias 
                         JOIN materias ON salas_materias.materias_id = materias.id 
                         WHERE salas_materias.salas_id = $sala_id"; 
        $resultado_materias = mysqli_query($conexao, $sql_materias);
    } else {
        echo "Erro ao consultar a sala do aluno.";
        exit;
    }
} else {
    header("Location: ../login-aluno.html"); 
    exit;
}
?>

