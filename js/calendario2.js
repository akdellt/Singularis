let dados = [];
let equipe = [];

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
        const respostaConteudo = await fetch("./src/conteudo.json");
        dados = await respostaConteudo.json();

        const respostaEquipe = await fetch("./src/equipe.json");
        equipe = await respostaEquipe.json();

        if (window.location.pathname.includes("equipe.html")) {
            carregarEquipe();
        } 

    } catch (error) {
        console.error("Erro ao carregar o conteúdo:", error);
    }
}

// REDIRECIONA PARA PÁGINA DE ESPECIALIDADE SELECIONA
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

    titulo.innerText = especialidade.nome.toUpperCase();
    especialidadeDiv.innerHTML = 
        `<img src="src/img/${especialidade.imagem}" width="769px" height="265px">
        <p>${especialidade.texto1}</p>
        <p>${especialidade.texto2}</p>`
    ;

    if (especialidade) {
        carregarEquipeFiltrado(especialidade.nome);
    }
}

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


// FUNÇÃO DE ATUALIZAÇÃO DAS EQUIPES NA PÁGINA PRINCIPAL
function carregarEquipe() {
    const equipeDiv = document.getElementById("equipeContainer");
    equipeDiv.innerHTML = " ";

    equipe.forEach(profissional => {
        const profissionalCard = `
            <div class="equipe-card">
                <img src="src/img/perfis/${profissional.imagem}" width="100%">
                <h3>${profissional.nome.toUpperCase()}</h3>
                <p>${profissional.numero}</p>
                <p>${profissional.area}</p>
                <div class="social-icons">
                    <a href="${profissional.linkedin}"><i class="fab fa-linkedin"></i></a>
                    <a href="${profissional.instagram}"><i class="fab fa-instagram"></i></a>
                    <a href="${profissional.facebook}"><i class="fab fa-facebook"></i></a>
                </div>
                <button class="btn btn-outline" onclick="window.location.href='agendamento.html'">Agendar</button>
            </div>
        `;

        equipeDiv.innerHTML += profissionalCard;
    })
    
}

// ATUALIZAÇÃO DA EQUIPE PARA CARA ESPECIALIDADE
function carregarEquipeFiltrado(nomeEspecialidade) {
    const equipeDiv = document.getElementById("equipeFilter");
    equipeDiv.innerHTML = " ";

    equipe.forEach(profissional => {
        if (profissional.area === nomeEspecialidade) {
            const profissionalCard = `
            <div class="equipe-card">
                <img src="src/img/perfis/${profissional.imagem}" width="100%">
                <h3>${profissional.nome.toUpperCase()}</h3>
                <button class="btn btn-outline" onclick="window.location.href='agendamento.html'">Agendar</button>
            </div>
            `;

            equipeDiv.innerHTML += profissionalCard;
        }
        
    })
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

