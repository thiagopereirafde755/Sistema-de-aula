<?php
require ('../php/conexao.php'); 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conexao, $_GET['search']) : '';

if ($search != '') {
    $sql = "SELECT aluno.id, aluno.nome, aluno.email, aluno.senha, salas.nome AS sala_nome 
            FROM aluno
            JOIN alunos_salas ON aluno.id = alunos_salas.aluno_id
            JOIN salas ON alunos_salas.salas_id = salas.id
            WHERE aluno.nome LIKE '%$search%'";
} else {
    $sql = "SELECT aluno.id, aluno.nome, aluno.email, aluno.senha, salas.nome AS sala_nome 
            FROM aluno
            JOIN alunos_salas ON aluno.id = alunos_salas.aluno_id
            JOIN salas ON alunos_salas.salas_id = salas.id";
}

$result = mysqli_query($conexao, $sql);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de aluno</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/pesquisa.css">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/modal1.css">
</head>
<body>
<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
} 
</style>
<div class="header">
<a href="pagina_adm.php"><img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon"></a>


    <form method="GET" action="" class="search-form">
        <input type="text" name="search" id="search" class="search-input" placeholder="Pesquisar por Nome" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="search-button">
            <img src="../img/search-icon.png" alt="Buscar" class="search-icon">
        </button>
    </form>

   

</div>
<h2 style=" text-align: center; justify-content: center;">Dados da Tabela de aluno</h2>



<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Sala</th>
            <th>Senha</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nome"] . "</td>
                        <td>" . $row["email"] . "</td>
                         <td>" . $row["sala_nome"] . "</td> 
                        <td>****</td>
                        <td>
                            <a href='logica-php/deletar/deletar-aluno.php?id=" . $row["id"] . "'>
                                <img src='../img/excluir.png' alt='Excluir' style='width: 50px; height: 30px; vertical-align: middle;'>
                            </a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum dado encontrado</td></tr>"; // Alterei para 6 colunas
        }
        ?>
    </tbody>
</table>

<script src="../js/modal.js"></script>
</body>
</html>


