<?php
session_start();
require 'logica.php';
require 'nome.php';
require '../php/conexao.php';
$diretorio_uploads = '../fotos-perfil/';
$query = "SELECT foto_perfil FROM professores WHERE id = " . $_SESSION['professor_id'];
$resultado = mysqli_query($conexao, $query);
$professor = mysqli_fetch_assoc($resultado);
$foto_perfil = $diretorio_uploads . $professor['foto_perfil'];
if (!$professor['foto_perfil'] || !file_exists($foto_perfil)) {
    $foto_perfil = '../img/user.png';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela do Professor</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/style-prof.css">
    <link rel="stylesheet" href="../css/pgn-alu-prof.css">

</head>

<body>
<style>
    
body {
    background-color: #ECEBF3;
}
.tooltip {
    display: none; 
    position: absolute;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px;
    margin-top: 10px;
    border-radius: 10px;  
}
.user-img {
    border-radius: 50%; 
    transition: box-shadow 0.8s ease; 
}

.user-img:hover {
    box-shadow: 0 0 8px 8px rgba(112, 107, 107, 0.5); 
}


</style>

<header class="header">
    <div class="header-content">
        
        <h1 style="margin-top:9px; font-size:17px;" >Bem-vindo, Professor(a)!</h1>
        <div class="menu-icon" onclick="toggleSidebar()">&#9776;</div>
        <div class="profile">
        <a href="pagina-informacoes.php">
        <img src="<?php echo $foto_perfil; ?>" alt="Ícone de usuário" class="user-img" id="profileCircle">
</a> <div class="tooltip" id="tooltip">
                <span>Nome: <?php echo $nome_professor; ?></span><br> 
                <span>Email: <?php echo $email_professor; ?></span> 
            </div>
        </div>
    </div>
</header>

<aside class="sidebar" aria-label="Navegação do Professor">
    <br>
    <?php
        echo '<a href="atividades_enviadas.php" id="atividadesLink" class="sair" style="margin-left: -7px;">Atividades Enviadas</a>';

        echo '<hr style="margin: 18px 1%; color: #525252; width: 91%; border: 1px solid #525252 !important;">';
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


    <a href="../php/logout.php" class="sair">
        <img src="../img/sair-icon.png" alt="Ícone de Sair" style="margin-left: -38px;">
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
<script>
    window.onload = function() {
        var atividadesLink = document.getElementById('atividadesLink');
                if (window.innerWidth < 768) {
            atividadesLink.href = '#'; // Desabilitar link
            atividadesLink.addEventListener('click', function(e) {
                e.preventDefault(); // Impedir navegação
                alert("Esta página só é possível acessar em um computador.");
                window.location.href = 'pagina_professor.php'; 
            });
        }
    }
</script>

<script src="../js/barra-aluno-lateral-mob.js"></script>
<script src="../js/professor.js">
</script>

</body>
</html>
