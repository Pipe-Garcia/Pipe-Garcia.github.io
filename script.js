document.addEventListener("DOMContentLoaded", function validarFormulario() {
    var formulario = document.getElementById("formulario");
    var mensajeError = document.getElementById("mensaje-error");

    formulario.addEventListener("submit", function(event) {
        mensajeError.innerHTML = ""; // Restablece el mensaje de error

        // Validar Nombre y Apellido
        var nombreApellido = document.getElementById("nom-ape").value;
        if (nombreApellido.trim() === "") {
            mensajeError.innerHTML = "Por favor, ingrese su nombre y apellido.";
            event.preventDefault();
            return;
        }

        // Validar Pago (número)
        var pago = document.getElementById("pago").value;
        if (!/^\d+$/.test(pago)) {
            mensajeError.innerHTML = "El monto a pagar debe contener solo números.";
            event.preventDefault();
            return;
        }

        // Validar Paquetes (al menos uno seleccionado)
        var paquetes = document.querySelectorAll('input[name="paquetes"]:checked');
        if (paquetes.length === 0) {
            mensajeError.innerHTML = "Por favor, seleccione un paquete.";
            event.preventDefault();
            return;
        }

        // Validar Servicios (al menos uno seleccionado)
        var servicios = document.querySelectorAll('select[name="servicios[]"] option:checked');
        if (servicios.length === 0) {
            mensajeError.innerHTML = "Por favor, seleccione al menos un servicio.";
            event.preventDefault();
            return;
        }

        // Validar Correo Electrónico (si se selecciona la opción de recibir publicaciones)
        var recibirPublicaciones = document.getElementById("publicaciones").checked;
        if (recibirPublicaciones) {
            var email = document.getElementById("email").value;
            if (email.trim() === "" || !/^\S+@\S+\.\S+$/.test(email)) {
                mensajeError.innerHTML = "Por favor, ingrese un correo electrónico válido si desea recibir publicaciones.";
                event.preventDefault();
                return;
            }
        }
    });
});
