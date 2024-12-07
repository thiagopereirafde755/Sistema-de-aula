<?php 
session_start(); 
require 'logica.php'; 
require 'nome-sala.php';
require 'nome-aluno.php';


$materias_salas = [];
while ($row = mysqli_fetch_assoc($resultado_materias_salas)) {
    $materias_salas[] = $row; 
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Aluno</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/stylealuno1.css">
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
        </style>
<header class="header">
    <div class="header-content">
        <h1 style="margin-top:9px;">Bem-vindo, Aluno!</h1>
        <div class="profile">
        <a href="pagina-informacoes.php">
            <img src="../img/user.png" alt="Ícone de usuário" class="user-img" id="profileCircle">
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
                echo '<h2 style="margin-left: 10px;">Minhas Matérias</h2>';
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
   
    <a href="../index.html" class="sair">
        <img src="../img/sair-icon.png" alt="Ícone de Sair">
        Sair
    </a>
</aside>

<div class="content">
    <div id="atividadeContainer"> </div> <!-- atividades carregadas -->
</div>

<script src="../js/aluno1.js"></script>

</body>
</html>
