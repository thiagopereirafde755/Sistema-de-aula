// Modal Alterar Senha
var modalSenha = document.getElementById("myModal");
var btnSenha = document.getElementById("alterarSenhaBtn");
var spanSenha = document.getElementById("closeModal");

// Modal Excluir Conta
var modalExcluir = document.getElementById("myModal2");
var btnExcluir = document.getElementById("ExcluirBtn");
var spanExcluir = document.getElementById("closeModal2");

// Modal Foto
var modalFoto = document.getElementById("myModal3");
var btnFoto = document.getElementById("fotoBtn");
var spanFoto = document.getElementById("closeModal3");

// Abrir modal
btnSenha.onclick = function() {
    modalSenha.style.display = "block";
}
btnExcluir.onclick = function() {
    modalExcluir.style.display = "block";
}
btnFoto.onclick = function() {
    modalFoto.style.display = "block";
}

// Fechar modal
spanSenha.onclick = function() {
    modalSenha.style.display = "none";
}
spanExcluir.onclick = function() {
    modalExcluir.style.display = "none";
}
spanFoto.onclick = function() {
    modalFoto.style.display = "none";
}

// Fechar modal ao clicar fora
window.onclick = function(event) {
    if (event.target == modalSenha) {
        modalSenha.style.display = "none";
    } else if (event.target == modalExcluir) {
        modalExcluir.style.display = "none";
    } else if (event.target == modalFoto) {
        modalFoto.style.display = "none";
    }
}