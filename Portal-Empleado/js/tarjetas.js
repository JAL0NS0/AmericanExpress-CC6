function buscar(){
    var numero = document.getElementById('num_tarjeta').value;
    var nombre = document.getElementById('nombre').value;
    var url = "tarjetas.php?num="+numero+"&nom="+nombre;

    location.href=url;
}