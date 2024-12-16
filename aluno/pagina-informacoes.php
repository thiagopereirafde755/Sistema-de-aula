<?php 
session_start(); 
require 'logica.php'; 
require 'nome-sala.php'; 
require 'nome-aluno.php'; 
require '../php/conexao.php';

$diretorio_uploads = '../uploads/';

$query = "SELECT foto_perfil FROM aluno WHERE id = " . $_SESSION['aluno_id'];
$resultado = mysqli_query($conexao, $query);
$aluno = mysqli_fetch_assoc($resultado);

$foto_perfil = $diretorio_uploads . $aluno['foto_perfil'];

if (!$aluno['foto_perfil'] || !file_exists($foto_perfil)) {

    $foto_perfil = '../img/user.png';
    $tem_foto = false; 
} else {
    $tem_foto = true; 
}

$materias_salas = [];
while ($row = mysqli_fetch_assoc($resultado_materias_salas)) {
    $materias_salas[] = $row; 
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da Conta</title>
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/barra-rolagem.css">
     <link rel="stylesheet" href="../css/modal.css"> 
    <link rel="stylesheet" href="../css/info-foto.css">
    <link rel="stylesheet" href="../css/pgn-infor-mob.css">
    <link rel="stylesheet" href="../css/style-mobile.css">
    
</head>
<body>
<!-- body, main, creditos, voltar img -->
<style>
* {
    font-family: sans-serif;
    box-sizing: border-box; 
}
body {
    background-color:#ECEBF3;
    display: flex;
    flex-direction: column;
    min-height: 100vh; 
}
        main {
    width: 300px;
    border-radius: 15px;
    background-color: #ffffff;
    text-align: center;
    margin: auto; 
    padding: 20px; 
}


.creditos {
    text-align: center;
    padding: 10px;
}
.voltar img {
    margin: 20px;
    width: 55px;
    height: 55px;

}
.volta-icon {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    width: 40px;
    height: auto;
    margin-left: 10px;
    margin-top: 5px;
}

.volta-icon:hover {
    transform: scale(1.5);
}
   </style>





<!-- botao de voltar a pagina -->
<div class="voltar">
    <a href="pagina_aluno.php">
        <img src="../img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
    </a>
</div>

<!-- onde fica as informacoes -->
<main>
    <h4 >Informações da conta do aluno(a)</h4>
    <div class="foto-container">
    <img src="<?php echo $foto_perfil; ?>" alt="Ícone de usuário"  class="user-img">
    <div class="fundo-transparente"></div>
    <img src="../img/edit6-image.png" alt="Editar" id="fotoBtn" class="editar-img">
</div>
   <br><br>
   <span>Nome: <b><?php echo $nome_aluno; ?></b></span><br>
<span>Email: <b><?php echo $email_aluno; ?></b></span><br>

<?php
if (count($materias_salas) > 0) {
    $sala_atual = $materias_salas[0]['sala_nome'];
    echo "<span style='margin-left: 10px;'>Sala: <b>" . htmlspecialchars($sala_atual) . "</b></span>";
} else {
    echo "<span style='color:red;'>Nenhuma sala associada.</span>";
}
?>


<hr style="margin: 20px 0; color: black;">
    <button class="botao" id="alterarSenhaBtn">Alterar senha</button>
    <hr style="margin: 20px 0; color: black;">
    <button class="botao" id="ExcluirBtn">Excluir Conta</button>
    <hr style="margin: 20px 0; color: black;">
</main>

<!-- modal de foto de perfil -->
<div id="myModal3" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal3">&times;</span>
        <h3 style="text-align: center; justify-content: center;">Atualizar Foto de Perfil</h3>
        <hr style="margin: 20px 0; color: black;">

        <!-- Form para carregar foto -->
        <form action="upload_foto.php" method="POST" enctype="multipart/form-data" id="uploadForm">
            <label for="file" class="botao2">Carregar Foto</label>
            <input type="file" name="profile_image" id="file" required style="display: none;">
        </form>

        <hr style="margin: 20px 0; color: black;">

        <!-- form para remover -->
        <?php if ($tem_foto): ?>
        <form action="apagar_foto.php" method="POST" onsubmit="return confirmDelete()">
            <button type="submit" class="botao2">Remover foto atual</button>
        </form>
        <hr style="margin: 20px 0; color: black;">
        <?php endif; ?>
        
    </div>
</div>

<!-- Modal de alterar senha -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h3 style="text-align: center; justify-content: center;">Alterar Senha</h3>
        <form action="alterar-senha.php" method="post" class="tabela" style="text-align: center; justify-content: center;">
            <div class="a">
            <div class="input">
                <br>
                <div class="input">
                  
                    <input type="email" placeholder="email" class="input-caixa" name="email" required>
                    <img src="../img/mail.png" alt="Ícone de usuário">
                </div>
                <div class="input">
                    <input type="password" placeholder="senha atual" class="input-caixa" name="senha-atual" required>
                
                    <img src="../img/senha.png" alt="Ícone de senha">
                </div>
                <div class="input">
                    <input type="password" placeholder="nova senha" class="input-caixa" name="nova-senha" required>
                    <img src="../img/senha.png" alt="Ícone de senha">
                </div>

                <div class="input">
            <input type="password" placeholder="repetir nova senha" class="input-caixa" name="repetir-senha" required>
            <img src="../img/senha.png" alt="Ícone de senha">
        </div>
    </div>
                <button type="submit"  class="botao2" name="alterar_senha">Alterar</button>
             <br><br>
        <a href="../lib/senha-recupera.php" >Esqueceu a senha?</a>
        </form>
        <br>
       
    </div>
    </div>
</div>

<!-- Modal de excluir conta -->
<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal2">&times;</span>
        <h3 style="text-align: center; justify-content: center;">Excluir Conta</h3>
        <form action="excluir-conta.php" method="post" class="tabela" style="text-align: center; justify-content: center;">
<br>
<div class="a">
    <div class="input">
        <input type="email" placeholder="email" class="input-caixa" name="email" required>
        <img src="../img/mail.png" alt="Ícone de usuário">
    </div>
    <div class="input">
        <input type="password" placeholder="senha" class="input-caixa" name="senha" required>
        <img src="../img/senha.png" alt="Ícone de senha">
    </div>
        </div>
        <button type="submit" style="   width: 
    70%; " class="botao2" name="excluir_conta">Excluir</button>
</form>

    </div>
</div>

<!-- confirma que vai excluir a foto -->
<script>
    function confirmDelete() {
        return confirm('Você tem certeza que deseja remover a foto atual?');
    }
</script>

<!-- enviar foto sem submit -->
<script>
    document.getElementById('file').addEventListener('change', function() {
        document.getElementById('uploadForm').submit();
    });
</script>

<!-- rodape -->
<footer class="creditos">
    <p style="color: rgb(0, 0, 0)">Desenvolvido por: Thiago Pereira</p>
</footer>

<!-- pagina js com modais -->
<script src="../js/modal-info.js"></script>
</body>
</html>
