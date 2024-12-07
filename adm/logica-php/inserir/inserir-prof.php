<?php
require ('../../../php/conexao.php'); 

$nome = $_POST['nome']; 
$senha = $_POST['senha']; 
$email = $_POST['email'];
$senha_hash = password_hash($senha, PASSWORD_DEFAULT); 
$sql_check = "SELECT * FROM professores WHERE email = '$email'";
$result = mysqli_query($conexao, $sql_check);

if (mysqli_num_rows($result) > 0) {
    echo "<script type='text/javascript'>
            alert('Erro: O email já está cadastrado.');
            window.location.href = '../../professor.php'; 
          </script>";
} else {
    $sql = "INSERT INTO professores (nome, email, senha) VALUES ('$nome','$email', '$senha_hash')";

    if (mysqli_query($conexao, $sql)) {
       echo "<script type='text/javascript'>
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../../professor.php'; 
              </script>";
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }
}

mysqli_close($conexao);
?>
