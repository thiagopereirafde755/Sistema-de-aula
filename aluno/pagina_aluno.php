<?php 
session_start(); 
require 'logica.php'; 
require 'nome-sala.php';
require 'nome-aluno.php';

$diretorio_uploads = '../fotos-perfil/';

// Consulta para buscar a foto do aluno
$query = "SELECT foto_perfil FROM aluno WHERE id = " . $_SESSION['aluno_id'];
$resultado = mysqli_query($conexao, $query);
$aluno = mysqli_fetch_assoc($resultado);

// Verifica se o arquivo da foto de perfil existe e é válido
$foto_perfil = $diretorio_uploads . $aluno['foto_perfil'];

if (!$aluno['foto_perfil'] || !file_exists($foto_perfil)) {
    // Se a imagem não existir ou estiver corrompida, usa a imagem padrão
    $foto_perfil = '../img/user.png';
}

$materias_salas = [];
while ($row = mysqli_fetch_assoc($resultado_materias_salas)) {
    $materias_salas[] = $row; 
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Aluno</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/stylealuno1.css">
    <link rel="stylesheet" href="../css/pgn-alu-prof.css">
</head>
<body>
    <style>
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
@media screen and (max-width: 768px) {
    #atividadeContainer {
        margin-top: 80px; 
    }
}

@media screen and (max-width: 768px) {
    header {
        position: relative; 
        z-index: 10; 
    }
}

    </style>
<header class="header">
    <div class="header-content">
        <h1 style="margin-top:9px; font-size:17px;">Bem-vindo, Aluno(a)!</h1>
        <div class="menu-icon" onclick="toggleSidebar()">&#9776;</div>
        <div class="profile">
            <a href="pagina-informacoes.php">
                <img src="<?php echo $foto_perfil; ?>" alt="Ícone de usuário" class="user-img" id="profileCircle">
            </a>
            <div class="tooltip" id="tooltip">
                <span>Nome: <?php echo $nome_aluno; ?></span><br> 
                <span>Email: <?php echo $email_aluno;  ?></span><br>
                <?php
                if (count($materias_salas) > 0) {
                    $sala_atual = $materias_salas[0]['sala_nome'];
                    echo "<span style='margin-left: 10px;'>Sala: " . htmlspecialchars($sala_atual) . "</span>";
                }
                ?>
            </div>
        </div>
    </div>
</header>

<aside class="sidebar" aria-label="Navegação do Aluno">
    <?php
    if (count($materias_salas) > 0) {
        $sala_atual = ''; 
        foreach ($materias_salas as $materia_sala) {
            if ($sala_atual !== $materia_sala['sala_nome']) {
                if ($sala_atual !== '') {
                    echo '</div>'; 
                }
                $sala_atual = $materia_sala['sala_nome'];
                echo '<div class="sala">';
                echo '<h2 style="margin-left: 10px;">' . htmlspecialchars($sala_atual) . '</h2>';  
                echo '<br>';
                echo '<hr style="margin: 18px 1%; color: #525252; width: 91%; border: 1px solid #525252 !important;">';
                echo '<br>';
                echo '<h2 style="margin-left: 10px;">Minhas Matérias</h2>';
                echo '<br>';
                echo '<button class="dropdown-btn">Materias</button>';
                echo '<div class="dropdown-container">';
            }
         
            echo '<a href="javascript:void(0);" class="materia" data-materia="' . $materia_sala['materia_id'] . '">' . htmlspecialchars($materia_sala['materia_nome']) . '</a>';
        }
        echo '</div>'; 
    } else {
        echo "<p style='color: #ffffff;'>Não há matérias associadas a esta sala.</p>";
    }
    ?>
   
    <a href="../php/logout.php" class="sair">
        <img src="../img/sair-icon.png" alt="Ícone de Sair" style="margin-left: -38px;">
        Sair
    </a>
</aside>


<div class="content" id="contentContainer" >
    <div id="atividadeContainer" ></div> <!-- atividades carregadas -->
</div>
<script src="../js/aluno.js"></script>
<script src="../js/barra-aluno-lateral-mob.js"></script>


</body>
</html>
