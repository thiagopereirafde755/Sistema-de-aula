<?php
//if (isset($_GET['materia_id'])) {
  //  $materia_id = $_GET['materia_id'];

    // Consulta para pegar as atividades da matéria
    //$sql_atividades = "SELECT a.id, a.descricao, a.link, a.arquivo 
      //                 FROM atividades a 
        //               WHERE a.materia_id = $materia_id";
    //$resultado_atividades = mysqli_query($conexao, $sql_atividades);

    //$atividades = [];
    //while ($atividade = mysqli_fetch_assoc($resultado_atividades)) {
      //  $atividades[] = $atividade;
    //}

    // Retorna as atividades no formato JSON
    //echo json_encode($atividades);
//} else {
  //  echo json_encode([]);
//}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
require '../php/conexao.php';
session_start(); 

if (isset($_SESSION['aluno_id'])) {
    $aluno_id = $_SESSION['aluno_id'];
} else {
    echo json_encode(['error' => 'Aluno não está logado.']);  
    exit;  
}

if (isset($_GET['materia_id'])) {
    $materia_id = $_GET['materia_id'];

    $sql_sala = "SELECT salas_id FROM alunos_salas WHERE aluno_id = ?";
    if ($stmt = mysqli_prepare($conexao, $sql_sala)) {
        mysqli_stmt_bind_param($stmt, "i", $aluno_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        // Verifica se a consulta retornou algum resultado
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $sala_id);
            mysqli_stmt_fetch($stmt);
        } else {
            echo json_encode(['error' => 'Nenhuma sala encontrada para este aluno.']);
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Erro na consulta da sala.']);
        exit;
    }

    // Consulta para pegar as atividades da matéria e sala específica
    $sql_atividades = "
     SELECT a.id, a.descricao, a.link, a.arquivo, a.data_envio, p.nome AS professor, m.nome AS materia
     FROM atividades a
     JOIN atividades_salas asls ON a.id = asls.atividade_id
     JOIN professores p ON a.professor_id = p.id
     JOIN materias m ON a.materia_id = m.id  -- Junção com a tabela de matérias
     WHERE a.materia_id = ? AND asls.sala_id = ?
    ";

    if ($stmt = mysqli_prepare($conexao, $sql_atividades)) {
        mysqli_stmt_bind_param($stmt, "ii", $materia_id, $sala_id);
        mysqli_stmt_execute($stmt);
        $resultado_atividades = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado_atividades) > 0) {
            $atividades = [];
            while ($atividade = mysqli_fetch_assoc($resultado_atividades)) {
                $atividades[] = $atividade;
            }
            echo json_encode($atividades);  // Exibe as atividades em formato JSON
        } else {
            $sql_materia = "SELECT nome FROM materias WHERE id = ?";
            if ($stmt_materia = mysqli_prepare($conexao, $sql_materia)) {
                mysqli_stmt_bind_param($stmt_materia, "i", $materia_id);
                mysqli_stmt_execute($stmt_materia);
                mysqli_stmt_bind_result($stmt_materia, $materia_nome);
                mysqli_stmt_fetch($stmt_materia);
                echo json_encode(['error' => 'Nenhuma atividade encontrada para esta sala e matéria.', 'materia_nome' => $materia_nome]);
                mysqli_stmt_close($stmt_materia);
            } else {
                echo json_encode(['error' => 'Erro ao obter o nome da matéria.']);
            }
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Erro na consulta das atividades.']);
    }
} else {
    echo json_encode(['error' => 'Erro: materia_id não definido.']);
}
?>