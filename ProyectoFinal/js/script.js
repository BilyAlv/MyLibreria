// Validar formulario al enviarlo
document.querySelector('form').addEventListener('submit', function(event) {
    var correo = document.getElementById('correo').value;
    var nombre = document.getElementById('nombre').value;
    var asunto = document.getElementById('asunto').value;
    var comentario = document.getElementById('comentario').value;

    if (!correo || !nombre || !asunto || !comentario) {
        event.preventDefault();
        alert('Por favor, completa todos los campos antes de enviar.');
    }
});

document.querySelector('form').addEventListener('submit', function(event) {
    var correo = document.getElementById('correo').value;
    if (!correo.includes('@')) {
        alert('Por favor, ingresa un correo válido.');
        event.preventDefault(); 
    }
});

// Manejar el evento de eliminar comentario
function eliminarComentario(id) {
    if (confirm("¿Seguro que quieres eliminar este comentario?")) {
        // Usar fetch para hacer la solicitud de eliminación
        const formData = new FormData();
        formData.append('id', id);

        fetch('../config/eliminar_comentario.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Comentario eliminado con éxito");
                location.reload(); // Recargar la página para reflejar los cambios
            } else {
                alert("Hubo un error al eliminar el comentario");
            }
        });
    }
}

// Manejar el desplazamiento para el cambio de clase en la barra de navegación
document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
});
