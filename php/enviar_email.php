<?php
header('Content-Type: text/html; charset=utf-8'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM aluno WHERE email='$email'";
    $result = mysqli_query($conexao, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Gera um código aleatório
        $codigo = rand(100000, 999999);

        // Salva a data e hora atual para a verificação do código
        $data_geracao_codigo = date('Y-m-d H:i:s');

        // Armazena o código e a data de geração no banco de dados
        $query = "UPDATE aluno SET codigo_recuperacao='$codigo', data_geracao_codigo='$data_geracao_codigo' WHERE email='$email'";
        mysqli_query($conexao, $query);

        // Configura o PHPMailer para enviar o código
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email do gmail vai aqui'; // email do gmail vai aqui
            $mail->Password = 'senha de app vai aqui'; //senha de app vai aqui
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->CharSet = 'UTF-8';
            $mail->setFrom('seuemail@gmail.com', 'Recuperação de Senha');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Código de Recuperação de Senha';
            $mail->Body    = "
                <html>
                    <body>
                        <p>Olá,</p>
                        <p>Recebemos uma solicitação para recuperar sua senha no sistema de aulas.</p>
                        <p>Para concluir o processo de recuperação, por favor, utilize o seguinte código de verificação:</p>
                        <h3><b>$codigo</b></h3>
                        <p>Este código é válido por 15 minutos. Caso não tenha solicitado a recuperação de senha, desconsidere este e-mail.</p>
                        <p>Atenciosamente,</p>
                        <p><b>Equipe do Sistema de Aulas</b></p>
                         <p><b>Desenvolvido por Thiago Pereira</b></p>
                    </body>
                </html>
            ";

            $mail->send();
            echo "<script type='text/javascript'>
            alert('O código de recuperação foi enviado ao seu email!.');
            window.location.href = '../lib/verificar-codigo.php'; 
          </script>";
            // echo 'O código de recuperação foi enviado ao seu email.';
            // header('Location: ../lib/verificar-codigo.php');
        } catch (Exception $e) {
            echo "Erro ao enviar email: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Email não encontrado!');
        window.location.href = '../lib/senha-recupera.php'; 
      </script>";
        // echo "Email não encontrado!";
    }
}

?>
