<?php
header('Content-Type: text/html; charset=utf-8'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../php/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $query = "SELECT * FROM professores WHERE email='$email'";
    $result = mysqli_query($conexao, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Pega os dados do professor
        $professor = mysqli_fetch_assoc($result);
        $nome = $professor['nome']; 

        // Gera um código aleatório
        $codigo = rand(100000, 999999);

        // Salva a data e hora atual para a verificação do código
        $data_geracao_codigo = date('Y-m-d H:i:s');

        $query = "UPDATE professores SET codigo_recuperacao='$codigo', data_geracao_codigo='$data_geracao_codigo' WHERE email='$email'";
        mysqli_query($conexao, $query);
       
        session_start();
        $_SESSION['email'] = $email;  
        
        // Configura o PHPMailer para enviar o código
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
            $mail->setFrom('seuemail@gmail.com', 'Recuperação de Senha');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Código de Recuperação de Senha';
            $mail->Body    = "
                <html>
                    <body>
                        <p>Olá, Professor <strong>$nome</strong>,</p>
                        <p>Recebemos uma solicitação para recuperar sua senha do professor no sistema de aulas.</p>
                        <p>Para concluir o processo de recuperação, por favor, utilize o seguinte código de verificação:</p>
                        <h3><b>$codigo</b></h3>
                        <p>Este código é válido por 15 minutos. Caso não tenha solicitado a recuperação de senha, desconsidere este e-mail.</p>
                        <p>Atenciosamente,</p>
                        <p><b>Equipe do Sistema de Aulas</b></p>
                         <p><em>Desenvolvido por Thiago Pereira</em></p>
                    </body>
                </html>
            ";

            $mail->send();
            echo "<script type='text/javascript'>
            alert('O código de recuperação foi enviado ao seu email!.');
            window.location.href = 'verificar_codigo.php'; 
          </script>";
        }   catch (Exception $e) {
            echo "<script type='text/javascript'>
                    alert('Erro ao enviar email: " . $mail->ErrorInfo . "');
                    window.location.href = 'senha-recupera.php'; 
                  </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        alert('Email não encontrado!');
        window.location.href = 'senha-recupera.php'; 
      </script>";
    }
}
?>
