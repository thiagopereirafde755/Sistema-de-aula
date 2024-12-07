<?php 
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    session_start();
    $email = $_SESSION['email']; 

    $query = "SELECT codigo_recuperacao, data_geracao_codigo FROM aluno WHERE email='$email' AND codigo_recuperacao='$codigo'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $codigo_recuperacao = $row['codigo_recuperacao'];
        $data_geracao_codigo = $row['data_geracao_codigo'];

        if ($codigo == $codigo_recuperacao) {
            // Calcula a diferença entre a hora atual e a hora em que o código foi gerado
            $data_atual = date('Y-m-d H:i:s');
            $tempo_expiracao = strtotime($data_atual) - strtotime($data_geracao_codigo);

            if ($tempo_expiracao <= 900) { // 900 segundos = 15 minutos
                echo "<script type='text/javascript'>
                        alert('Código válido com sucesso!');
                        window.location.href = '../lib/alterar-senha.html'; 
                    </script>";
            } else {
                echo "<script type='text/javascript'>
                        alert('O código expirou. Solicite um novo código.');
                        window.location.href = '../lib/senha-recupera.php'; 
                    </script>";
            }
        } else {
            echo "<script type='text/javascript'>
                    alert('Código inválido!');
                    window.location.href = '../lib/verificar-codigo.php'; 
                </script>";
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Código inválido!');
                window.location.href = '../lib/verificar-codigo.php'; 
            </script>";
    }
}
?>
