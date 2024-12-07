<?php
session_start();
require '../php/conexao.php';
if (!isset($_SESSION['professor_id'])) {
    header("Location: login-professor.html"); 
}

$professor_id = $_SESSION['professor_id'];
$materia_id = $_POST['materia_id']; 
$descricao = $_POST['descricao'];
$link = $_POST['link'] ?? null;
$arquivo = null;

// Verifica se um arquivo foi enviado e se não houve erro
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    // Diretório onde o arquivo será armazenado
    $diretorio = '../uploads/';

    // Verifica se o diretório existe
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0755, true);  // Cria o diretório caso não exista
    }

    // Gerando um nome único para o arquivo
    $nome_arquivo = uniqid() . '-' . basename($_FILES['arquivo']['name']);
    $caminho_arquivo = $diretorio . $nome_arquivo;

    // Verifica o tipo de arquivo e se ele é permitido
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
    $extensoes_permitidas = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt'];

    if (!in_array(strtolower($extensao), $extensoes_permitidas)) {
        echo "Erro: Apenas arquivos PDF, DOC, DOCX, PPT, PPTX ou TXT são permitidos.";
        exit;
    }

    // Mover o arquivo para o diretório de uploads
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
        $arquivo = $caminho_arquivo; 
    } else {
        echo "Erro ao mover o arquivo para o diretório de uploads.";
        exit;
    }
}

$sql = "
    INSERT INTO atividades (professor_id, materia_id, descricao, link, arquivo)
    VALUES ('$professor_id', '$materia_id', '$descricao', '$link', '$arquivo')
";

if (mysqli_query($conexao, $sql)) {
    $atividade_id = mysqli_insert_id($conexao); 

    // Salvar a associação entre a atividade e as salas
    if (isset($_POST['salas']) && is_array($_POST['salas'])) {
        foreach ($_POST['salas'] as $sala_id) {
            $sql_salas = "
                INSERT INTO atividades_salas (atividade_id, sala_id)
                VALUES ('$atividade_id', '$sala_id')
            ";
            mysqli_query($conexao, $sql_salas);
        }
    }

    echo "<script type='text/javascript'>
    alert('Salvo com sucesso!');
    window.location.href = 'pagina_professor.php'; 
  </script>";
    exit;
} else {
    echo "Erro ao salvar atividade: " . mysqli_error($conexao);
    exit;
}
?>

