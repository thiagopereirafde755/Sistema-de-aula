document.addEventListener('DOMContentLoaded', function () {
    const materias = document.querySelectorAll('.materia');
    const salasDiv = document.getElementById('salas'); 
    const atividadeForm = document.getElementById('atividadeForm');
    const materiaAtivaDiv = document.getElementById('materiaAtiva');
    const contentDiv = document.getElementById('content'); 
    contentDiv.style.display = 'none';  
    atividadeForm.style.display = 'none';  

    materias.forEach(function (materia) {
        materia.addEventListener('click', function () {
            const materiaId = this.getAttribute('data-materia');
            
            // Exibe o nome da matéria ativa
            materiaAtivaDiv.textContent = 'Matéria: ' + this.textContent;

            // Exibe o conteúdo e o formulário quando uma matéria for clicada
            contentDiv.style.display = 'block';  // Torna visível o conteúdo
            atividadeForm.style.display = 'block';  // Torna visível o formulário

            // Define o ID da matéria no formulário
            document.getElementById('materia_id').value = materiaId;

            // Chama a função para carregar as salas da matéria
            carregarSalas(materiaId);
        });
    });

    function carregarSalas(materiaId) {
        salasDiv.innerHTML = ''; 

        // Faz a requisição para pegar as salas dessa matéria
        fetch('salas.php?materia_id=' + materiaId)
            .then(response => response.json())
            .then(salas => {
                if (salas.length > 0) {
                    salas.forEach(sala => {
                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.id = 'sala_' + sala.id;
                        checkbox.name = 'salas[]';  // Permite enviar múltiplas salas
                        checkbox.value = sala.id;

                        const label = document.createElement('label');
                        label.setAttribute('for', checkbox.id);
                        label.textContent = sala.nome;

                        salasDiv.appendChild(checkbox);
                        salasDiv.appendChild(label);
                        salasDiv.appendChild(document.createElement('br'));
                    });
                } else {
                    salasDiv.innerHTML = '<p>Nenhuma sala encontrada.</p>';
                }
            });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    var dropdownBtn = document.querySelector('.dropdown-btn');
    dropdownBtn.addEventListener('click', function() {
        var dropdownContent = dropdownBtn.nextElementSibling;
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
});
document.getElementById('profileCircle').addEventListener('mouseenter', function() {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'block'; 
});

document.getElementById('profileCircle').addEventListener('mouseleave', function() {
    var tooltip = document.getElementById('tooltip');
    tooltip.style.display = 'none'; 
});