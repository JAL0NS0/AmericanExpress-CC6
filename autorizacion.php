<?php
    /* http://emisor/autorizacion?tarjeta=___&nombre=___&fecha_venc=___& num_seguridad=___&monto=___&tienda=___&formato=__ */
    date_default_timezone_set('America/Guatemala');

    // detalles de la conexion
    $host= "localhost";
    $puerto= "5432";
    $dbnombre= "AMERICAN_EXP";
    $usuario= "postgres";
    $contraseña = "1234";


    //Crear conexión
    $conn_string = "host=$host port=$puerto dbname=$dbnombre user=$usuario password=$contraseña";

    $dbconn = pg_connect($conn_string);

    // Revisamos el estado de la conexion en caso de errores.
    if(!$dbconn) {
        echo "Error: No se ha podido conectar a la base de datos\n";
        die();
    }

    $tarjeta= $_GET["tarjeta"];
    $nombre=$_GET["nombre"];
    $nombre = str_replace("_", " ", $nombre, $count);
    $vencimiento = $_GET["fecha_venc"];
    $año_vencimiento = substr($vencimiento, 0,4);
    $mes_vencimiento = substr($vencimiento, 4,2);
    $num_seg= $_GET["num_seguridad"];
    $monto= floatval($_GET["monto"]);
    $tienda = $_GET["tienda"];
    $formato = $_GET["formato"];

    /**Consultamos datos para verificación */
    /**Existencia de la tarjeta */
    $query= "SELECT t.numero, u.nombre, t.num_seg, t.vencimiento, t.m_autorizado, t.m_disponible
            FROM tarjeta as t, usuario as u
            WHERE u.nombre='$nombre' 
                AND t.numero='$tarjeta'
                AND t.num_seg='$num_seg'
                AND t.vencimiento='$año_vencimiento-$mes_vencimiento-30';";
    $result = pg_query($dbconn,$query);
    $filas = pg_num_rows($result);
    
    /**Existencia de la tienda */
    $query="SELECT * FROM tienda WHERE nombre='$tienda';";
    $datos_tiendas = pg_query($dbconn,$query);
        
    /**VALIDACION */
    if($filas > 0 AND $datos_tiendas){
        /**Monto disponible */
        $datos = pg_fetch_array($result, NULL, PGSQL_ASSOC);
        $disponible= floatval($datos['m_disponible']);

        /**ID de la tienda */
        $listado_tiendas= pg_fetch_array($datos_tiendas, NULL, PGSQL_ASSOC);
        $id_tienda = $listado_tiendas["id"];

        /**Verificar suficiente saldo disponible */
        if($disponible>=$monto){
            /**Si hay disponibilidad restamos el monto */
            $resta=$disponible-$monto;

            /**RESTAMOS AL SALDO DISPONIBLE */
            $query= "UPDATE public.tarjeta
            SET m_disponible= $resta
            WHERE numero='$tarjeta';";
            $result = pg_query($dbconn,$query);
            if($result){
                /** REGISTRAMOS EL CONSUMO */
                /** verificamos numeor de autorización siguiente */
                $query="SELECT MAX(autorizacion)
                FROM consumo;";
                $consulta = pg_query($dbconn,$query);
                $lista_MAX= pg_fetch_array($consulta, NULL, PGSQL_ASSOC);
                $autorizacion = 1000;
                if($lista_MAX){
                    $autorizacion = intval($lista_MAX['max'])+1;
                }
                
                $query="INSERT INTO public.consumo(
                    autorizacion, tienda_id, numero_tarjeta, fecha, monto)
                    VALUES ($autorizacion, $id_tienda, $tarjeta, '".date('Y-m-d h:i:s a', time())."', $monto);";
                $result = pg_query($dbconn,$query);
                if($result){
                    impresion(1,$tarjeta,$formato);
                }else{
                    impresion(0,$tarjeta,$formato);
                }
                
            }
            /**Si existe un error DENEGADO */
            else{
                impresion(0,$tarjeta,$formato);
            }
            
        }
        /**Si no hay saldo DENEGADO */
        else{
            impresion(0,$tarjeta,$formato);
        }
    }
    /**SI NO EXISTE TIENDA O TARJETA DENEGADO */
    else{
        impresion(0,$tarjeta,$formato);
    };
    
    function impresion($valido,$tarjeta,$formato){
        if($formato == 'XML' or $formato=='xml'){
            if($valido==1){
                imprimirXML($tarjeta,'APROBADO', 1);
            }else{
                imprimirXML($tarjeta,'DENEGADO',0);
            }
        }else if($formato= 'JSON' or $formato='json'){
            if($valido==1){
                imprimirJSON($tarjeta,'APROBADO', 1);
            }else{
                imprimirJSON($tarjeta,'DENEGADO',0);
            }
        }
    };

    function imprimirXML($tarjeta,$status,$numero) {
        echo "<autorizacion>
            <emisor>americanexpress</emisor>
            <tarjeta>$tarjeta</tarjeta>
            <status>$status</status>
            <numero>$numero</numero>
            </autorizacion>
            ";
    }
    function imprimirJSON($tarjeta,$status,$numero){
        echo "{“autorización” :
            { “emisor” : “americanexpress” ,
            “tarjeta” : “$tarjeta"."” ,
            “status” : “$status"."” ,
            “numero” : “$numero"."”
            }
        }
        ";
    }
    function generarCodigo($seed, $longitud) {
        $key = '';
        srand($seed);
        $pattern = '1234567890';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern[mt_rand(0,$max)];
        return $key;
    }
    
    function retirar($tarjeta,$monto){

    }
?>