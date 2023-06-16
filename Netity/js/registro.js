
// VARIABLES 
const form = document.getElementById('singUp');

// Obtener los valores de registro

const username = document.getElementById('username').value;
const nombre = document.getElementById('nombre').value;
const primerApellido = document.getElementById('primerApellido').value;
const email = document.getElementById('email').value;
const phone = document.getElementById('phone').value;
const password = document.getElementById('password').value;
const confirmPassword = document.getElementById('confirmPassword').value;

// Mostrar u ocultar la contraseña al hacer clic en el botón correspondiente
const showPasswordButton = document.getElementById('showPassword');
const passwordInput = document.getElementById('password');

showPasswordButton.addEventListener('click', function () {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
});

const showConfirmPasswordButton = document.getElementById('showConfirmPassword');
showConfirmPasswordButton.addEventListener('click', function () {
    const confirmPasswordInput = document.getElementById('confirmPassword');
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
    } else {
        confirmPasswordInput.type = 'password';
    }
});

form.addEventListener('submit', function(event) {
    // Limpiar los mensajes de validación existentes
    clearValidationMessages();

    // Realizar las validaciones
    const username = document.getElementById('username').value;
    const nombre = document.getElementById('nombre').value;
    const primerApellido = document.getElementById('primerApellido').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    let isValid = true;

    // Validar el campo de usuario
    if (username === '') {
        isValid = false;
        displayValidationError('username', 'Por favor, ingresa tu nombre de usuario.');
    }

    // Validar el campo de nombre
    if (nombre === '') {
        isValid = false;
        displayValidationError('nombre', 'Por favor, ingresa tu nombre.');
    }

    // Validar el campo de primer apellido
    if (primerApellido === '') {
        isValid = false;
        displayValidationError('primerApellido', 'Por favor, ingresa tu primer apellido.');
    }

    // Validar el campo de email
    if (email === '') {
        isValid = false;
        displayValidationError('email', 'Por favor, ingresa tu email.');
    }

    // Validar el campo de teléfono
    if (phone === '') {
        isValid = false;
        displayValidationError('phone', 'Por favor, ingresa tu número de teléfono.');
    }

    // Validar el campo de contraseña
    if (password === '') {
        isValid = false;
        displayValidationError('password', 'Por favor, ingresa tu contraseña.');
    } else if (password.length < 8) {
        isValid = false;
        displayValidationError('password', 'La contraseña debe tener al menos 8 caracteres.');
    } else if (!/[A-Z]/.test(password)) {
        isValid = false;
        displayValidationError('password', 'La contraseña debe contener al menos una letra mayúscula.');
    } else if (!/[a-z]/.test(password)) {
        isValid = false;
        displayValidationError('password', 'La contraseña debe contener al menos una letra minúscula.');
    } else if (!/[0-9]/.test(password)) {
        isValid = false;
        displayValidationError('password', 'La contraseña debe contener al menos un número.');
    }

    // Validar el campo de repetir contraseña
    if (confirmPassword === '') {
        isValid = false;
        displayValidationError('confirmPassword', 'Por favor, repite tu contraseña.');
    } else if (password !== confirmPassword) {
        isValid = false;
        displayValidationError('confirmPassword', 'Las contraseñas no coinciden.');
    }

    // Prevenir el envío del formulario si alguna validación falla
    if (!isValid) {
        event.preventDefault();
    }
});

// Función para mostrar un mensaje de validación debajo de un campo específico
function displayValidationError(fieldId, errorMessage) {
    const field = document.getElementById(fieldId);
    const errorContainer = document.createElement('div');
    errorContainer.className = 'validation-error';
    errorContainer.innerText = errorMessage;
    field.parentNode.appendChild(errorContainer);
    field.classList.add('is-invalid');
}

// Función para limpiar los mensajes de validación existentes
function clearValidationMessages() {
    const errorMessages = document.querySelectorAll('.validation-error');
    errorMessages.forEach(function(errorMessage) {
        errorMessage.parentNode.removeChild(errorMessage);
    });

    const fields = document.querySelectorAll('.form-control');
    fields.forEach(function(field) {
        field.classList.remove('is-invalid');
    });
}

