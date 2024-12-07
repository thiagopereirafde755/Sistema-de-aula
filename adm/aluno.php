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
    <a href="javascript:history.back();"><img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon"></a>


    <form method="GET" action="" class="search-form">
        <input type="text" name="search" id="search" class="search-input" placeholder="Pesquisar por Nome" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="search-button">
            <img src="../img/search-icon.png" alt="Buscar" class="search-icon">
        </button>
    </form>

   

</div>
<h2 style=" text-align: center; justify-content: center;">Dados da Tabela de aluno</h2>

<h3 style="text-align: center;"> 
<a href="javascript:void(0);" id="openModal"><img src="../img/adicionar.png"  class="adicionar-ic"></a>
</h3>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
<h3 style=" text-align: center;
   
   justify-content: center;">Adicionar Novo aluno</h3>
<form action="logica-php/inserir/cadastroaluno.php" method="post" class="tabela">
     <div class="a">
                <div class="input">
                <label for="nome">Nome:</label>
                    <input type="text" placeholder="Usuário" class="input-caixa" name="nome" required>
                </div>
                <div class="input">
                <label for="email">Email:</label>
                    <input type="email" placeholder="email" class="input-caixa" name="email" required>
                </div>
                <div class="input">
                <label for="senha">Senha:</label>    
                <input type="password" placeholder="Senha" class="input-caixa" name="senha" required>
                </div>
                <div class="input">
                    <label for="turma">Escolha a turma:</label>
                    <select name="turma" class="input-caixa" required>
                        <option value="" disabled selected>Selecione...</option>
                        <?php
                       
                       require '../php/conexao.php';
                        $sql = "SELECT id, nome FROM salas";
                        $resultado = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($resultado) > 0) {
                            while($row = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Nenhuma turma encontrada</option>";
                        }

                        mysqli_close($conexao);
                        ?>
                    </select>
                </div>
            </div>
    <div class="entrar">
                <input type="submit" value="Cadastrar">
                </div>
        </form>
    </div>
</div>
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


