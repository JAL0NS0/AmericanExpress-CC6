<?php
    $id= $_GET["id"];

    function generarCodigo($seed, $longitud) {
        $key = '';
        srand($seed);
        $pattern = '1234567890';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
        return $key;
    }  

    echo generarCodigo($id,16);
    echo "<br>". generarCodigo($id*3141592,3)
?>