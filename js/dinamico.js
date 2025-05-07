let dados = [];
let equipe = [];


// CÓDIGO PARA EQUIPE:
document.addEventListener("DOMContentLoaded", async () => {
    await carregarDados(); 
    carregarEquipe(); 
});

async function carregarDados() {
    try {
        const respostaEquipe = await fetch("src/equipe.json");
        if (!respostaEquipe.ok) {
            throw new Error(`Erro ao carregar equipe.json: ${respostaEquipe.status}`);
        }
        equipe = await respostaEquipe.json();
    } catch (error) {
        console.error("Erro ao carregar os dados da equipe:", error);
    }
}

function carregarEquipe() {
    const equipeDiv = document.getElementById("equipeContainer");
    equipeDiv.innerHTML = ""; 

    equipe.forEach(profissional => {
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


//-------------------------------------------

//CÓDGIO PARA ESPECIALIDADE:
document.addEventListener("DOMContentLoaded", async () => {
    await carregarDados();
    mostrarPagina();

    const seletor = document.getElementById("selector");
    if (seletor) {
        seletor.selectedIndex = 0; 
    }

    document.addEventListener('click', function(event) {
        const botao = event.target.closest(".btn-outline.equipe-card");
    
        if (botao) {
            document.querySelectorAll(".equipe-card").forEach(botao => {
                botao.classList.remove("btn-active");
            });

            botao.classList.add("btn-active");

            const seletor = document.getElementById("selector");
            const datepicker = document.getElementById("datepicker");
        
            if (seletor.value) {
                datepicker.disabled = false;
            }
        }
    });
});

// CARREGA DADOS DAS ESPECIALIDADES
async function carregarDados() {
    try {
        const respostaConteudo = await fetch("src/conteudo.json");
        if (!respostaConteudo.ok) {
            throw new Error(`Erro ao carregar conteudo.json: ${respostaConteudo.status}`);
        }
        dados = await respostaConteudo.json();

        const respostaEquipe = await fetch("src/equipe.json");
        if (!respostaEquipe.ok) {
            throw new Error(`Erro ao carregar equipe.json: ${respostaEquipe.status}`);
        }
        equipe = await respostaEquipe.json();

        if (window.location.pathname.includes("equipe.php")) {
            carregarEquipe();
        } 

    } catch (error) {
        console.error("Erro ao carregar o conteúdo:", error);
    }
}

// REDIRECIONA PARA PÁGINA DE ESPECIALIDADE SELECIONADA
function mostrarPagina() {
    const params = new URLSearchParams(window.location.search);
    const nomeEspecialidade = params.get("nome");

    if (nomeEspecialidade) {
        carregarConteudo(nomeEspecialidade);
    }
}

// ATUALIZA CONTEÚDO DA PÁGINA DE ESPECIALIDADE
function carregarConteudo(nomeEspecialidade) {
    const especialidade = dados.find(item => item.nome === nomeEspecialidade);

    const especialidadeDiv = document.getElementById("especialidade");
    const titulo = document.getElementById("titulo");

    if (!especialidade) {
        console.error("Especialidade não encontrada:", nomeEspecialidade);
        return;
    }

    titulo.innerText = especialidade.nome.toUpperCase();
    especialidadeDiv.innerHTML = 
        `<img src="src/img/${especialidade.imagem}" alt="${especialidade.nome}">
        <p>${especialidade.texto1}</p>
        <p>${especialidade.texto2}</p>`;
    
    carregarEquipeFiltrado(especialidade.nome);
}


//--------------------------------------------------------------------


//CÓDIGOS PARA AGENDAMENTO:
// ATUALIZA CONTEÚDO DA PÁGINA DE AGENDAMENTO
function carregarConteudoAgenda() {
    const seletor = document.getElementById("selector");
    const datepicker = document.getElementById("datepicker");
    const divHorarios = document.getElementById('horarios');
    divHorarios.innerHTML = '';
    

    if (seletor.value && document.querySelector(".btn-active")) {
        datepicker.disabled = false; 
        
    } else {
        datepicker.disabled = true; 
    }

    carregarEquipeAgendamento(seletor.value);
}

// ATUALIZA EQUIPE NA PÁGINA DE AGENDAMENTO
function carregarEquipeAgendamento(seletor) {
    const equipeDiv = document.getElementById("equipeSelector");
    const selectorDiv = document.querySelector(".equipe-selector");

    equipeDiv.innerHTML = "";

    if (!seletor) {
        return;
    }
    
    selectorDiv.style.display = "block";

    equipe.forEach(profissional => {
        if (profissional.area === seletor) {
            const profissionalCard = `
                <button class="btn-outline equipe-card" data-nome="${profissional.nome}">
                    <img src="src/img/perfis/${profissional.imagem}" width="100%">
                    <h3>${profissional.nome.toUpperCase()}</h3>
                </button>
                `;

            equipeDiv.innerHTML += profissionalCard;
        }
        
    });
}