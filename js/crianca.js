 // Máscaras para formulário
 document.getElementById('cpf-crianca').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    if (value.length > 3 && value.length <= 6) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
    } else if (value.length > 6 && value.length <= 9) {
        value = value.replace(/(\d{3})(\d{3})(\d)/, '$1.$2.$3');
    } else if (value.length > 9) {
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d)/, '$1.$2.$3-$4');
    }
    
    e.target.value = value;
});

document.getElementById('nascimento').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    
    if (value.length > 2 && value.length <= 4) {
        value = value.replace(/(\d{2})(\d)/, '$1/$2');
    } else if (value.length > 4) {
        value = value.replace(/(\d{2})(\d{2})(\d)/, '$1/$2/$3');
    }
    
    e.target.value = value;
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