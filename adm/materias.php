<?php
require ('../php/conexao.php'); 

$sql = "SELECT * FROM materias";
$result = mysqli_query($conexao, $sql);
?>
<?php
require ('../php/conexao.php'); 

$search = isset($_GET['search']) ? mysqli_real_escape_string($conexao, $_GET['search']) : '';

if ($search != '') {
    $sql = "SELECT * FROM materias WHERE nome LIKE '%$search%'";
} else {

    $sql = "SELECT * FROM materias";
}
 
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Materia</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/pesquisa.css">
    <link rel="stylesheet" href="../css/tables.css">
    <link rel="stylesheet" href="../css/modal1.css">
</head>
<body>
<div class="header">
    <a href="javascript:history.back();"><img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon"></a>


    <form method="GET" action="" class="search-form">
        <input type="text" name="search" id="search" class="search-input" placeholder="Pesquisar por Materia" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit" class="search-button">
            <img src="../img/search-icon.png" alt="Buscar" class="search-icon">
        </button>
    </form>

   

</div>
<h2 style=" text-align: center; justify-content: center;">Dados da Tabela de materias</h2>

<h3 style="text-align: center;"> 
<a href="javascript:void(0);" id="openModal"><img src="../img/adicionar.png"  class="adicionar-ic"></a>
</h3>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
<h3 style=" text-align: center;
    justify-content: center;">Adicionar materia</h3>
<form action="logica-php/inserir/inserir-materias.php" method="post" class="tabela" style="    text-align: center;
    justify-content: center;">
    <label for="nome" >Nome materia:</label>
    <input type="text" id="nome" placeholder="materia" class="input-caixa" name="materia" required>
    <br>
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
                        <td>
                            <a href='logica-php/deletar/deletar-materias.php?id=" . $row["id"] . "'>
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


