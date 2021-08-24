<?php
$accion = $_GET["act"]; // le faltaba esta instrucciï¿½n antes del if
$uid = $_GET["uid"]; // le faltaba esta instrucciï¿½n antes del if
$id = $_GET["id"]; // le faltaba esta instrucciï¿½n antes del if
$lista = $_GET["list"]; // le faltaba esta instrucciï¿½n antes del if
$valor = $_GET["valor"]; // le faltaba esta instrucciï¿½n antes del if
$nomUser = $_GET["nomUser"]; // le faltaba esta instrucciï¿½n antes del if
$idUsuario = $_GET["idUsuario"]; // le faltaba esta instrucciï¿½n antes del if
$usaLista = $_GET["usaLista"]; // le faltaba esta instrucciï¿½n antes del if






if($accion=="init"){
    // "Definiciï¿½n" de la base de datos
    $conexion = null;
    $conexion = conectar_PostgreSQL("hyssxqqsenyzws", "f7393c156cc3f0fd9aa4c73673142c54a98a837bdf43fa73dc2392b55b176719"
        ,  "ec2-52-0-67-144.compute-1.amazonaws.com"
        , "dbreil1d2te41c");
    //listarPersonas($conexion, $id);
    
    $salida= obtieneRegistros($conexion, $id);
    pg_close($conexion);
    
    echo  $salida;
    
}else if($accion=='modifica'){
    // abrir en modo sï¿½lo lectura
    echo "id___".$id;
    // "Definiciï¿½n" de la base de datos
    $conexion = null;
    $conexion = conectar_PostgreSQL("hyssxqqsenyzws", "f7393c156cc3f0fd9aa4c73673142c54a98a837bdf43fa73dc2392b55b176719"
        ,  "ec2-52-0-67-144.compute-1.amazonaws.com"
        , "dbreil1d2te41c");
    //listarPersonas($conexion, $id);
    
    $salida= modificarAuth($conexion, $id, $valor);
    pg_close($conexion);
    echo "modifica";
    echo  $salida;
    
    
    
}else if($accion=='modificaDatos'){
    // abrir en modo sï¿½lo lectura
    echo "id__ModificaDatos_".$id;
    // "Definiciï¿½n" de la base de datos
    $conexion = null;
    $conexion = conectar_PostgreSQL("hyssxqqsenyzws", "f7393c156cc3f0fd9aa4c73673142c54a98a837bdf43fa73dc2392b55b176719"
        ,  "ec2-52-0-67-144.compute-1.amazonaws.com"
        , "dbreil1d2te41c");
    //listarPersonas($conexion, $id);
    
    $salida= modificarDatos( $conexion, $id, $idUsuario, $nomUser, $lista);
    pg_close($conexion);
    echo "modifica";
    echo  $salida;
    
    
    
}else if($accion=='list'){
    
    $lista=$_SERVER['REQUEST_URI'];
    $miindice= strpos($lista, "list=") ;
    $lista=substr($lista, $miindice+5);
    
    
    $newfilename = "1f708c583476_ea4b6387-eec9-5a8c.zip";
    unlink($uid.$newfilename);
    
    
    $conexion = null;
    $conexion = conectar_PostgreSQL("hyssxqqsenyzws", "f7393c156cc3f0fd9aa4c73673142c54a98a837bdf43fa73dc2392b55b176719"
        ,  "ec2-52-0-67-144.compute-1.amazonaws.com"
        , "dbreil1d2te41c");
    
    if ($lista=="" || strpos($lista, "IP:PUERTO")>0){
        echo "URL_".obtienelistaD($conexion);
    }else{
        modificarUrl($conexion, $lista, $id);
        ECHO "AUTORIZADO";
    }
    pg_close($conexion);
    
}else if($accion=='borraArch'){
    ;
}

function base64url_decode($base64url)
{
    $base64 = strtr($base64url, '-_', '+/');
    $plainText = base64_decode($base64);
    return ($plainText);
}


function conectar_PostgreSQL( $usuario, $pass, $host, $bd )
{
    $conexion = null;
    try
    {
        $conexion = pg_connect( "user=".$usuario." ".
            "password=".$pass." ".
            "host=".$host." ".
            "dbname=".$bd
            );
        if( $conexion == false )
            throw new Exception( "Error PostgreSQL ".pg_last_error() );
    }
    catch( Exception $e )
    {
        throw $e;
    }
    return $conexion;
}

