document.addEventListener('DOMContentLoaded', function () {
    const botonesAdoptar = document.querySelectorAll('.adoptar-btn');
    const mensajeResultado = document.getElementById('mensaje-resultado');

    botonesAdoptar.forEach(boton => {
        boton.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const tipo = this.getAttribute('data-tipo');
            const nombre = this.getAttribute('data-nombre');

            const mensaje = document.getElementById('mensaje-adopcion');
            mensaje.textContent = `Se está haciendo una solicitud por el ${tipo} de nombre "${nombre}".`;

            const enviarBtn = document.getElementById('enviar-solicitud');
            enviarBtn.setAttribute('data-id-animal', id);

            mensajeResultado.style.display = 'none';
            mensajeResultado.textContent = '';
        });
    });

    document.getElementById('enviar-solicitud').addEventListener('click', function () {
        const idAnimal = this.getAttribute('data-id-animal');
        const modal = bootstrap.Modal.getInstance(document.getElementById('animalModal'));
        const mensajeResultado = document.getElementById('mensaje-resultado');

        if (!idAnimal) {
            mensajeResultado.textContent = 'No se pudo identificar el animal.';
            mensajeResultado.className = 'mt-3 text-center text-danger';
            mensajeResultado.style.display = 'block';
            return;
        }

        fetch('procesar_adopcion.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_animal=${encodeURIComponent(idAnimal)}`
        })
            .then(response => response.json()) 
            .then(data => {
                mensajeResultado.textContent = data.message;
                mensajeResultado.className = 'mt-3 text-center ' + (data.success ? 'text-success' : 'text-danger');
                mensajeResultado.style.display = 'block';

                if (data.success) {
                    modal.hide();
                    window.location.reload();    
                }

            })
            .catch(error => {
                console.error('Error:', error);
                mensajeResultado.textContent = 'Ocurrió un error al procesar la solicitud.';
                mensajeResultado.className = 'mt-3 text-center text-danger';
                mensajeResultado.style.display = 'block';
            });
    });
});