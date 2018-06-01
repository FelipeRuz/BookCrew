/*function confirmarCambio()
{
    var r = confirm("¿Desea confirmar los cambios?");
    if (r == true) {
        alert("You pressed OK!");
    } else {
        alert("You pressed Cancel!");
    }    
}*/

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
