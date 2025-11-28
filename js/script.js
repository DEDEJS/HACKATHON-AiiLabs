/* ==========================================================
   SCRIPT.JS - Lógica Global do App
   ========================================================== */

document.addEventListener('DOMContentLoaded', () => {
    initSidebar();
    initGreeting();
    initBalanceToggle();
    initTheme();
    initSettingsToggles();
    initChart(); // Só roda se tiver gráfico na página
});

/* --- 1. Menu Lateral (Sidebar) --- */
function initSidebar() {
    const menuBtn = document.getElementById('open-menu');
    const closeBtn = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (!menuBtn || !sidebar) return; // Segurança

    function openMenu() {
        sidebar.classList.add('active');
        if(overlay) overlay.classList.add('active');
    }

    function closeMenu() {
        sidebar.classList.remove('active');
        if(overlay) overlay.classList.remove('active');
    }

    menuBtn.addEventListener('click', openMenu);
    if(closeBtn) closeBtn.addEventListener('click', closeMenu);
    if(overlay) overlay.addEventListener('click', closeMenu);
}

/* --- 2. Saudação Automática --- */
function initGreeting() {
    const greetingText = document.getElementById('greeting-text');
    if (!greetingText) return;

    const currentHour = new Date().getHours();
    if (currentHour >= 5 && currentHour < 12) {
        greetingText.innerText = "Bom dia,";
    } else if (currentHour >= 12 && currentHour < 18) {
        greetingText.innerText = "Boa tarde,";
    } else {
        greetingText.innerText = "Boa noite,";
    }
}

/* --- 3. Ocultar/Mostrar Saldo --- */
function initBalanceToggle() {
    const eyeBtn = document.getElementById('toggle-balance');
    const balanceValue = document.getElementById('balance-amount');
    
    if (!eyeBtn || !balanceValue) return;

    // Recupera estado anterior
    const isHidden = localStorage.getItem('balanceHidden') === 'true';
    updateBalanceVisuals(isHidden, eyeBtn, balanceValue);

    eyeBtn.addEventListener('click', () => {
        // Inverte o estado atual
        const currentlyHidden = balanceValue.classList.contains('blur-content');
        const newState = !currentlyHidden;
        
        updateBalanceVisuals(newState, eyeBtn, balanceValue);
        localStorage.setItem('balanceHidden', newState);
    });
}

function updateBalanceVisuals(shouldHide, btn, valueElement) {
    if (shouldHide) {
        valueElement.classList.add('blur-content');
        btn.classList.remove('ph-eye');
        btn.classList.add('ph-eye-slash');
    } else {
        valueElement.classList.remove('blur-content');
        btn.classList.remove('ph-eye-slash');
        btn.classList.add('ph-eye');
    }
}

/* --- 4. Tema Claro/Escuro --- */
function initTheme() {
    const themeToggle = document.getElementById('toggle-theme');
    const themeIcon = document.getElementById('theme-icon');
    const body = document.body;

    const isLightMode = localStorage.getItem('lightMode') === 'true';

    // Aplica o tema ao carregar
    if (isLightMode) {
        body.classList.add('light-mode');
        if (themeIcon) themeIcon.classList.replace('ph-moon', 'ph-sun');
    }

    // Configura o botão (se ele existir na página atual)
    if (themeToggle) {
        // Define o estado visual inicial do botão
        if (isLightMode) {
            themeToggle.classList.remove('on'); // Off = Claro
        } else {
            themeToggle.classList.add('on');    // On = Escuro (Padrão)
        }

        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('light-mode')) {
                // Mudar para Escuro
                body.classList.remove('light-mode');
                localStorage.setItem('lightMode', 'false');
                themeToggle.classList.add('on');
                if (themeIcon) themeIcon.classList.replace('ph-sun', 'ph-moon');
            } else {
                // Mudar para Claro
                body.classList.add('light-mode');
                localStorage.setItem('lightMode', 'true');
                themeToggle.classList.remove('on');
                if (themeIcon) themeIcon.classList.replace('ph-moon', 'ph-sun');
            }
        });
    }
}

/* --- 5. Botões de Toggle Gerais (Configurações) --- */
function initSettingsToggles() {
    const togglesList = ['toggle-notifications', 'toggle-biometry'];

    togglesList.forEach(toggleId => {
        const toggleElement = document.getElementById(toggleId);
        if (!toggleElement) return;

        // Recupera estado (Se não existir, assume 'true' como padrão)
        const savedState = localStorage.getItem(toggleId);
        if (savedState === 'false') {
            toggleElement.classList.remove('on');
        } else {
            toggleElement.classList.add('on');
        }

        toggleElement.addEventListener('click', () => {
            toggleElement.classList.toggle('on');
            const currentState = toggleElement.classList.contains('on');
            localStorage.setItem(toggleId, currentState);
        });
    });
}

/* --- 6. Gráfico Chart.js (Apenas na página Extrato) --- */
function initChart() {
    const ctx = document.getElementById('expenseChart');
    if (!ctx) return; // Se não tem gráfico, para aqui.

    // Verifica se a biblioteca foi carregada
    if (typeof Chart === 'undefined') return;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Mercado', 'Assinaturas', 'Alimentação'],
            datasets: [{
                label: 'Gastos (R$)',
                data: [450.20, 55.90, 14.50],
                backgroundColor: ['#8257e5', '#04d361', '#e9af63'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        color: '#a1a1aa',
                        font: { family: 'Inter', size: 12 },
                        usePointStyle: true,
                        boxWidth: 8
                    }
                }
            },
            cutout: '75%',
        }
    });
}