function verificarAbono(){
    var todo_correcto = true;
    var mensaje = 'PROBLEMAS CON EL FORMULARIO: \n';
    var saldo = parseFloat(document.getElementById('saldo').value);
    var abono = parseFloat(document.getElementById('abono').value);

    if(abono >= saldo){
        todo_correcto= false;
        mensaje = mensaje + "-El valor del monto no puede superar al saldo pendiente";
    }

    if(!todo_correcto){
        alert(mensaje);
    }

    return todo_correcto;
}