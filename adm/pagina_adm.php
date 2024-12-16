<?php
session_start(); 


if (!isset($_SESSION['adm_id'])) {
    header("Location: ../login-adm.html"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina administrações</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
</head>
<body>
<div class="voltar">
        <a href="../index.html">
            <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>
    <main>
        <h1>Tabelas</h1>
        <a href="adm.php" class="botao">adm</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="aluno.php" class="botao">Aluno</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="aluno-sala.php" class="botao">Alunos e Salas</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="materias.php" class="botao">Materias</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="professor.php" class="botao">Professores</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="prof-materia.php" class="botao">Professores e materias</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="prof-sala.php" class="botao">Professores e salas</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="salas.php" class="botao">Salas</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="sala-materia.php" class="botao">Salas e materias</a>
        <hr style="margin: 20px 0; color: black;">
        <a href="../php/logout.php" class="botao">Sair</a>
    </main>
    <footer class="creditos">
        <p style="color: rgb(14, 14, 14)">Desenvolvido por:Thiago Pereira </p>
    </footer>
</body>
</html>
