<?php
require ('../../../php/conexao.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conexao, $_POST['id']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    if (!empty($id) && !empty($nome) && !empty($email) && !empty($senha)) {
        $sql = "UPDATE professores SET nome='$nome', email='$email', senha='$senha' WHERE id='$id'";
        if (mysqli_query($conexao, $sql)) {
            echo "<script>alert('Professor atualizado com sucesso!'); window.location.href='../../professor.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar professor: " . mysqli_error($conexao) . "'); window.location.href='../../professor.php';</script>";
        }
    } else {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.location.href='../../professor.php';</script>";
    }
}
mysqli_close($conexao);
?>
