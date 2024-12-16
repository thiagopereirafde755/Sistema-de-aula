<?php
session_start(); 
require 'conexao.php';

$nome = $_POST['nome'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM adm WHERE nome = '$nome' AND senha = '$senha'";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) > 0) {
    $adm = mysqli_fetch_assoc($result);
    $_SESSION['adm_id'] = $adm['id']; 

    header("Location: ../adm/pagina_adm.php");
    exit;
} else {
    echo "<script type='text/javascript'>
    alert('Usuário ou senha inválidos!');
    window.location.href = '../login-adm.html'; 
    </script>";
}
?>
