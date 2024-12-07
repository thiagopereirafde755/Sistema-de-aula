<?php
require 'conexao.php';

$email = $_POST['email'];
$codigo = $_POST['codigo'];
$tempo_limite = 15; 

$sql = "SELECT data_registro FROM aluno WHERE email = ? AND codigo_confirmacao = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'ss', $email, $codigo);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_bind_result($stmt, $data_registro);
    mysqli_stmt_fetch($stmt);  

    mysqli_stmt_close($stmt);

    // Agora, procedemos com o cálculo do tempo
    $sql_tempo = "SELECT TIMESTAMPDIFF(MINUTE, ?, NOW())";
    $stmt_tempo = mysqli_prepare($conexao, $sql_tempo);
    mysqli_stmt_bind_param($stmt_tempo, 's', $data_registro);
    mysqli_stmt_execute($stmt_tempo);
    mysqli_stmt_bind_result($stmt_tempo, $tempo_passado);
    mysqli_stmt_fetch($stmt_tempo);
    mysqli_stmt_close($stmt_tempo); 

    if ($tempo_passado <= $tempo_limite) {
        $sql_update = "UPDATE aluno SET confirmado = 1 WHERE email = ?";
        $stmt_update = mysqli_prepare($conexao, $sql_update);
        mysqli_stmt_bind_param($stmt_update, 's', $email);
        mysqli_stmt_execute($stmt_update);

        echo "<script type='text/javascript'>
                alert('Confirmação bem-sucedida! Agora você pode acessar sua conta.');
                window.location.href = '../login-aluno.php'; 
              </script>";
    } else {
        // código expirado
        echo "<script type='text/javascript'>
                alert('Código expirado! Realize um novo cadastro.');
                window.location.href = '../cadastroalunor.php'; 
              </script>";
    }
} else {
    // código incorreto
    echo "<script type='text/javascript'>
            alert('Código incorreto! Verifique seu email e tente novamente.');
            window.location.href = '../aluno/confirmacao.php?email=$email'; 
          </script>";
}

mysqli_close($conexao);
?>
