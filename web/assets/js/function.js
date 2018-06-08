//Función usada para confirmar los cambios de edición y adición.
//var rutaPath ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarCambios(rutaPath)
{
    var r = confirm("¿Desea confirmar los cambios?");
    if (r == true) {
        alert("Confirmando cambios...");
        //AÑADIR LLAMADA AL CONTROLADOR
        windows.location.href= rutaPath
    } else {
        alert("Cancelando...");
    }    
}

function confirmarBorradoLibro()
{
    var r = confirm("¿Desea borrar este libro?");
    if (r == true) {
        alert("Eliminando...");
        //AÑADIR LLAMADA AL CONTROLADOR
        windows.location.href= "/libro/delete/";
    } else {
        alert("Cancelando...");
    }
}