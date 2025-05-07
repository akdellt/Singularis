// CONFIGURAÇÃO GOOGLE
const CLIENT_ID = "997270492329-1skt8n0faj65s4reeqnev4jhpn6geefs.apps.googleusercontent.com";
const API_KEY = "AIzaSyDoaBmAfFuw-KwOeuMBTF2B12IV3YoLwB4";
const DISCOVERY_DOC = "https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest";
const SCOPES = "https://www.googleapis.com/auth/calendar.readonly";

// ID do calendário que você deseja usar
const CALENDAR_ID = "fd963694c36ebfc5e6424108b19d71eb315db8c7329a23484af78e0d208e060e@group.calendar.google.com";

let profissionalSelecionado = null;
let eventos = [];

// INICIALIZA GOOGLE API
function iniciarGoogleAPI() {
  gapi.load('client', () => {
    gapi.client.init({
      apiKey: API_KEY,
      clientId: CLIENT_ID,
      discoveryDocs: [DISCOVERY_DOC],
      scope: SCOPES
    }).then(() => {

      gapi.auth2.getAuthInstance().signIn().then(() => {
        document.getElementById('datepicker').disabled = false;
        console.log("Login Google realizado");
      });
    });
  });
}

// BUSCA EVENTOS PARA A DATA
function buscarEventosPorData(dataStr, callback) {
  const [dia, mes, ano] = dataStr.split('-');
  const dataInicio = new Date(`${ano}-${mes}-${dia}T00:00:00`);
  const dataFim = new Date(`${ano}-${mes}-${dia}T23:59:59`);

  gapi.client.calendar.events.list({
    calendarId: CALENDAR_ID, 
    timeMin: dataInicio.toISOString(),
    timeMax: dataFim.toISOString(),
    showDeleted: false,
    singleEvents: true,
    orderBy: 'startTime'
  }).then(response => {
    const eventos = response.result.items;

    
    console.log("Eventos encontrados:", eventos);

    const eventosProfissional = eventos.filter(evento => {
      
      console.log("Evento summary:", evento.summary);

      
      console.log("Profissional selecionado:", profissionalSelecionado);

      return evento.summary && evento.summary.trim().toLowerCase().includes(profissionalSelecionado.trim().toLowerCase());
    });

    const horariosOcupados = eventosProfissional.map(evento => {
      if (evento.start.dateTime) {
        return new Date(evento.start.dateTime).toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
      }
      return null;
    }).filter(Boolean);

    callback(horariosOcupados);
  });
}

// FILTRA HORÁRIOS POR PROFISSIONAL SELECIONADO
document.getElementById('equipeSelector').addEventListener('click', function(event) {
  const botao = event.target.closest('.equipe-card');
  if (botao) {
    profissionalSelecionado = botao.getAttribute('data-nome');
    console.log("Profissional selecionado:", profissionalSelecionado);

    const dataSelecionada = document.getElementById('datepicker').value;
    if (dataSelecionada) {
      mostrarHorariosDisponiveis(dataSelecionada);
    }
  }
});


// EXIBE BOTÕES DOS HORÁRIOS DISPONÍVEIS
function mostrarHorariosDisponiveis(data) {
  const horariosFixosSemana = [
    "08:00", "09:00", "10:00", "11:00",
    "13:00", "14:00", "15:00"
  ];

  const horariosFixosSabado = [
    "08:00", "09:00", "10:00", "11:00"
  ];
  

  if (!profissionalSelecionado) {
    return;
  }

  const dia = new Date(data.split("-").reverse().join("-")).getDay();
  let horariosFixos;

  if (dia === 6) {
    horariosFixos = []
  } else if (dia === 5) {
    horariosFixos = horariosFixosSabado;
  } else {
    horariosFixos = horariosFixosSemana;
  }
  
  buscarEventosPorData(data, horariosOcupados => {
    const disponiveis = horariosFixos.filter(h => !horariosOcupados.includes(h));
    console.log("Eventos encontrados:", eventos);
    const container = document.getElementById('horarios');
    container.innerHTML = "<h3>Horários disponíveis</h3><div id='btn-horarios'></div>";

    const botoes = document.getElementById('btn-horarios');
    disponiveis.forEach(hora => {
      const btn = document.createElement('button');
      btn.className = 'horario-btn';
      btn.innerText = hora;
      btn.onclick = () => alert(`Você selecionou ${data} às ${hora}`);
      botoes.appendChild(btn);
    });
  });
}

// FLATPICKR - CALENDÁRIO
flatpickr("#datepicker", {
  dateFormat: "d-m-Y",
  onChange: function(selectedDates, dateStr, instance) {
    if (profissionalSelecionado) {
      mostrarHorariosDisponiveis(dateStr);
    } else {
      console.warn("Selecione um profissional antes de escolher a data.");
    }
  }
});

// ONLOAD
window.onload = function () {
  document.getElementById('datepicker').value = "";
  document.getElementById('datepicker').disabled = true;
  document.getElementById('horarios').innerHTML = "";
  iniciarGoogleAPI();
};