// js/auth.js

// 1. Lógica de Tema (Executar IMEDIATAMENTE ao carregar)
document.addEventListener('DOMContentLoaded', () => {
    // Verifica se o usuário prefere o tema claro
    const isLightMode = localStorage.getItem('lightMode') === 'true';
    
    if (isLightMode) {
        document.body.classList.add('light-mode');
    }
});

const cpfInput = document.getElementById('cpf');

if (cpfInput) {
    cpfInput.addEventListener('input', (e) => {
        let value = e.target.value;

        // 1. Remove tudo que não for número
        value = value.replace(/\D/g, "");

        // 2. Decide qual máscara aplicar baseado no tamanho
        if (value.length > 11) {
            // Máscara de CNPJ (00.000.000/0000-00)
            value = value.replace(/^(\d{2})(\d)/, "$1.$2");
            value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
            value = value.replace(/(\d{4})(\d)/, "$1-$2");
        } else {
            // Máscara de CPF (000.000.000-00)
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d)/, "$1.$2");
            value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        }

        e.target.value = value;
    });
}

// --- Validação do Login ---
function validateLogin(event) {
    event.preventDefault();

    const cpf = document.getElementById('cpf');
    const password = document.getElementById('senha');
    let isValid = true;

    setError(cpf, false);
    setError(password, false);

    // Validação Híbrida:
    // CPF tem 14 caracteres (com pontos)
    // CNPJ tem 18 caracteres (com pontos)
    if (cpf.value.length !== 14 && cpf.value.length !== 18) {
        setError(cpf, true);
        // Altera a mensagem de erro visualmente se quiser ser específico
        const errorSpan = cpf.parentElement.querySelector('.error-msg');
        if(errorSpan) errorSpan.innerText = "CPF ou CNPJ inválido";
        
        isValid = false;
    }

    if (password.value.length < 4) {
        setError(password, true);
        isValid = false;
    }

    if (isValid) {
        const btn = document.querySelector('.btn-primary');
        const originalText = btn.innerText;
        btn.innerText = 'Entrando...';
        btn.style.opacity = '0.7';
        document.querySelector('form').submit();

       /* setTimeout(() => {
            window.location.href = 'pages/home.php';
        }, 800);*/
    }
}

function setError(input, isError) {
    const formGroup = input.parentElement;
    if (isError) {
        formGroup.classList.add('error');
    } else {
        formGroup.classList.remove('error');
    }
}