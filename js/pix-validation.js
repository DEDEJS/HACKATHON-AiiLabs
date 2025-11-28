document.addEventListener('DOMContentLoaded', () => {
    const typeSelect = document.getElementById('pix-type');
    const keyInput = document.getElementById('pix-key');
    const valueInput = document.getElementById('pix-value');
    const form = document.getElementById('transfer-form');
    const btnSubmit = form.querySelector('.btn-primary');

    // 1. ESCONDER ERROS AO DIGITAR
    const allInputs = document.querySelectorAll('.input-field, select.input-field');
    allInputs.forEach(input => {
        input.addEventListener('input', () => {
            const errorSpan = input.parentElement.querySelector('.php-error');
            if (errorSpan) errorSpan.style.display = 'none';
        });
    });

    if (!typeSelect || !keyInput || !valueInput) return;

    // 2. Limpeza e Placeholders
    typeSelect.addEventListener('change', () => {
        keyInput.value = '';
        updatePlaceholder();
        const errorSpan = keyInput.parentElement.querySelector('.php-error');
        if(errorSpan) errorSpan.style.display = 'none';
    });

    function updatePlaceholder() {
        const type = typeSelect.value;
        if (type === 'cpf') {
            keyInput.placeholder = '000.000.000-00';
            keyInput.maxLength = 18; 
        } else if (type === 'email') {
            keyInput.placeholder = 'exemplo@email.com';
            keyInput.removeAttribute('maxLength');
        } else if (type === 'phone') {
            keyInput.placeholder = '(00) 90000-0000';
            keyInput.maxLength = 15;
        } else {
            keyInput.placeholder = 'Cole a chave aleatória';
            keyInput.removeAttribute('maxLength');
        }
    }
    updatePlaceholder();

    // 3. Máscaras Dinâmicas (Visualização Bonita)
    keyInput.addEventListener('input', (e) => {
        const type = typeSelect.value;
        let value = e.target.value;

        if (type === 'cpf') {
            value = value.replace(/\D/g, "");
            if (value.length > 14) value = value.slice(0, 14);
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
        } else if (type === 'phone') {
            value = value.replace(/\D/g, "");
            if (value.length > 11) value = value.slice(0, 11);
            value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
            value = value.replace(/(\d)(\d{4})$/, "$1-$2");
        }
        e.target.value = value;
    });

    // 4. Máscara de Moeda
    valueInput.addEventListener('input', (e) => {
        let value = e.target.value.replace(/\D/g, "");
        if (value === "") {
            e.target.value = "";
            return;
        }
        value = (Number(value) / 100).toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
        e.target.value = value;
    });

    // 5. LIMPEZA DOS DADOS NO ENVIO (Correção do Erro de Validação)
    form.addEventListener('submit', (e) => {
        // Feedback Visual Imediato
        if (btnSubmit) {
            btnSubmit.value = "Processando..."; // Muda texto do input submit
            btnSubmit.style.opacity = "0.7";
            btnSubmit.style.cursor = "wait";
        }

        // LIMPAR O VALOR (De "R$ 1.250,00" para "1250.00")
        let rawValue = valueInput.value;
        if(rawValue) {
            let cleanValue = rawValue.replace(/[^\d,]/g, '').replace(',', '.');
            valueInput.value = cleanValue;
        }

        // LIMPAR A CHAVE (De "123.456.789-00" para "12345678900")
        // Só limpamos se NÃO for email ou aleatória (pois email tem @ e ponto)
        const type = typeSelect.value;
        if (type === 'cpf' || type === 'phone') {
            // Remove tudo que não é número
            keyInput.value = keyInput.value.replace(/\D/g, "");
        }
        
        // Agora o formulário é enviado com os dados "limpos" pro PHP
    });
});