<?php
 //  $conexao = mysqli_connect("localhost", "root", "", "sisteam_de_aula", 3316); // O loguin, senha, nome da base e a porta
   $conexao = mysqli_connect("localhost", "root", "");
if ($conexao) {
   $db = mysqli_select_db($conexao, "sisteam_de_aula"); 

}
?>

