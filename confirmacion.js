function confirmacion(e){
    if (confirm("¿Seguro que quiere eliminar este registro?")) {
        return true;
    }else {
        event.preventDefault();
    }
}
let linkDelete = document.querySelectorAll(".boton_eliminar");
for (var i=0; i < linkDelete.length; i++){
    linkDelete[i].addEventListener('click', confirmacion);
}