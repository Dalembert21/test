class RecuperarContrasena {
    constructor() {
        this.apiUrl = 'http://localhost/app-Alquiler-Autos/backend/apiRest.php';
        this.form = $('#recoverPasswordForm');
        this.messageContainer = $('#message');
        this.init();
    }

    init() {
        this.form.on('submit', (event) => {
            event.preventDefault();
            this.enviarSolicitud();
        });
    }

    enviarSolicitud() {
        const email = $('#email').val();
        
        $.ajax({
            url: this.apiUrl,
            method: 'POST',
            data: {
                accion: 'recuperarContrasena',
                email: email
            },
            dataType: 'json',
            success: (response) => {
                if (response.mensaje) {
                    this.messageContainer.html(response.mensaje);
                } else {
                    this.messageContainer.html('Error desconocido.');
                }
            },
            error: (jqXHR, textStatus) => {
                console.log(jqXHR.responseText);
                this.messageContainer.html('Error en la solicitud: ' + textStatus);
            }
        });
    }
}

// Inicializar la clase cuando el documento esté listo
$(document).ready(function() {
    new RecuperarContrasena();
});
