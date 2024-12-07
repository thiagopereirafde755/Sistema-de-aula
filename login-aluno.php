<?php
require 'php/excluir_registros.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/barra-rolagem.css">
    <title>login-aluno</title>
</head>
<body>
    <div class="voltar">
        <a href="index.html">
            <img src="img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>
   
    <main style="margin-bottom: 23px;">
        <h1>Entrar</h1>
        <form method="post" action="php/login-aluno.php">
            <div class="a">
                <div class="input">
                    <input type="email" placeholder="email" class="input-caixa" name="email" required>                    
                    <img src="img/mail.png" alt="Ícone de usuário">
                </div>
                <div class="input">
                    <input type="password" placeholder="Senha" class="input-caixa" name="senha" required>
                    <img src="img/senha.png" alt="Ícone de senha">
               
            </div>
            <div class="entrar">
                <input type="submit" value="Entrar">
            </div>
            <br>
            <a href="lib/senha-recupera.php" >Esqueceu a senha?</a>
        </form>
       
    </main>
<main style="margin-top: 1px;">
      <p>Não tem uma conta?  <a href="cadastroalunor.php"> Cadastre-se</a></p>
    </main>
    <footer class="creditos">
        <p style="color: rgb(0, 0, 0)">Desenvolvido por:Thiago Pereira </p>
    </footer>
</body>
</html>
