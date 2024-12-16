<?php
session_start();
require '../php/conexao.php';
?>

<?php
function getMateriaName($materia_id) {
    global $conexao;
    $query_materia = "SELECT nome FROM materias WHERE id = '$materia_id'";
    $result_materia = mysqli_query($conexao, $query_materia);
    if ($result_materia) {
        $materia = mysqli_fetch_assoc($result_materia);
        return $materia['nome'];
    }
    return 'Matéria não encontrada';
}
?>

<?php
function getSalaName($atividade_id) {
    global $conexao;
    $query_sala = "SELECT salas.nome FROM salas
                   JOIN atividades_salas ON salas.id = atividades_salas.sala_id
                   WHERE atividades_salas.atividade_id = '$atividade_id'";

    $result_sala = mysqli_query($conexao, $query_sala);
    if ($result_sala) {
        $sala = mysqli_fetch_assoc($result_sala);
        return $sala['nome'];
    }
    return 'Sala não definida';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades Enviadas</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/pesquisa.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
    </style>

    <div class="header">
        <a href="javascript:history.back();"> <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon"></a>
        <form method="GET" action="" class="search-form">
            <input type="text" name="search" id="search" class="search-input" placeholder="Pesquisar por Matéria" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit" class="search-button">
                <img src="../img/search-icon.png" alt="Buscar" class="search-icon">
            </button>
        </form>
    </div>

    <h2 style="text-align: center;">Atividades Enviadas</h2>

    <table border="1" style="text-align: center;">
        <thead>
            <tr>
             
                <th>Matéria</th>
                <th>Sala</th>
                <th>Descrição</th>
                <th>Link</th>
                <th>Arquivo</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $professor_id = $_SESSION['professor_id'];
            $search = isset($_GET['search']) ? $_GET['search'] : ''; 

            if ($search != '') {
                $query_atividades = "SELECT * FROM atividades 
                                      WHERE professor_id = '$professor_id' 
                                      AND materia_id IN (SELECT id FROM materias WHERE nome LIKE '%$search%')";
            } else {
                $query_atividades = "SELECT * FROM atividades WHERE professor_id = '$professor_id'";
            }

            $result_atividades = mysqli_query($conexao, $query_atividades);

            if (mysqli_num_rows($result_atividades) > 0) {
                while ($atividade = mysqli_fetch_assoc($result_atividades)) {
                    echo '<tr>';
                   
                    echo '<td>' . getMateriaName($atividade['materia_id']) . '</td>';

                   
                    $sala_name = getSalaName($atividade['id']);
                    echo '<td>' . $sala_name . '</td>';

                    echo '<td>' . $atividade['descricao'] . '</td>';
                    echo '<td><a href="' . $atividade['link'] . '" target="_blank">Ver Link</a></td>';
                    echo '<td><a href="' . $atividade['arquivo'] . '" download>Baixar</a></td>';
                    echo '<td>' . $atividade['data_envio'] . '</td>';
                    echo "<td><a href='excluir_atividades.php?id=" . $atividade['id'] . "' class='excluir'> 
                            <img src='../img/excluir.png' alt='Excluir' style='width: 50px; height: 30px; vertical-align: middle;'></a></td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="7">Nenhuma atividade encontrada</td></tr>';
            }
        ?>
        </tbody>
    </table>

</body>
</html>
