<?php 
include '../php/conexao.php';

session_start(); 
if (!isset($_SESSION['email'])) {
    echo "<script type='text/javascript'>
            alert('Sessão expirada. Por favor, solicite o código novamente.');
            window.location.href = 'senha-recupera.php'; 
          </script>";
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $email_professor = $_SESSION['email'];

    // Verifica o código de recuperação para o professor com o email específico
    $query = "SELECT codigo_recuperacao, data_geracao_codigo FROM professores WHERE email='$email_professor' AND codigo_recuperacao='$codigo'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $codigo_recuperacao = $row['codigo_recuperacao'];
        $data_geracao_codigo = $row['data_geracao_codigo'];

        // Verifica se o código é válido e se ainda não expirou (15 minutos)
        $data_atual = date('Y-m-d H:i:s');
        $tempo_expiracao = strtotime($data_atual) - strtotime($data_geracao_codigo);

        if ($tempo_expiracao <= 900) { // 900 segundos = 15 minutos
            echo "<script type='text/javascript'>
                    alert('Código válido com sucesso!');
                    window.location.href = 'alterar-senha.html'; 
                  </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('O código expirou. Solicite um novo código.');
                    window.location.href = 'senha-recupera.php'; 
                  </script>";
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Código inválido!');
                window.location.href = 'verificar_codigo.php'; 
              </script>";
    }
}
?>
