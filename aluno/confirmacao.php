<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <title>Confirmação de Código</title>
</head>
<body>
    <div class="voltar">
        <a href="../login-aluno.html">
            <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>

    <style>
        body { background-color: #ECEBF3 }
        main {
            width: 300px;
            border-radius: 15px;
            background-color: #ffffff;
            text-align: center;
            margin: auto;
            padding: 20px;
        }
    </style>

    <main>
        <h3>Confirmação de Cadastro</h3>
        <h3>Aluno</h3>
        <form method="post" action="../php/verificar_codigo2.php">
            <div class="a">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>" required>
                <div class="input">
                    <input type="text" name="codigo" placeholder="Digite o código" class="input-caixa" required>
                </div>
            </div>
            <div class="entrar">
                <input type="submit" value="Confirmar">
            </div>
        </form>
    </main>
    
    <footer class="creditos">
        <p style="color: rgb(0, 0, 0)">Desenvolvido por: Thiago Pereira</p>
    </footer>
</body>
</html>
