document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formRegistro");

    const nombreInput = document.getElementById("nombre");
    const apellidosInput = document.getElementById("apellidos");
    const rolInput = document.getElementById("rol");
    const telefonoInput = document.getElementById("telefono");
    const direccionInput = document.getElementById("direccion");
    const edadInput = document.getElementById("edad");
    const sexoInput = document.getElementById("sexo");

    const errorNombre = document.getElementById("errorNombre");
    const errorApellidos = document.getElementById("errorApellidos");
    const errorRol = document.getElementById("errorRol");
    const errorTelefono = document.getElementById("errorTelefono");
    const errorDireccion = document.getElementById("errorDireccion");
    const errorEdad = document.getElementById("errorEdad");
    const errorSexo = document.getElementById("errorSexo");

    // Validación en tiempo real
    nombreInput.addEventListener("input", function () {
        let val = nombreInput.value.trim();
        if (val.length < 3) {
            errorNombre.innerText = "El nombre debe tener al menos 3 caracteres.";
            nombreInput.classList.add("is-invalid");
        } else {
            errorNombre.innerText = "";
            nombreInput.classList.remove("is-invalid");
        }
    });

    apellidosInput.addEventListener("input", function () {
        let val = apellidosInput.value.trim();
        if (val.length < 3) {
            errorApellidos.innerText = "Los apellidos deben tener al menos 3 caracteres.";
            apellidosInput.classList.add("is-invalid");
        } else {
            errorApellidos.innerText = "";
            apellidosInput.classList.remove("is-invalid");
        }
    });

    telefonoInput.addEventListener("input", function () {
        let val = telefonoInput.value.trim();
        if (!/^\d{10}$/.test(val)) {
            errorTelefono.innerText = "El teléfono debe tener 10 dígitos.";
            telefonoInput.classList.add("is-invalid");
        } else {
            errorTelefono.innerText = "";
            telefonoInput.classList.remove("is-invalid");
        }
    });

    direccionInput.addEventListener("input", function () {
        let val = direccionInput.value.trim();
        if (val.length < 5) {
            errorDireccion.innerText = "La dirección debe tener al menos 5 caracteres.";
            direccionInput.classList.add("is-invalid");
        } else {
            errorDireccion.innerText = "";
            direccionInput.classList.remove("is-invalid");
        }
    });

    edadInput.addEventListener("input", function () {
        let val = parseInt(edadInput.value);
        if (isNaN(val) || val < 15 || val > 90) {
            errorEdad.innerText = "Edad debe ser entre 15 y 90.";
            edadInput.classList.add("is-invalid");
        } else {
            errorEdad.innerText = "";
            edadInput.classList.remove("is-invalid");
        }
    });
    rolInput.addEventListener("change", function () {
        if (rolInput.value === "") {
            errorRol.innerText = "Debes seleccionar un tipo de usuario.";
            rolInput.classList.add("is-invalid");
        } else {
            errorRol.innerText = "";
            rolInput.classList.remove("is-invalid");
        }
    });


    // Validación
    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Nombre
        if (nombreInput.value.trim().length < 3) {
            errorNombre.innerText = "El nombre es obligatorio y debe tener mínimo 3 caracteres.";
            nombreInput.classList.add("is-invalid");
            isValid = false;
        }

        // Apellidos
        if (apellidosInput.value.trim().length < 3) {
            errorApellidos.innerText = "Los apellidos son obligatorios.";
            apellidosInput.classList.add("is-invalid");
            isValid = false;
        }

        // Tipo de usuario
        if (rolInput.value === "") {
            errorRol.innerText = "Debes seleccionar un tipo de usuario.";
            rolInput.classList.add("is-invalid");
            isValid = false;
        }

        // Teléfono
        if (!/^\d{10}$/.test(telefonoInput.value.trim())) {
            errorTelefono.innerText = "Teléfono inválido.";
            telefonoInput.classList.add("is-invalid");
            isValid = false;
        }

        // Dirección
        if (direccionInput.value.trim().length < 5) {
            errorDireccion.innerText = "La dirección debe tener al menos 5 caracteres.";
            direccionInput.classList.add("is-invalid");
            isValid = false;
        }

        // Edad
        const edadVal = parseInt(edadInput.value);
        if (isNaN(edadVal) || edadVal < 1 || edadVal > 90) {
            errorEdad.innerText = "Edad fuera de rango.";
            edadInput.classList.add("is-invalid");
            isValid = false;
        }

        // Sexo
        if (sexoInput.value === "") {
            errorSexo.innerText = "Selecciona un sexo.";
            sexoInput.classList.add("is-invalid");
            isValid = false;
        }

        // tipo usuario
        if (rolInput.value === "") {
            errorRol.innerText = "Debes seleccionar un tipo de usuario.";
            rolInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorRol.innerText = "";
            rolInput.classList.remove("is-invalid");
        }


        if (!isValid) {
            event.preventDefault();
        }
    });
});

