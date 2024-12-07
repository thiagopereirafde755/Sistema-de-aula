<?php 
session_start(); 
require 'logica.php';
require 'nome.php';
require '../php/conexao.php';


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da Conta</title>
    <link rel="stylesheet" href="../css/barra-rolagem.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/modal1.css">
</head>
<body>
<div class="voltar">
    <a href="pagina_professor.php">
        <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
    </a>
</div>

<main>
    <h3 style="color:black;">Informações da conta</h3>
    <h3>do professor</h3>
    <br>
    <span>Nome: <?php echo $nome_professor; ?></span><br>
    <span>Email: <?php echo $email_professor; ?></span><br>

   

    <br><br>
    <button class="botao" id="alterarSenhaBtn">Alterar senha</button>
<br><br>
    <button class="botao" id="ExcluirBtn">Excluir Conta</button>
</main>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3 style="text-align: center; justify-content: center;">Alterar Senha</h3>
        <form action="alterar-senha.php" method="post" class="tabela" style="text-align: center; justify-content: center;">
            <div class="a">
            <div class="input">
                <br>
                <div class="input">
                    <label for="email">Email:</label>
                    <input type="email" placeholder="email" class="input-caixa" name="email" required>
                </div>
                    <label for="senha-atual">Senha atual:</label>
                    <input type="password" placeholder="senha atual" class="input-caixa" name="senha-atual" required>
                </div>
                <div class="input">
                    <label for="nova-senha">Nova senha:</label>
                    <input type="password" placeholder="nova senha" class="input-caixa" name="nova-senha" required>
                </div>

                <div class="input">
            <label for="repetir-senha">Repetir nova senha:</label>
            <input type="password" placeholder="repetir nova senha" class="input-caixa" name="repetir-senha" required>
        </div>
    </div>
            <div class="entrar">
                <input type="submit" value="Adicionar" name="alterar_senha">
            </div>
            <br>
            <a href="../lib-prof/senha-recupera.php">Esqueceu a senha?</a>
        </form>
        
    </div>
    </div>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal2">&times;</span>
        <h3 style="text-align: center; justify-content: center;">Excluir Conta</h3>
        <form action="excluir-conta.php" method="post" class="tabela" style="text-align: center; justify-content: center;">
<br>
    <div class="input">
        <label for="email">Email:</label>
        <input type="email" placeholder="email" class="input-caixa" name="email" required>
    </div>
    <div class="input">
        <label for="senha">Senha:</label>
        <input type="password" placeholder="senha" class="input-caixa" name="senha" required>
    </div>
    <div class="entrar">
        <input type="submit" value="Excluir Conta" name="excluir_conta">
    </div>
</form>

    </div>
</div>

<footer class="creditos">
    <p style="color: rgb(0, 0, 0)">Desenvolvido por:Thiago Pereira</p>
</footer>



<script>
    // Modal Alterar Senha
    var modalSenha = document.getElementById("myModal");
    var btnSenha = document.getElementById("alterarSenhaBtn");
    var spanSenha = document.getElementById("closeModal");

    btnSenha.onclick = function() {
        modalSenha.style.display = "block";
    }
    spanSenha.onclick = function() {
        modalSenha.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modalSenha) {
            modalSenha.style.display = "none";
        }
    }

    // Modal Excluir Conta
    var modalExcluir = document.getElementById("myModal2");
    var btnExcluir = document.getElementById("ExcluirBtn");
    var spanExcluir = document.getElementById("closeModal2");

    btnExcluir.onclick = function() {
        modalExcluir.style.display = "block";
    }
    spanExcluir.onclick = function() {
        modalExcluir.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modalExcluir) {
            modalExcluir.style.display = "none";
        }
    }
</script>

</body>
</html>
