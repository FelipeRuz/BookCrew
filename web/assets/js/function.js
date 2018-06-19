//Función usada para confirmar los cambios de edición y adición.
//var rutaPath ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarCambios(rutaPath)
{
    var r = confirm("¿Desea confirmar los cambios?");
    if (r == true) {
        alert("Confirmando cambios...");
        //AÑADIR LLAMADA AL CONTROLADOR
        windows.location.href = rutaPath
    } else {
        alert("Cancelando...");
        location.reload();
    }
}

//Función usada para cancelar los cambios de edición y volver atrás
function confirmarAtras()
{
    var r = confirm("¿Desea volver atrás?");
    if (r == true) {
        alert("Confirmando..");
        history.back();
    } else {
        alert("Volviendo...");
    }
}

//Función usada para confirmar los cambios de borrado de libro.
//var id_del ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarBorradoLibro(id_del)
{
    var respuesta = confirm("¿Desea confirmar el borrado de este 'Libro'?");

    if (respuesta == true) {
        alert("Borrando. Espere un momento..");
        location.href = "/BookCrew/web/libro/delLibro/"+id_del;
    } else {
        alert("Cancelando operación. Espere un momento..");
    }
}

//Función usada para confirmar los cambios de borrado de autor.
//var id_del ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarBorradoAutor(id_del)
{
    var respuesta = confirm("¿Desea confirmar el borrado de este 'Autor'?");

    if (respuesta == true) {
        alert("Borrando. Espere un momento..");
        location.href = "/BookCrew/web/autor/delAutor/"+id_del
    } else {
        alert("Cancelando operación. Espere un momento..");
    }
}

//Función usada para confirmar los cambios de borrado de libreria.
//var id_del ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarBorradoLibreria(id_del)
{
    var respuesta = confirm("¿Desea confirmar el borrado de esta 'Librería'?");

    if (respuesta == true) {
        alert("Borrando. Espere un momento..");
        location.href = "/BookCrew/web/libreria/delLibreria/"+id_del
    } else {
        alert("Cancelando operación. Espere un momento..");
    }
}


//Función usada para confirmar los cambios de borrado de usuario.
//var id_del ; Ruta de acceso al controlador para efectuar la funcionalidad desde el servidor.
function confirmarBorradoLibreria(id_del)
{
    var respuesta = confirm("¿Desea confirmar el borrado de este 'USUARIO'-> ID: "+id_del+"?");

    if (respuesta == true) {
        alert("Borrando. Espere un momento..");
        location.href = "/BookCrew/web/usuario/delete/"+id_del
    } else {
        alert("Cancelando operación. Espere un momento..");
    }
}
							