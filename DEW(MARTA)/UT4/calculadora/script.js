// Archivo: script.js
document.addEventListener('DOMContentLoaded', () => {
    const display = document.getElementById('display');
    const buttons = document.querySelectorAll('.btn');
    const clearButton = document.getElementById('clear');
    const equalsButton = document.getElementById('equals');

    let currentInput = '';
    let operator = null;
    let previousValue = '';

    // Manejo de clic en botones
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const value = button.getAttribute('data-value');

            if (!isNaN(value) || value === '.') {
                currentInput += value;
                updateDisplay(currentInput);
            } else if (['+', '-', '*', '/'].includes(value)) {
                if (currentInput === '' && previousValue === '') return;
                if (previousValue && currentInput) {
                    previousValue = calculate(previousValue, operator, currentInput);
                } else if (!previousValue) {
                    previousValue = currentInput;
                }
                operator = value;
                currentInput = '';
            }
        });
    });

    // Igual
    equalsButton.addEventListener('click', () => {
        if (currentInput && operator && previousValue) {
            const result = calculate(previousValue, operator, currentInput);
            updateDisplay(result);
            previousValue = '';
            currentInput = result;
            operator = null;
        }
    });

    // Limpiar
    clearButton.addEventListener('click', () => {
        currentInput = '';
        operator = null;
        previousValue = '';
        updateDisplay(0);
    });

    // Actualizar pantalla
    function updateDisplay(value) {
        display.textContent = value;
    }

    // Cálculo
    function calculate(a, op, b) {
        a = parseFloat(a);
        b = parseFloat(b);
        switch (op) {
            case '+': return (a + b).toString();
            case '-': return (a - b).toString();
            case '*': return (a * b).toString();
            case '/': return b !== 0 ? (a / b).toString() : 'Error';
            default: return '';
        }
    }
});
