<?php
require ('../php/conexao.php'); 

$sql = "SELECT * FROM alunos_salas;";
$result = mysqli_query($conexao, $sql);
?>
<?php
require ('../php/conexao.php'); 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conexao, $_GET['search']) : '';

if ($search != '') {
    $sql = "SELECT * FROM alunos_salas WHERE aluno_id LIKE '%$search%'";
} else {

    $sql = "SELECT * FROM alunos_salas";
}
 
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de aluno e sala</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/pesquisa.css">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/modal-form.css">
</head>
<body>
<div class="header">
<a href="pagina_adm.php"><img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon"></a>


    <form method="GET" action="" class="search-form">
        <input type="Number" name="search" id="search" class="search-input" placeholder="Pesquisar por Id do Aluno" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="search-button">
            <img src="../img/search-icon.png" alt="Buscar" class="search-icon">
        </button>
    </form>

   

</div>
<h2 style=" text-align: center; justify-content: center;">Dados da Tabela de aluno e sala</h2>

<h3 style="text-align: center;"> 
<a href="javascript:void(0);" id="openModal"><img src="../img/adicionar.png"  class="adicionar-ic"></a>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
<h3 style=" text-align: center;
   
   justify-content: center;">Adicionar aluno a sala</h3>
<form action="logica-php/inserir/inserir-aluno-sala.php" method="post" class="tabela" style="    text-align: center;
    justify-content: center;">
     <div class="a">
                <div class="input">
                <label for="aluno">ID-Aluno:</label>
                    <input type="number" placeholder="id_Aluno" class="input-caixa" name="aluno" required>
                </div>
                <div class="input">
                <label for="sala">ID-Sala:</label>
                    <input type="number" placeholder="id_Sala" class="input-caixa" name="sala" required>
                </div>
            </div>
            <button type="submit" class="botao2">Cadastrar</button>
        </form>
    </div>
</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Aluno</th>
            <th>ID sala</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                 <td>" . $row["id"] . "</td>
                        <td>" . $row["aluno_id"] . "</td>
                        <td>" . $row["salas_id"] . "</td>
                        <td>
                            <a href='logica-php/deletar/deletar-aluno-sala.php?id=" . $row["id"] . "'>
                                <img src='../img/excluir.png' alt='Excluir' style='width: 50px; height: 30px; vertical-align: middle;'>
                              
                            </a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum dado encontrado</td></tr>";
        }
        ?>
    </tbody>
</table>
<script src="../js/modal.js"></script>
    </body>
    </html>

