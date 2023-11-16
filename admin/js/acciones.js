$(document).ready(function () {
    $(document).on('click', '.edit', function () {
        var id = $(this).val();
        var nombre = $('#nombre' + id).text();
        var correo = $('#correo' + id).text();
    });

    $(document).on('click', '.delete', function () {
        var id = $(this).val();
        var folio = $('#id' + id).text();
        var name = $('#nombre' + id).text();

        $('#id').val(folio);
        document.getElementById('name_user').innerHTML = name;
        $('#delete').modal('show');

    });

});

// Actualizar la imagen en la edicion
function updateimage() {
    const $seleccionArchivos = document.querySelector("#imagen"),
        $imagenPrevisualizacion = document.querySelector("#img");

    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
    });
}

