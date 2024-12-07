<?php
 require ('../../../php/conexao.php'); 
    $nome =  $_POST['nome']; 
    $senha =  $_POST['senha']; 


    $sql = "INSERT INTO adm (nome, senha) VALUES ('$nome', '$senha')";


    if (mysqli_query($conexao, $sql)) {
        echo "<script type='text/javascript'>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../../adm.php'; 
      </script>";
        // echo "Novo usuário inserido com sucesso!";
        // header("Location: ../adm.php");
    } else {
        echo "Erro: " . mysqli_error($conexao); 
    }

mysqli_close($conexao);
?>