function listarPersonas( $conexion , $id)
{
    $sql = "SELECT * FROM CSTCONTROL WHERE ID=".$id;
    $ok = true;
    // Ejecutar la consulta:
    $rs = pg_query( $conexion, $sql );
    if( $rs )
    {
        // Obtener el nï¿½mero de filas:
        if( pg_num_rows($rs) > 0 )
        {
            //echo "<p/>LISTADO DE PERSONAS<br/>";
            //echo "===================<p />";
            // Recorrer el resource y mostrar los datos:
            //while( $obj = pg_fetch_object($rs) )
            //    echo $obj->id." - ".$obj[0]->nombre."<br />";
            //    echo $obj->id." - ".$obj[1]->nombre."<br />";
            //}
            
            
            while ($row = pg_fetch_row($rs)) {
                echo "Author: $row[0]  E-mail: $row[1]";
                echo "<br />\n";
            }
            
        }else
            echo "<p>No se encontraron personas</p>";
    }
    else
        $ok = false;
        return $ok;
}


function obtieneRegistros( $conexion , $id)
{
    $sql = "SELECT ID, USUARIO, NOMUSUARIO, IDROKU, IP , PERMISOS, LISTA FROM CSTCONTROL WHERE ID>5 ORDER BY ID";
    
   // <td > ID Usuario </td>
   // <td > Usuario </td>
   // <td > ID de dispositivo </td>
   // <td > IP de conexión </td>
   // <td > Permisos </td>
    $tabla="<html><font color='white'><body ><table id ='detalleUsuarios' style='color: white;' width='100%' height='100%'  cellpadding='1' cellspacing='1' border='1' style='border: 1px solid white;' > ";
    $tabla.="<tr id='encabezado' style='border-width: 2px' id='fila0'>	<td nowrap> Sel </td><td nowrap> ID Canal </td> <td nowrap> ID Usuario </td> <td nowrap> Nombre Usuario </td><td nowrap> ID de dispositivo </td><td nowrap> IP de conexi&oacute;n </td><td nowrap> Dispositivo Habilitado </td> <td id='cdLista' style='display:none ; width: 0px' width='0px' > </td>  </tr>";
  
    $cont=0;
    // Ejecutar la consulta:
    $rs = pg_query( $conexion, $sql );
    if( $rs )
    {
        
        // Obtener el nï¿½mero de filas:
        if( pg_num_rows($rs) > 0 )
        {
           
            // echo "<p/>LISTADO DE PERSONAS<br/>";
            //echo "===================<p />";
            // Recorrer el resource y mostrar los datos:
            //while( $obj = pg_fetch_object($rs) )
            //    echo $obj->id." - ".$obj[0]->nombre."<br />";
            //    echo $obj->id." - ".$obj[1]->nombre."<br />";
            //}
            
           
            while ($row = pg_fetch_row($rs)) {
               
                //  echo "idRoku:". $row[0];
                $cont=$cont+1;
               
                $tabla.="<tr style='border-width: 2px' id='fila".$cont."'>";
                $tabla.="<td nowrap>";
                $tabla.="<input id='radioSel' name='radioSel'  type='radio' value='".$cont."' onclick='parent.setRadio(this.value)'>";
                $tabla.="</td>";
                $tabla.="<td nowrap>".$row[0]."</td>";
                $tabla.="<td nowrap>".$row[1]."</td>";
                $tabla.="<td nowrap>".$row[2]."</td>";
                $tabla.="<td nowrap>".$row[3]."</td>";
                $tabla.="<td nowrap>".$row[4]."</td>";
                $tabla.="<td nowrap><select id='".$cont."' onchange='parent.modificaPermisos (this.id, this.value);'>";
                $tabla.="<option value='S' ".($row[5]=="S"?"selected":"").">S</option><option value='N' ".($row[5]=="N"?"selected":"").">N</option>";
                $tabla.="<td nowrap style='display:none ;'>".$row[6]."</td>";
                $tabla.="</select></td>";
                
                $tabla.="</tr>";
            }
            
        }else{
            $tabla.="<tr style='border-width: 2px' id='fila".$cont."'>";
            $tabla.="<td ></td><td ></td>"."<td ></td>"."<td ></td>"."<td ></td>";
            $tabla.="</tr>";
            //echo "<p>No se encontraron personas</p>";
        }
        
        
    }
   
   
    $tabla.="</font></body></html>";
    error_log("Error::::::::::::::: ".$tabla, 0);
    echo $tabla;
    return "";
}


