document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("adopcion");

    const nombreInput = document.getElementById("nombre");
    const descripcionInput = document.getElementById("descripcion");
    const imagenInput = document.getElementById("imagen");
    const tipoInput = document.getElementById("tipo");
    const tamanoInput = document.getElementById("tamano");
    const colorInput = document.getElementById("color");
    const generoInput = document.getElementById("genero");

    const errorNombre = document.getElementById("errorNombre");
    const errorDescripcion = document.getElementById("errorDescripcion");
    const errorImagen = document.getElementById("errorImagen");
    const errorTipo = document.getElementById("errorTipo");
    const errorTamano = document.getElementById("errorTamano");
    const errorColor = document.getElementById("errorColor");
    const errorGenero = document.getElementById("errorGenero");

    // Indica si es un formulario de edición 
    const isEdit = document.querySelector("input[name='id']") !== null;

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

    descripcionInput.addEventListener("input", function () {
        let val = descripcionInput.value.trim();
        if (val.length < 10) {
            errorDescripcion.innerText = "La descripción debe tener al menos 10 caracteres.";
            descripcionInput.classList.add("is-invalid");
        } else {
            errorDescripcion.innerText = "";
            descripcionInput.classList.remove("is-invalid");
        }
    });

    imagenInput.addEventListener("change", function () {
        if (!isEdit && !imagenInput.files.length) {
            errorImagen.innerText = "Debes seleccionar una imagen.";
            imagenInput.classList.add("is-invalid");
        } else {
            errorImagen.innerText = "";
            imagenInput.classList.remove("is-invalid");
        }
    });

    tipoInput.addEventListener("change", function () {
        if (tipoInput.value === "") {
            errorTipo.innerText = "Debes seleccionar un tipo.";
            tipoInput.classList.add("is-invalid");
        } else {
            errorTipo.innerText = "";
            tipoInput.classList.remove("is-invalid");
        }
    });

    tamanoInput.addEventListener("change", function () {
        if (tamanoInput.value === "") {
            errorTamano.innerText = "Debes seleccionar un tamaño.";
            tamanoInput.classList.add("is-invalid");
        } else {
            errorTamano.innerText = "";
            tamanoInput.classList.remove("is-invalid");
        }
    });

    colorInput.addEventListener("input", function () {
        let val = colorInput.value.trim();
        if (val.length < 3) {
            errorColor.innerText = "El color debe tener al menos 3 caracteres.";
            colorInput.classList.add("is-invalid");
        } else {
            errorColor.innerText = "";
            colorInput.classList.remove("is-invalid");
        }
    });

    generoInput.addEventListener("change", function () {
        if (generoInput.value === "") {
            errorGenero.innerText = "Debes seleccionar un género.";
            generoInput.classList.add("is-invalid");
        } else {
            errorGenero.innerText = "";
            generoInput.classList.remove("is-invalid");
        }
    });

    // Validación al enviar el formulario
    form.addEventListener("submit", function (event) {
        let isValid = true;

        // Nombre
        if (nombreInput.value.trim().length < 3) {
            errorNombre.innerText = "El nombre debe tener al menos 3 caracteres.";
            nombreInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorNombre.innerText = "";
            nombreInput.classList.remove("is-invalid");
        }

        // Descripción
        if (descripcionInput.value.trim().length < 10) {
            errorDescripcion.innerText = "La descripción debe tener al menos 10 caracteres.";
            descripcionInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorDescripcion.innerText = "";
            descripcionInput.classList.remove("is-invalid");
        }

        // Imagen (solo requerida en creación, no en edición)
        if (!isEdit && !imagenInput.files.length) {
            errorImagen.innerText = "Debes seleccionar una imagen.";
            imagenInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorImagen.innerText = "";
            imagenInput.classList.remove("is-invalid");
        }

        // Tipo
        if (tipoInput.value === "") {
            errorTipo.innerText = "Debes seleccionar un tipo.";
            tipoInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorTipo.innerText = "";
            tipoInput.classList.remove("is-invalid");
        }

        // Tamaño
        if (tamanoInput.value === "") {
            errorTamano.innerText = "Debes seleccionar un tamaño.";
            tamanoInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorTamano.innerText = "";
            tamanoInput.classList.remove("is-invalid");
        }

        // Color
        if (colorInput.value.trim().length < 3) {
            errorColor.innerText = "El color debe tener al menos 3 caracteres.";
            colorInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorColor.innerText = "";
            colorInput.classList.remove("is-invalid");
        }

        // Género
        if (generoInput.value === "") {
            errorGenero.innerText = "Debes seleccionar un género.";
            generoInput.classList.add("is-invalid");
            isValid = false;
        } else {
            errorGenero.innerText = "";
            generoInput.classList.remove("is-invalid");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});