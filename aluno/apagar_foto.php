<?php
session_start();
require '../php/conexao.php';

if (!isset($_SESSION['aluno_id'])) {
    header("Location: pagina-informacoes.php");
    exit;
}

$aluno_id = $_SESSION['aluno_id'];

$query = "SELECT foto_perfil FROM aluno WHERE id = $aluno_id";
$result = mysqli_query($conexao, $query);
$aluno = mysqli_fetch_assoc($result);

if ($aluno && $aluno['foto_perfil']) {
    $foto_perfil = $aluno['foto_perfil'];

    if (file_exists($foto_perfil)) {
        unlink($foto_perfil);
    }

    $query = "UPDATE aluno SET foto_perfil = NULL WHERE id = $aluno_id";
    if (mysqli_query($conexao, $query)) {
        echo "<script type='text/javascript'>
            alert('Foto apagada com sucesso.');
            window.location.href = 'pagina-informacoes.php'; 
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Erro ao apagar a foto.');
            window.location.href = 'pagina-informacoes.php'; 
        </script>";
    }
} else {
    echo "<script type='text/javascript'>
        alert('Nenhuma foto de perfil encontrada.');
        window.location.href = 'pagina-informacoes.php'; 
    </script>";
}
?>