function modificarAuth( $conexion, $id, $permisos)
{
    $sql = "UPDATE CSTCONTROL SET PERMISOS='".$permisos."' WHERE ID=".$id;
    // Ejecutamos la consulta (se devolverï¿½ true o false):
    return pg_query( $conexion, $sql );
}
function modificarDatos( $conexion, $id, $idUsuario, $nomUsuario, $lista)
{   
    echo "EntraMod";
    echo "LISTA".$lista;
    $sql = "UPDATE CSTCONTROL SET IDUSUARIO='".$idUsuario."', NOMUSUARIO='".$nomUsuario."', LISTA='".$lista."', USALISTA='S', RESETPASS='S' , FECHAMODIFICA=CURRENT_TIMESTAMP    WHERE ID=".$id;
    echo "\n".$sql;
    // Ejecutamos la consulta (se devolverï¿½ true o false):
    return pg_query( $conexion, $sql );
}


function modificarUid( $conexion, $uid, $id, $ip)
{
    $sql = "UPDATE CSTCONTROL SET IDROKU='".$uid."', IP='".$ip."', CONTIP=1 WHERE ID=".$id;
    //ECHO $sql;
    // Ejecutamos la consulta (se devolverï¿½ true o false):
    return pg_query( $conexion, $sql );
}

function modificarIP( $conexion, $uid, $id, $ip)
{
    $sql = "UPDATE CSTCONTROL SET IP='".$ip."', CONTIP=CONTIP+1  WHERE ID=".$id;
    //ECHO $sql;
    // Ejecutamos la consulta (se devolverï¿½ true o false):
    return pg_query( $conexion, $sql );
}

function modificarUrl( $conexion, $lista, $id )
{
    $sql = "UPDATE CSTCONTROL SET LISTA='".$lista."' WHERE ID=".$id;
    //ECHO $sql;
    // Ejecutamos la consulta (se devolverï¿½ true o false):
    return pg_query( $conexion, $sql );
}
function obtienelistaD( $conexion)
{
    $sql = "SELECT LISTA FROM CSTCONTROL WHERE ID=1";
    $url = "NOAUTORIZADO";
    
    // Ejecutar la consulta:
    $rs = pg_query( $conexion, $sql );
    if( $rs )
    {
        // Obtener el nï¿½mero de filas:
        if( pg_num_rows($rs) > 0 )
        {
            // echo "<p/>LISTADO DE PERSONAS<br/>";
            //echo "===================<p />";
            // Recorrer el resource y mostrar los datos:
            //while( $obj = pg_fetch_object($rs) )
            //    echo $obj->id." - ".$obj[0]->nombre."<br />";
            //    echo $obj->id." - ".$obj[1]->nombre."<br />";
            //}
            
            
            while ($row = pg_fetch_row($rs)) {
                //  echo "idRoku:". $row[0];
                $url=$row[0];
                
                
            }
            
        }else{
            $url="NOAUTORIZADO";
            
            //echo "<p>No se encontraron personas</p>";
        }
        
        
    }
    
    return $url;
}

function obtieneIP( $conexion, $id)
{
    $sql = "SELECT IP FROM CSTCONTROL WHERE ID=".$id;
    $ip = "";
    
    // Ejecutar la consulta:
    $rs = pg_query( $conexion, $sql );
    if( $rs )
    {
        
        // Obtener el nï¿½mero de filas:
        if( pg_num_rows($rs) > 0 )
        {
            
            //echo "===================<p />";
            // Recorrer el resource y mostrar los datos:
            //while( $obj = pg_fetch_object($rs) )
            //    echo $obj->id." - ".$obj[0]->nombre."<br />";
            //    echo $obj->id." - ".$obj[1]->nombre."<br />";
            //}
            
            
            while ($row = pg_fetch_row($rs)) {
                //  echo "idRoku:". $row[0];
                $ip=$row[0];
                
                
            }
            
        }else{
            $ip="";
            
            //echo "<p>No se encontraron personas</p>";
        }
        
        
    }
    
    return $ip;
}



//UPDATE CSTCONTROL SET PERMISOS='N' WHERE ID=1234567890


function getIPAddress() {
    //whether ip is from the share internet
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address
    else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


?>