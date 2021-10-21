<?php

    
        echo "entra a modificar_";
        $file = "itsTV2.m3u";
        $fileOrigen = "Config.brs";
        $fh = fopen($fileOrigen,'r+');
        //echo "entra a modificar";
        // string to put username and passwords
        
        
        
        $listaCompleta = fopen($file, "a") or die("Unable to open file!");
        

       $encabezado = "#EXTINF:-1 tvg-id=\"\" ";
        
        
        
       echo "<br>antes while";
        
        while(!feof($fh)) {//aqui va recorrer el otro archivo
            
            
            $linea=fgets($fh);
            
            $miindice= strpos($linea, "Function ") ;
            echo "<br>___el indice: ".$miindice;
            if(!empty($miindice) AND $miindice>=0){
                $grupo=substr($linea, $miindice+9);
                $miindiceFin= strpos($grupo, "()") ;
                echo "<br>en ciclo cuando el indice fue mayor 1 ".$grupo;
                $grupo=trim(substr($grupo, 0, $miindiceFin));
            }
            echo "<br>en ciclo while 2 ".$grupo;
            if(($grupo)=="loadConfig"){
                $grupo="ITSTV MEXICO";
            }else if ($grupo=="loadConfigNovelas"){
                $grupo="ITSTV NOVELAS";
            }elseif ($grupo=="loadConfigDiscoverys"){
                $grupo="ITSTV CULTURA";
            }elseif ($grupo=="loadConfigCartoons"){
                $grupo="ITSTV INFANTIL";
            }elseif ($grupo=="loadConfigPremium"){
                $grupo="ITSTV ENTRETENIMIENTO";
            }elseif ($grupo=="loadConfigPeliculas"){
                $grupo="ITSTV PELICULAS";
            }elseif ($grupo=="loadConfigMusic"){
                $grupo="ITSTV MUSICA";
            }elseif ($grupo=="loadConfigSports"){
                $grupo="ITSTV DEPORTES";
            }elseif ($grupo=="loadConfigPluto"){
                $grupo="ITSTV PLUTO";
            }elseif ($grupo=="loadConfig24hrs"){
                $grupo="ITSTV CANALES 24/7";
            }elseif ($grupo=="loadConfigMovistar"){
                $grupo="ITSTV MOVISTAR";
            }elseif ($grupo=="loadConfigPeru"){
                $grupo="ITSTV TV PERU";
            }elseif ($grupo=="loadConfigNoticias"){
                $grupo="ITSTV TV NOTICIAS";
            }elseif ($grupo=="loadConfigMovies"){
                $grupo="ITSTV PELICULAS DE ESTRENO";
            }else{
            
                echo "<br> en ciclo 3 while".$grupo;
            //LINEA PARA ESCRIBIRLE AL ARCHIVO ORIGINAL
            //  fwrite($listaCompleta, "\n". $txt);
            
            // echo "_en whilw";
            $lineaSeparada = explode(':',$linea);
            
            
            echo "<br> en ciclo 4 LIMEA SEP".$lineaSeparada;
            
            // take-off old "\r\n"
            $propiedad= trim($lineaSeparada[0]);
            $valor = trim($lineaSeparada[1]);
            
            echo "<br> Prop:_".$propiedad."_val_".$valor;
            
            //echo "_en whilw3";
            // check for empty indexes
            if (!empty($propiedad) AND !empty($valor)) {
                echo "<br> nINGUNO VACIO:________________________ ".$propiedad;
                echo "<br> nINGUNO VACIO:________________________ ".(strpos($propiedad, "Title"));
                //echo "__propiedad".$propiedad;
                //echo "valor".$valor;
                // echo "_en whilw4";
                if($propiedad=="{ Title"){
                    echo "<br> nINGUNO VACIO:asaasdadsasda_0___ ";
                    //   echo "escribe el valor";
                    $nombre="tvg-name='".$valor."'";
                    $nombreFin=", ".$valor;
                    
                    echo "<br> nINGUNO VACIO:asaasdadsasda____ ".$nombre;
                    
                    
                    
                } else if($propiedad=="Logo"){
                    echo "<br> logo::".$logo;
                    //   echo "escribe el valor";
                    $logo="tvg-logo='".$valor ."'";
                }
               /* if($propiedad=="Stream"){
                    //   echo "escribe el valor";
                    $nombre="tvg-logo=".$valor;
                }
                if($propiedad=="UserAgent"){
                    //   echo "escribe el valor";
                    $nombre="tvg-logo=".$valor;
                }
               */
                
                
                $lineaCompleta = $encabezado .$nombre .$logo .$grupo .$nombreFin;
                echo "<br> LineaComoQueda:::".$lineaCompleta;
                //echo $propCompleta;
            }else{ //AQUIVAN LAS URL
                $url=$linea;
            }
            
            if (!empty(trim($lineaCompleta)) AND !empty((trim($url)))) {
                $grupo="group-title='".$grupo."'";
                fwrite($listaCompleta, "\n". $lineaCompleta);
                fwrite($listaCompleta, "\n". $url);
                $lineaCompleta="";
                $grupo="";
                $url="";
            }
          
           
            
            //Ejemplo de elemento
            //#EXTINF:-1 tvg-id="" tvg-name="Outlander S05 E02" tvg-logo="http://cf8587662853df3ee.jpg" group-title="",Drama Outlander S05 E02
            //
            
         
            
            }
            
        }
        echo "casi termina";
        // using file_put_contents() instead of fwrite()
        fclose($fh);
        fclose($listaCompleta);
        
        
   

        ?>