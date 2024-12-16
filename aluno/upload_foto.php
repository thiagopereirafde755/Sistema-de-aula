<?php
session_start(); 
require '../php/conexao.php'; 

if (isset($_FILES['profile_image'])) {
    $target_dir = "../fotos-perfil/"; 
    $file_name = basename($_FILES["profile_image"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

   
    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        // echo "Arquivo não é uma imagem.";
        echo "<script type='text/javascript'>
        alert('Arquivo não é uma imagem.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
        $uploadOk = 0;
    }

  
    if ($_FILES["profile_image"]["size"] > 5000000) {
        // echo "Desculpe, o arquivo é muito grande.";
        echo "<script type='text/javascript'>
        alert('Desculpe, o arquivo é muito grande.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        // echo "Desculpe, apenas arquivos JPG, JPEG, PNG são permitidos.";
        echo "<script type='text/javascript'>
        alert('Desculpe, apenas arquivos JPG, JPEG, PNG são permitidos.');
        window.location.href = 'pagina-informacoes.php'; 
      </script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $aluno_id = $_SESSION['aluno_id']; 
            $query = "UPDATE aluno SET foto_perfil = '$target_file' WHERE id = $aluno_id";
            mysqli_query($conexao, $query);
            echo "<script type='text/javascript'>
            alert('Foto alterada com sucesso.!');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
            // echo "O arquivo " . htmlspecialchars($file_name) . " foi enviado com sucesso.";
        } else {
            echo "<script type='text/javascript'>
            alert('Desculpe, ocorreu um erro ao fazer upload da imagem.');
            window.location.href = 'pagina-informacoes.php'; 
          </script>";
        }
    }
}
?>
