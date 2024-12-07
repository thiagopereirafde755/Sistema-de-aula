<?php 
require 'conexao.php';
require '../vendor/autoload.php'; 
header('Content-Type: text/html; charset=utf-8'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$turma = $_POST['turma'];

$link_verificacao = "http://localhost/SISTEMA/aluno/confirmacao.php?email=" . urlencode($email);

$sql_check_email = "SELECT * FROM aluno WHERE email = ?";
$stmt = mysqli_prepare($conexao, $sql_check_email);
mysqli_stmt_bind_param($stmt, 's', $email); 
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt); 

if (mysqli_stmt_num_rows($stmt) > 0) {
    echo "<script type='text/javascript'>
    alert('Este e-mail já está registrado. Tente outro.');
    window.location.href = '../cadastroalunor.php'; 
    </script>";
    exit(); 
}

// Gerar o hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$sql_aluno = "INSERT INTO aluno (nome, email, senha) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql_aluno);
mysqli_stmt_bind_param($stmt, 'sss', $nome, $email, $senha_hash);

if (mysqli_stmt_execute($stmt)) {
    $aluno_id = mysqli_insert_id($conexao); 

    $sql_salas = "INSERT INTO alunos_salas (aluno_id, salas_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexao, $sql_salas);
    mysqli_stmt_bind_param($stmt, 'ii', $aluno_id, $turma);
    mysqli_stmt_execute($stmt);

    $codigo_confirmacao = rand(100000, 999999); 

    $sql_codigo = "UPDATE aluno SET codigo_confirmacao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql_codigo);
    mysqli_stmt_bind_param($stmt, 'si', $codigo_confirmacao, $aluno_id);
    mysqli_stmt_execute($stmt);

    // Enviar email com PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sistemadeaula123@gmail.com';
        $mail->Password = 'iujs lzli qobs yunk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8';
        $mail->setFrom('seuemail@dominio.com', 'Confirmaçâo de conta');
        $mail->addAddress($email, $nome);
        $mail->isHTML(true);
        $mail->Subject = 'Verifique sua conta para concluir seu cadastro!';
        $mail->Body    = "
   <html>
    <body>
        <p>Olá, <strong>$nome</strong>,</p>
        <p>Obrigado por se cadastrar em nosso sistema de aulas!</p>
        <p>Para ativar sua conta e começar a aproveitar todos os nossos recursos, utilize o código de confirmação abaixo:</p>
        <h3><strong>$codigo_confirmacao</strong></h3>
        <p>Ou, se preferir, clique no link a seguir para verificaçâo de sua conta: <a href=\"$link_verificacao\">Verificar Conta</a></p>
        <p>Este código é válido por 15 minutos. Se você não solicitou a criação da conta, por favor, ignore este e-mail.</p>
        <p>Atenciosamente,</p>
        <p><strong>Equipe do Sistema de Aulas</strong></p>
        <p><em>Desenvolvido por Thiago Pereira</em></p>
    </body>
</html>
    ";        
        $mail->send();

        //pgn de confirmação
        echo "<script type='text/javascript'>
               alert('Cadastro realizado com sucesso! Verifique seu email para ter o código de confirmação.');
               window.location.href = '../aluno/confirmacao.php?email=$email'; 
              </script>";

    } catch (Exception $e) {
            echo "<script type='text/javascript'>
                    alert('Erro ao enviar o email: " . $mail->ErrorInfo . "');
                      window.location.href = '../cadastroalunor.php'; 
                  </script>";
    }

} else {
    echo "<script type='text/javascript'>
            alert('Erro ao cadastrar aluno: " . mysqli_error($conexao) . "');
            window.location.href = '../cadastroalunor.php'; 
          </script>";
}

mysqli_close($conexao);
?>
