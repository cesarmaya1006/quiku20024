function mostrar() {
    var archivo = document.getElementById("imagen").files[0];
    var reader = new FileReader();
    if (archivo) {
        reader.readAsDataURL(archivo);
        reader.onloadend = function () {
            document.getElementById("fotoUsuario").src = reader.result;
        };
    }
}
