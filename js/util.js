function eliminar(){
    if (window.confirm("¿Desea eliminar el elemento seleccionado?")) {
        return true;
    }else{
        return false;
    }
}

function confirmar(){
    if (window.confirm("¿Desea realizar la compra de los articulos seleccionados?")) {
        return true;
    }else{
        return false;
    }
}

function concluir(){
    if (window.confirm("¿Confirma que la venta se realizo con exito?")) {
        return true;
    }else{
        return false;
    }
}

function cancelada(){
    if (window.confirm("¿Confirma que la venta no concluyo?")) {
        return true;
    }else{
        return false;
    }
}
