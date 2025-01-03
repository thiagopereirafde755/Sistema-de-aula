

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/style-mobile.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <title>Verificar Código</title>
</head>
<body>
    <div class="voltar">
        <a href="senha-recupera.php">
            <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>
    <main>
        <h3>Digite o código enviado para seu email</h3>
        <form method="post" action="codigo.php">
            <div class="a">
                <div class="input">
                    <input type="text" placeholder="Código de Verificação" class="input-caixa" name="codigo" required pattern="\d{6}" title="O código deve ter 6 dígitos numéricos.">                    
                    <img src="../img/marca-de-verificacao.png" alt="Ícone de usuário">
                </div>
            </div>
            <div class="entrar">
                <br>     
                <input type="submit" value="Verificar Código">
            </div>
        </form>
    </main>

    <footer class="creditos">
        <p>Desenvolvido por: Thiago Pereira</p>
    </footer>
</body>
</html>

