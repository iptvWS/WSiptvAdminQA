<?php
$accion = $_GET["act"]; // le faltaba esta instrucción antes del if
$uid = $_GET["uid"]; // le faltaba esta instrucción antes del if
$usr = $_GET["usr"]; // le faltaba esta instrucción antes del if
$id = $_GET["id"]; // le faltaba esta instrucción antes del if
$lista = $_GET["lista"]; // le faltaba esta instrucción antes del if
$nomusr = $_GET["nomusr"]; // le faltaba esta instrucción antes del if

echo "entra_".$accion;


$consecutivo=0;
$consecutivo=obtieneSiguiente($usr, $lista, $nomusr);
echo  "id".$consecutivo;
modificaArchivo($consecutivo);

if($accion=="descarga"){
    $lista=$_SERVER['REQUEST_URI'];
    $miindice= strpos($lista, "list=") ;
    $lista=substr($lista, $miindice+5);
    
    $zip = new ZipArchive;
    $fileToModify = 'manifest';
    if ($zip->open('1f708c583476_ea4b6387.zip') === TRUE) {
        //Read contents into memory
        $oldContents = $zip->getFromName($fileToModify);
        //Modify contents:
       // $newContents = str_replace('key', $_GET['param'], $oldContents);
        //Delete the old...
        $zip->deleteName($fileToModify);
            echo "borro";
        //Write the new...
        $zip->addFile($fileToModify);
        echo "_agregp_borro";
        //$zip->addFromString($fileToModify, $newContents);
        //And write back to the filesystem.
        $zip->close();
        /*REGRESA EL ARCHIVO*/
        
        
        
        $newfilename="1f708c583476_ea4b6387.zip";
        echo "_agregp_borro".$newfilename;
            if (file_exists($newfilename)) {
            echo "Existe";
            
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            Header ("Content-disposition: attachment; filename="."VpVTv.zip");
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            ob_clean();
            flush();
            //ob_end_clean();
            readfile($newfilename);
            
            
            
            exit;
            
        }
        
        
        
        
        /*TERMINA REGRESA EL ARCHIVO*/
        
        echo 'ok';
    } else {
        echo 'failed';
    }
}


function modificaArchivo($id){
    //echo "entra a modificar_";
    $file = "manifest";
    $fh = fopen($file,'r+');
    //echo "entra a modificar";
    // string to put username and passwords
    $propCompleta = '';
    
    while(!feof($fh)) {
       // echo "_en whilw";
        $user = explode('=',fgets($fh));
        
        // take-off old "\r\n"
        $propiedad= trim($user[0]);
        $valor = trim($user[1]);
        //echo "_en whilw3";
        // check for empty indexes
        if (!empty($propiedad) AND !empty($valor)) {
         //echo "__propiedad".$propiedad;
         //echo "valor".$valor;
        // echo "_en whilw4";
         if($propiedad=="build_id"){
          //   echo "escribe el valor";
             $valor=$id;
         }
         if($propiedad=="title"){
             //   echo "escribe el valor";
             $valor="VpVTv_".$id;
         }
         /*   if ($username == 'mahdi') {
                $password = 'okay';
            }
            */
            $propCompleta .= $propiedad . '=' . $valor;
            $propCompleta .= "\r\n";
            //echo $propCompleta;
        }
    }
    
    // using file_put_contents() instead of fwrite()
    file_put_contents('manifest', $propCompleta);
    
    fclose($fh); 
    
    
}

function obtieneSiguiente($usr, $lista, $nomusr){

    $conexion = null;
    $conexion = conectar_PostgreSQL("hyssxqqsenyzws", "f7393c156cc3f0fd9aa4c73673142c54a98a837bdf43fa73dc2392b55b176719"
        ,  "ec2-52-0-67-144.compute-1.amazonaws.com"
        , "dbreil1d2te41c");
    echo "conecto";
    $id= obtieneID( $conexion);
    echo modificarUid($conexion, $id, $usr, $lista, $nomusr);
    return $id;
}

function obtieneID( $conexion)
{
    $sql = "SELECT (MAX(ID))+1 FROM CSTCONTROL";
    $maxId = "";
    // Ejecutar la consulta:
    $rs = pg_query( $conexion, $sql );
    if( $rs )
    {
        // Obtener el número de filas:
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
                $maxId=$row[0];
                
            }
            
        }
        
        
    }
    
    
    return $maxId;
}

function modificarUid( $conexion, $id, $usr, $lista, $nomusr)
{
    $sql = "INSERT INTO CSTCONTROL(id, idroku,lista, permisos, usuario, nomusuario) VALUES(".$id.", '', '".$lista."','S','".$usr."','".$nomusr."')";

    //ECHO $sql;
    // Ejecutamos la consulta (se devolverá true o false):
    return pg_query( $conexion, $sql );
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

//UPDATE CSTCONTROL SET PERMISOS='N' WHERE ID=1234567890
?>