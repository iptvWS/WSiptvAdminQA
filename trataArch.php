<?php

    
        echo "entra a modificar_";
        $file = "itsTV2.m3u";
        $fileOrigen = "Config.brs";
        $fh = fopen($fileOrigen,'r+');
        //echo "entra a modificar";
        // string to put username and passwords
        
        
        
        $listaCompleta = fopen($file, "a") or die("Unable to open file!");
        

       $encabezado = "#EXTINF:-1 tvg-id='' ";
        
        
        
       echo "antes while";
        
        while(!feof($fh)) {//aqui va recorrer el otro archivo
            
            echo "en ciclo while";
            $linea=fgets($fh);
            $miindice= strpos($linea, "Function ") ;
            $grupo=substr($linea, $miindice+9);
            
            if($grupo=="loadConfig()"){
                $grupo="ITSTV MEXICO";
            }else if ($grupo=="loadConfigNovelas()"){
                $grupo="ITSTV NOVELAS";
            }elseif ($grupo=="loadConfigDiscoverys()"){
                $grupo="ITSTV CULTURA";
            }elseif ($grupo=="loadConfigCartoons()"){
                $grupo="ITSTV INFANTIL";
            }elseif ($grupo=="loadConfigPremium()"){
                $grupo="ITSTV ENTRETENIMIENTO";
            }elseif ($grupo=="loadConfigPeliculas()"){
                $grupo="ITSTV PELICULAS";
            }elseif ($grupo=="loadConfigMusic()"){
                $grupo="ITSTV MUSICA";
            }elseif ($grupo=="loadConfigSports()"){
                $grupo="ITSTV DEPORTES";
            }elseif ($grupo=="loadConfigPluto()"){
                $grupo="ITSTV PLUTO";
            }elseif ($grupo=="loadConfig24hrs()"){
                $grupo="ITSTV CANALES 24/7";
            }elseif ($grupo=="loadConfigMovistar()"){
                $grupo="ITSTV MOVISTAR";
            }elseif ($grupo=="loadConfigPeru()"){
                $grupo="ITSTV TV PERU";
            }elseif ($grupo=="loadConfigNoticias()"){
                $grupo="ITSTV TV NOTICIAS";
            }elseif ($grupo=="loadConfigMovies()"){
                $grupo="ITSTV PELICULAS DE ESTRENO";
            }else{
            
            
            //LINEA PARA ESCRIBIRLE AL ARCHIVO ORIGINAL
            //  fwrite($listaCompleta, "\n". $txt);
            
            // echo "_en whilw";
            $lineaSeparada = explode(':',$linea);
            
            // take-off old "\r\n"
            $propiedad= trim($lineaSeparada[0]);
            $valor = trim($lineaSeparada[1]);
            //echo "_en whilw3";
            // check for empty indexes
            if (!empty($propiedad) AND !empty($valor)) {
                //echo "__propiedad".$propiedad;
                //echo "valor".$valor;
                // echo "_en whilw4";
                if($propiedad=="Title"){
                    //   echo "escribe el valor";
                    $nombre="tvg-name='".$valor."'";
                    $nombreFin=", ".$valor;
                } else if($propiedad=="Logo"){
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
                $grupo="group-title='".$grupo."'";
                
                $lineaCompleta = $encabezado .$nombre .$logo .$grupo .$nombreFin;
                
                //echo $propCompleta;
            }else{ //AQUIVAN LAS URL
                $url=$linea;
            }
            
            if (!empty(trim($lineaCompleta)) AND !empty((trim($url)))) {
                fwrite($listaCompleta, "\n". $lineaCompleta);
                fwrite($listaCompleta, "\n". $url);
                $lineaCompleta="";
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