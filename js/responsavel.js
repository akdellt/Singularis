
// Mostrar/Ocultar Senha
document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordInput = document.getElementById('senha');
    const icon = this;
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Formatação do CPF
document.getElementById('cpf').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    
    if (value.length > 3 && value.length <= 6) {
        value = value.replace(/(\d{3})(\d{1,3})/, '$1.$2');
    } else if (value.length > 6 && value.length <= 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, '$1.$2.$3');
    } else if (value.length > 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
    }
    
    this.value = value;
});

// Formatação do Telefone
document.getElementById('telefone').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    
    if (value.length > 0) {
        value = value.replace(/^(\d{2})(\d{0,5})(\d{0,4})/, '($1) $2-$3');
    }
    
    this.value = value;
});

// Formatação do CEP
document.getElementById('cep').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    
    if (value.length > 5) {
        value = value.replace(/^(\d{5})(\d{0,3})/, '$1-$2');
    }
    
    this.value = value;
});

// Validação para habilitar botão quando todos os campos estiverem preenchidos
const formFields = document.querySelectorAll('.registration-form input, .registration-form textarea');
const submitBtn = document.querySelector('.submit-btn');

function checkForm() {
    let allFilled = true;
    formFields.forEach(field => {
        if (!field.value.trim()) allFilled = false;
    });
    
    submitBtn.disabled = !allFilled;
    submitBtn.style.opacity = allFilled ? '1' : '0.7';
    submitBtn.style.cursor = allFilled ? 'pointer' : 'not-allowed';
}

formFields.forEach(field => {
    field.addEventListener('input', checkForm);
});