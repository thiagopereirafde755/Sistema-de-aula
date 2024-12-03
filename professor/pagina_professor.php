<?php
session_start();
require 'logica.php';
require 'nome.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela do Professor</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/styleprof1.css">
    <link rel="stylesheet" href="../css/styleprof2.css">
</head>

<body>
<style>
body {
    background-color: #ECEBF3;
}

</style>

<header class="header">
    <div class="header-content">
        
        <h1 style="margin-top:9px;">Bem-vindo, Professor!</h1>
        <div class="profile">
            <img src="../img/user.png" alt="Ícone de usuário" class="user-img" id="profileCircle">
            <div class="tooltip" id="tooltip">
                <span>Nome: <?php echo $nome_professor; ?></span><br> 
                <span>Email: <?php echo $email_professor; ?></span> 
            </div>
        </div>
    </div>
</header>

<aside class="sidebar" aria-label="Navegação do Professor">
    <br>
    <?php
        echo '<a href="atividades_enviadas.php" class="sair">Atividades Enviadas</a>';
        echo '<h2 style="margin-left: 10px;">Minhas Matérias</h2>';
    ?>
    <br>
    <button class="dropdown-btn">Matérias</button>
    <div class="dropdown-container">
        <?php
        while ($materia = mysqli_fetch_assoc($result_materias)) {
            echo '<a href="javascript:void(0);" class="materia" data-materia="' . $materia['id'] . '">' . $materia['nome'] . '</a>';
        }
        ?>
    </div>


    <a href="../index.html" class="sair">
        <img src="../img/sair-icon.png" alt="Ícone de Sair">
        Sair
    </a>
</aside>

<div class="content" id="content">
    <div id="materiaAtiva"></div>

    <div class="form-container">
        <form id="atividadeForm" method="POST" action="enviar.php" enctype="multipart/form-data">
            <h2 class="quadro">Adicionar Atividade</h2>  
            <br>
            <input type="hidden" name="materia_id" id="materia_id">
            <label for="salas">Selecionar Salas:</label><br>
            <div id="salas"></div>
            <br>
<br>
            <label for="descricao">Descrição da Atividade:</label>
            <br><br>
            <input type="text" id="descricao" name="descricao" required class="botao">
            <br><br>

            <label for="link">Adicionar Link:</label>
            <br><br>
            <input type="url" id="link" name="link" placeholder="https://exemplo.com" class="botao">
            <br><br>

            <label for="arquivo" class="botao1">
                <img src="../img/salvar-arquivo.png" alt="Ícone" class="icone-arquivo"> Adicionar Arquivo
            </label>
            <input type="file" name="arquivo" id="arquivo" accept=".pdf, .doc, .docx, .ppt, .pptx, .txt">
            <br>

         
            <button type="submit" class="botao1">Enviar Atividade</button>
        <br>
        </form>
        <br><br>

    </div>
</div>

<script src="../js/professor.js">
</script>

</body>
</html>
