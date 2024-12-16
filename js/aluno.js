document.addEventListener('DOMContentLoaded', function () {
    const materias = document.querySelectorAll('.materia');
    const atividadeContainer = document.getElementById('atividadeContainer');

    function carregarAtividades(materiaId) {
        atividadeContainer.innerHTML = '';

        fetch('atividades.php?materia_id=' + materiaId)
        .then(response => response.json())
        .then(atividades => {
            if (atividades.error) {
                // Exibe o nome da matéria junto com a mensagem de erro
                atividadeContainer.innerHTML = 'Nenhuma atividade encontrada para a matéria: ' + atividades.materia_nome + '.';
            } else if (atividades.length > 0) {
                atividades.forEach(atividade => {
                    const divAtividade = document.createElement('div');
                    divAtividade.classList.add('atividade');
                    const professor = document.createElement('p');
                    professor.textContent = 'Professor: ' + atividade.professor;
                    divAtividade.appendChild(professor);
                    
                    const materia = document.createElement('p');
                    materia.textContent = 'Matéria: ' + atividade.materia;
                    divAtividade.appendChild(materia);
    
                    const descricao = document.createElement('p');
                    descricao.textContent = 'Descrição: ' + atividade.descricao;
                    divAtividade.appendChild(descricao);
    
                    if (atividade.link) {
                        const link = document.createElement('a');
                        link.href = atividade.link;
                        link.textContent = 'Acessar Link';
                        link.target = '_blank';
                        link.style.display = 'block';
                        link.style.marginTop = '7px';
                        divAtividade.appendChild(link);
                    }
    
                    if (atividade.arquivo) {
                        const arquivo = document.createElement('a');
                        arquivo.href = '../uploads/' + atividade.arquivo;
                        arquivo.textContent = 'Baixar Arquivo';
                        arquivo.target = '_blank';
                        arquivo.style.display = 'block';
                        arquivo.style.marginTop = '7px';
                        divAtividade.appendChild(arquivo);
                    }
    
                    const data_envio = document.createElement('a');
                    data_envio.textContent = 'Data de Envio: ' + atividade.data_envio;
                    data_envio.style.display = 'block';
                    data_envio.style.marginTop = '5px';
                    divAtividade.appendChild(data_envio);
    
                    atividadeContainer.appendChild(divAtividade);
                });
            } else {
                atividadeContainer.innerHTML = 'Nenhuma atividade encontrada para esta matéria.';
            }
        })
        .catch(error => console.error('Erro ao carregar atividades:', error));
    }    
    // Ao clicar em uma matéria, carrega as atividades dessa matéria
    materias.forEach(function (materia) {
        materia.addEventListener('click', function () {
            const materiaId = this.getAttribute('data-materia');
            carregarAtividades(materiaId); // Carrega as atividades para a matéria selecionada
        });
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
document.addEventListener('DOMContentLoaded', function() {
    var dropdownBtn = document.querySelectorAll('.dropdown-btn');
    dropdownBtn.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var dropdownContent = btn.nextElementSibling;
            dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
        });
    });
});