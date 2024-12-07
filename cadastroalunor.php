<?php
require 'php/excluir_registros.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/barra-rolagem.css">
    <title>Cadastro-aluno</title>
</head>
<body>
    <div class="voltar">
        <a href="login-aluno.html">
            <img src="img/botao-voltar1.png" alt="Botão voltar" class="volta-icon">
        </a>
    </div>
    
    <main>
        <h1>Cadastrar</h1>
        <form method="post" action="php/cadastroaluno.php">
            <div class="a">
                <div class="input">
                    <input type="text" placeholder="Usuário" class="input-caixa" name="nome" required>
                    <img src="img/user.png" alt="Ícone de usuário">
                </div>
                <div class="input">
                    <input type="email" placeholder="email" class="input-caixa" name="email" required>
                    <img src="img/mail.png" alt="Ícone de usuário">
                </div>
                <div class="input">
                    <input type="password" placeholder="Senha" class="input-caixa" name="senha" required>
                    <img src="img/senha.png" alt="Ícone de senha">
                </div>
                <div class="input">
                    <label for="turma">Escolha sua turma:</label>
                    <select name="turma" class="input-caixa" required>
                        <option value="" disabled selected>Selecione...</option>
                        <?php
                       
                       require 'php/conexao.php';
                        $sql = "SELECT id, nome FROM salas";
                        $resultado = mysqli_query($conexao, $sql);

                        if (mysqli_num_rows($resultado) > 0) {
                            while($row = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                        } else {
                            echo "<option value='' disabled>Nenhuma turma encontrada</option>";
                        }

                        mysqli_close($conexao);
                        ?>
                    </select>
                </div>
            </div>
            <div class="entrar">
                <input type="submit" value="Cadastrar">
            </div>
        </form>
        <div class="cadastro">
            <p>Já tem uma conta? <a href="login-aluno.html">Entrar</a></p>
        </div>
    </main>
    <footer class="creditos">
        <p style="color: rgb(14, 14, 14)">Desenvolvido por:Thiago Pereira</p>
    </footer>
</body>
</html>
