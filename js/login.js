  // Mostrar/Ocultar Senha
  document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordInput = document.getElementById('senha');
    const icon = this;
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
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