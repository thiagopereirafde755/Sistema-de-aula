<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <title>Recuperar Senha</title>
</head>
<body>
<div class="voltar">
        <a href="javascript:history.back();">
            <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>
   
<style>body{background-color:#ECEBF3}
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
    <h2>Recuperar Senha</h2>
    <h2>Professor</h2>
    <form method="post" action="enviar_email.php">
    <div class="a">
                <div class="input">
                    <input type="email" placeholder="Digite seu email" class="input-caixa" name="email" required>                    
                    <img src="../img/mail.png" alt="Ícone de usuário">
                </div>
            </div>
        <div class="entrar">
        <br>     
        <input type="submit" value="Solicitar Codigo">
            </div>
    </form>
</main>
<footer class="creditos">
        <p style="color: rgb(0, 0, 0)">Desenvolvido por:Thiago Pereira </p>
    </footer>
</body>
</html>
