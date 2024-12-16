<?php
session_start();
require '../php/conexao.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: pagina-informacoes.php");
    exit;
}

$professor_id = $_SESSION['professor_id'];

$query = "SELECT foto_perfil FROM professores WHERE id = $professor_id";
$result = mysqli_query($conexao, $query);
$professor = mysqli_fetch_assoc($result);

if ($professor && $professor['foto_perfil']) {
    $foto_perfil = $professor['foto_perfil'];

    if (file_exists($foto_perfil)) {
        unlink($foto_perfil);
    }

    $query = "UPDATE professores SET foto_perfil = NULL WHERE id = $professor_id";
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
