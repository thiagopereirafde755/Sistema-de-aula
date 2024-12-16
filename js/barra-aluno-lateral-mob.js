// Função para alternar a visibilidade da barra lateral
function toggleSidebar() {
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active'); 
}

// Função para fechar a barra lateral ao clicar fora dela
document.addEventListener('click', function(event) {
    var sidebar = document.querySelector('.sidebar');
    var menuIcon = document.querySelector('.menu-icon');
    
    // Verifica se o clique não ocorreu dentro do aside nem no ícone do menu
    if (!sidebar.contains(event.target) && !menuIcon.contains(event.target)) {
        sidebar.classList.remove('active'); 
    }
});

// Função para fechar a barra lateral quando uma matéria for clicada
document.querySelectorAll('.materia').forEach(function(materia) {
    materia.addEventListener('click', function() {
        var sidebar = document.querySelector('.sidebar');
        sidebar.classList.remove('active');
    });
});
