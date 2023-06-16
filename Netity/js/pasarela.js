$(document).ready(function() {
    $('#credit-card').prop('checked', true);
    $('#credit-card-form').show();

    $('input[name="payment-method"]').change(function() {
      var selectedMethod = $('input[name="payment-method"]:checked').val();
      if (selectedMethod === 'credit-card') {
        $('#credit-card-form').show();
        $('#paypal-form').hide();
      } else if (selectedMethod === 'paypal') {
        $('#credit-card-form').hide();
        $('#paypal-form').show();
      }
    });

    $('#payment-form').submit(function(event) {
      event.preventDefault();

      // Verificar campos vacíos y aplicar estilos
      var formValid = true;

      if ($('#credit-card').is(':checked')) {
        $('#credit-card-form input').each(function() {
          var value = $(this).val().trim();
          var inputId = $(this).attr('id');

          if (value === '') {
            formValid = false;
            $(this).addClass('is-invalid');
          } else {
            $(this).removeClass('is-invalid');

            // Verificar caracteres especiales y validar campos específicos
            if (inputId === 'card-number') {
              if (!/^\d{16}$/.test(value)) {
                formValid = false;
                $(this).addClass('is-invalid');
              }
            } else if (inputId === 'expiration-date') {
              var sanitizedValue = value.replace(/[^0-9/]/g, ''); // Eliminar caracteres no numéricos y no '/'
              var maxLength = 5;

              if (sanitizedValue.length > maxLength) {
                sanitizedValue = sanitizedValue.slice(0, maxLength);
              }

              $(this).val(sanitizedValue);

              if (sanitizedValue.length !== maxLength || sanitizedValue.indexOf('/') !== 2) {
                formValid = false;
                $(this).addClass('is-invalid');
              }
            } else if (inputId === 'cvv') {
              var sanitizedValue = value.replace(/[^0-9]/g, ''); // Eliminar caracteres no numéricos
              var maxLength = 3;

              if (sanitizedValue.length > maxLength) {
                sanitizedValue = sanitizedValue.slice(0, maxLength);
              }

              $(this).val(sanitizedValue);

              if (sanitizedValue.length !== maxLength) {
                formValid = false;
                $(this).addClass('is-invalid');
              }
            } else if (inputId === 'card-holder') {
              var sanitizedValue = value.replace(/[^a-zA-Z\s]/g, ''); // Eliminar caracteres no alfabéticos
              $(this).val(sanitizedValue);

              if (sanitizedValue.length < 1) {
                formValid = false;
                $(this).addClass('is-invalid');
              }
            }
          }
        });
      } else if ($('#paypal').is(':checked')) {
        $('#paypal-form input').each(function() { 
          var value = $(this).val().trim();
          var inputId = $(this).attr('id');

          if (inputId !== 'paypal-email' && inputId !== 'paypal-password') {
            if (value === '') {
              formValid = false;
              $(this).addClass('is-invalid');
            } else {
              $(this).removeClass('is-invalid');
            }
          }
        });
      }

    });

    // Evitar caracteres especiales en los campos
    $('#credit-card-form input').on('input', function() {
      var sanitizedValue = $(this).val().replace(/[^\d\s/]/gi, '');
      $(this).val(sanitizedValue);
    });

    $('#paypal-form input').on('input', function() {
      var inputId = $(this).attr('id');
      if (inputId !== 'paypal-email' && inputId !== 'paypal-password') {
        var sanitizedValue = $(this).val().replace(/[^\w\s@.-]/gi, '');
        $(this).val(sanitizedValue);
      }
    });
  });
  // Mostrar u ocultar contraseña en el formulario de PayPal
  var passwordInput = $('#paypal-password');
  var passwordToggle = $('#password-toggle');

  passwordToggle.click(function() {
    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      passwordToggle.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
      passwordInput.attr('type', 'password');
      passwordToggle.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
    }
  });