function validarTarjeta() {
    var todo_correcto = true;
    // crea un nuevo objeto `Date`
    var today = new Date();
    var mesActual = today.getMonth() + 1; 
    var añoActual = today.getFullYear();
 
    var mensaje = 'PROBLEMAS CON EL FORMULARIO: \n';

    var num_tarjeta =  document.getElementById('num_tarjeta').value;
    var num_seguridad =  document.getElementById('num_seguridad').value;
    var fecha_vencimiento = document.getElementById('fecha_vencimiento').value;
    var monto_autorizado = document.getElementById('monto_autorizado').value;

    if(num_tarjeta.length != 16){
        mensaje += '-Longitu de numero de tarjeta incorrecto, debe tener unicamente 16 digitos. \n';
        todo_correcto = false;
    }

    if(num_seguridad.length != 3){
        mensaje += '-Longitu de numero de seguridad incorrecto, debe tener unicamente 3 digitios. \n';
        todo_correcto = false;
    }

    var año_vencimiento = parseInt(fecha_vencimiento.substring(0, 4), 10);
    var mes_vencimiento = parseInt(fecha_vencimiento.substring(5, 7), 10);

    if(año_vencimiento<añoActual){
        mensaje += '-Año de vencimiento invalido, seleccione un año futuro';
        todo_correcto=false;
    }else if(año_vencimiento==añoActual && mes_vencimiento<mesActual){
        mensaje += '-Año de vencimiento invalido, seleccione un mes futuro';
        todo_correcto=false;
    }

    if(monto_autorizado <= 0){
        mensaje += '-Valor del monto incorrecto, selecciones un valor positivo';
        todo_correcto=false;
    }

    if(!todo_correcto){
        alert(mensaje);
    }
    return todo_correcto;
}