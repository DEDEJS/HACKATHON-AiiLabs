/* js/auth.js */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Lógica de Tema
    const isLightMode = localStorage.getItem('lightMode') === 'true';
    if (isLightMode) {
        document.body.classList.add('light-mode');
    }

    // 2. Esconder erros ao digitar 
    const allInputs = document.querySelectorAll('input');
    
    allInputs.forEach(input => {
        // Adiciona o evento de digitação em cada um
        input.addEventListener('input', function() {
            // Procura o pai mais próximo que seja '.input-group'
            const formGroup = this.closest('.input-group');
            
            if (formGroup) {
                // Dentro desse grupo, procura a mensagem de erro
                const errorSpan = formGroup.querySelector('.error-msg');
                
                // Se achar, esconde e limpa o texto
                if (errorSpan) {
                    errorSpan.style.display = 'none';
                    errorSpan.innerText = ""; // Limpa o texto para garantir
                }
                
                // Remove a borda vermelha, se houver classe .error no grupo
                formGroup.classList.remove('error');
            }
        });
    });

    // 3. MÁSCARA CPF/CNPJ
    const cpfInput = document.getElementById('cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, "");
            
            if (value.length > 11) {
                value = value.replace(/^(\d{2})(\d)/, "$1.$2");
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
                value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
                value = value.replace(/(\d{4})(\d)/, "$1-$2");
            } else {
                value = value.replace(/(\d{3})(\d)/, "$1.$2");
                value = value.replace(/(\d{3})(\d)/, "$1.$2");
                value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            }
            e.target.value = value;
        });
    }

    // 4. MÁSCARA TELEFONE
    const phoneInput = document.getElementById('telefone');
    if (phoneInput) {
        phoneInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 11) value = value.slice(0, 11);

            value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
            value = value.replace(/(\d)(\d{4})$/, "$1-$2");
            e.target.value = value;
        });
    }
});

// --- Função Auxiliar de Erro ---
function showError(inputElement, message) {
    const formGroup = inputElement.closest('.input-group');
    if (formGroup) {
        const errorSpan = formGroup.querySelector('.error-msg');
        formGroup.classList.add('error');
        if (errorSpan) {
            errorSpan.innerText = message;
            errorSpan.style.display = 'block';
        }
    }
}

// --- VALIDAÇÃO LOGIN ---
function validateLogin(event) {
    const cpf = document.getElementById('cpf');
    const password = document.getElementById('senha');
    let isValid = true;

    if (cpf.value.length < 14) {
        showError(cpf, "CPF ou CNPJ inválido");
        isValid = false;
    }
    if (password.value.length < 1) {
        showError(password, "Digite sua senha");
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    } else {
        const btn = document.querySelector('.btn-primary');
        if(btn) {
            btn.innerText = 'Verificando...';
            btn.style.opacity = '0.7';
        }
    }
}

// --- VALIDAÇÃO CADASTRO ---
function validateRegistration(event) {
    const nome = document.getElementById('nome');
    const email = document.getElementById('email');
    const cpf = document.getElementById('cpf');
    const telefone = document.getElementById('telefone');
    const password = document.getElementById('senha');
    
    let isValid = true;

    if (!nome.value.trim().includes(' ')) {
        showError(nome, "Digite seu nome completo");
        isValid = false;
    }
    if (!email.value.includes('@') || !email.value.includes('.')) {
        showError(email, "E-mail inválido");
        isValid = false;
    }
    if (cpf.value.length < 14) {
        showError(cpf, "Documento inválido");
        isValid = false;
    }
    if (telefone.value.length < 14) {
        showError(telefone, "Telefone incompleto");
        isValid = false;
    }
    if (password.value.length < 6) {
        showError(password, "Mínimo 6 caracteres");
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    } else {
        const btn = document.querySelector('.btn-primary');
        if(btn) {
            btn.innerText = 'Criando conta...';
            btn.style.opacity = '0.7';
        }
    }
}