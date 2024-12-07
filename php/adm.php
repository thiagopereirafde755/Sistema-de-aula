<?php
session_start();
require 'conexao.php';
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM adm WHERE nome = '$nome' AND senha = '$senha'";
$result = mysqli_query($conexao, $sql); 

if (mysqli_num_rows($result) > 0) {
    header("Location: ../adm/pagina_adm.php");
    exit;
} else {
    echo "<script type='text/javascript'>
    alert('Usuario ou senha inválidos.!');
    window.location.href = '../login-adm.html'; 
  </script>";
    // echo "Usuario ou senha inválidos.";
}
?>



