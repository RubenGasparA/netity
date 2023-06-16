const form = document.getElementById('changePassword');

form.addEventListener('submit', function(event) {
    // Realizar las validaciones
    const password = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('renewPassword').value;

    let isValid = true;

    // Validar el campo de contraseña actual
    if (password === '') {
        isValid = false;
        alert('Por favor, ingresa tu contraseña actual.');
    }

    // Validar el campo de nueva contraseña
    if (newPassword === '') {
        isValid = false;
        alert('Por favor, ingresa tu nueva contraseña.');
    } else if (newPassword.length < 8) {
        isValid = false;
        alert('La nueva contraseña debe tener al menos 8 caracteres.');
    } else if (!/[A-Z]/.test(newPassword)) {
        isValid = false;
        alert('La nueva contraseña debe contener al menos una letra mayúscula.');
    } else if (!/[a-z]/.test(newPassword)) {
        isValid = false;
        alert('La nueva contraseña debe contener al menos una letra minúscula.');
    } else if (!/[0-9]/.test(newPassword)) {
        isValid = false;
        alert('La nueva contraseña debe contener al menos un número.');
    }

    // Validar el campo de repetir contraseña
    if (confirmPassword === '') {
        isValid = false;
        alert('Por favor, repite tu contraseña.');
    } else if (newPassword !== confirmPassword) {
        isValid = false;
        alert('La nueva contraseña y la confirmación no coinciden.');
    }

    // Prevenir el envío del formulario si alguna validación falla
    if (!isValid) {
        event.preventDefault();
    }
});






// Mostrar u ocultar la contraseña al hacer clic en el botón correspondiente
const showCurrentPasswordButton = document.getElementById('showCurrentPassword');
const currentPasswordInput = document.getElementById('currentPassword');

showCurrentPasswordButton.addEventListener('click', function () {
    if (currentPasswordInput.type === 'password') {
        currentPasswordInput.type = 'text';
    } else {
        currentPasswordInput.type = 'password';
    }
});
const showNewPasswordButton = document.getElementById('showNewPassword');
const NewPasswordInput = document.getElementById('newPassword');

showNewPasswordButton.addEventListener('click', function () {
    if (NewPasswordInput.type === 'password') {
        NewPasswordInput.type = 'text';
    } else {
        NewPasswordInput.type = 'password';
    }
});

const showRePasswordButton = document.getElementById('showRenewPassword');
const confirmPasswordInput = document.getElementById('renewPassword');

showRePasswordButton.addEventListener('click', function () {
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
    } else {
        confirmPasswordInput.type = 'password';
    }
});
