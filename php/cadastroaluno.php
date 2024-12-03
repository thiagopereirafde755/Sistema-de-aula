<?php
require 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$turma = $_POST['turma'];

// Verificar se o e-mail já está registrado
$sql_check_email = "SELECT * FROM aluno WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql_check_email);
mysqli_stmt_bind_param($stmt, 's', $email); 
mysqli_stmt_execute($stmt);
$resultado_check_email = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado_check_email) > 0) {
    echo "<script type='text/javascript'>
    alert('Este e-mail já está registrado. Tente outro.');
    window.location.href = '../cadastroalunor.php'; 
  </script>";
    // die("Este e-mail já está registrado. Tente outro.");
}
$sql_aluno = "INSERT INTO aluno (nome, email, senha) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql_aluno);
mysqli_stmt_bind_param($stmt, 'sss', $nome, $email, $senha); 

if (mysqli_stmt_execute($stmt)) {
    $aluno_id = mysqli_insert_id($conexao); 

   
    $sql_salas = "INSERT INTO alunos_salas (aluno_id, salas_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_salas);
    mysqli_stmt_bind_param($stmt, 'ii', $aluno_id, $turma); 
    
    if (mysqli_stmt_execute($stmt)) {
       
        echo "<script type='text/javascript'>
                alert('Cadastro realizado com sucesso!');
                window.location.href = '../login-aluno.html'; // Redireciona para a página de login
              </script>";
    } else {
        echo "Erro ao associar o aluno à turma: " . mysqli_error($conexao);
    }
} else {
    echo "Erro ao cadastrar aluno: " . mysqli_error($conexao);
}
mysqli_close($conexao);
?>
