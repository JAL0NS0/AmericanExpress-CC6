function validarPassword(){
    var todo_correcto = true;
    var mensaje = 'PROBLEMAS CON EL FORMULARIO: \n';

    var contraseña1 = document.getElementById('contraseña').value;
    var contraseña2 = document.getElementById('confirmar').value;

    if(contraseña1!=contraseña2){
        todo_correcto=false;
        mensaje = mensaje + "-Las contraseñas no coinciden";
    }

    if(!todo_correcto){
        alert(mensaje);
    }

    return todo_correcto;
}