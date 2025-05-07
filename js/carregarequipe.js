// Inicializa o array da equipe
let equipe = [];

// Função para carregar os dados da equipe a partir do JSON
async function carregarDadosEquipe() {
    try {
        const resposta = await fetch("src/equipe.json"); // Caminho do JSON
        if (!resposta.ok) {
            throw new Error(`Erro ao carregar equipe.json: ${resposta.status}`);
        }
        equipe = await resposta.json(); // Armazena os dados no array 'equipe'
        console.log("Dados da equipe carregados com sucesso:", equipe);
    } catch (error) {
        console.error("Erro ao carregar os dados da equipe:", error);
    }
}

// Função para carregar os profissionais de uma especialidade
function carregarEquipeFiltrado(nomeEspecialidade) {
    console.log("Carregando equipe para a especialidade:", nomeEspecialidade);

    const equipeDiv = document.getElementById("equipeFilter");

    if (!equipeDiv) {
        console.error("Div de equipe não encontrada!");
        return;
    }

    equipeDiv.innerHTML = ""; // Limpa o conteúdo anterior

    // Filtra os profissionais com base na especialidade
    const profissionaisFiltrados = equipe.filter(profissional => profissional.area === nomeEspecialidade);

    console.log("Profissionais filtrados:", profissionaisFiltrados);

    if (profissionaisFiltrados.length === 0) {
        equipeDiv.innerHTML = "<p>Nenhum profissional encontrado para esta especialidade.</p>";
        return;
    }

    // Adiciona os cards dos profissionais filtrados
    profissionaisFiltrados.forEach(profissional => {
        const profissionalCard = `
            <div class="equipe-card">
                <img class="testefotoarredondada" src="src/img/perfis/${profissional.imagem}" alt="Foto de ${profissional.nome}" width="100%">
                <h3>${profissional.nome.toUpperCase()}</h3>
                <p>${profissional.numero}</p>
                <p>${profissional.area}</p>
                <div class="social-icons">
                    <a href="${profissional.linkedin}" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="${profissional.instagram}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="${profissional.facebook}" target="_blank"><i class="fab fa-facebook"></i></a>
                </div>
                <button class="btn btn-outline" onclick="window.location.href='agendamento.php'">Agendar</button>
            </div>
        `;
        equipeDiv.innerHTML += profissionalCard;
    });
}

// Chama a função para carregar os dados da equipe ao carregar o script
carregarDadosEquipe();