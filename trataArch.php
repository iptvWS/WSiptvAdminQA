<?php

    
        echo "entra a modificar_";
        $file = "itsTV2.m3u";
        $fileOrigen = "Config.brs";
        $fh = fopen($fileOrigen,'r+');
        //echo "entra a modificar";
        // string to put username and passwords
        
        
        
        $listaCompleta = fopen($file, "a") or die("Unable to open file!");
        

       $encabezado = "#EXTINF:-1 tvg-id=\"\" ";
        
       $logo="";
        
       echo "<br>antes while";
        
        while(!feof($fh)) {//aqui va recorrer el otro archivo
            
            
            $linea=fgets($fh);
            //$lineaURL=fgets($fh);
            $miindice= strpos($linea, "Function ") ;
            $lineaCompleta="";
            $url="";
            echo "<br>___Linea a Procesar: ".$linea.("__".($linea=="}\n")."/_");
            $miindice2=-1;
            $miindice2= strpos($linea, "}") ;
            echo "<br>___eSCIERRE_?: ".$miindice2;
            echo "<br>___1__?: ".($miindice2==0);
            echo "<br>___2__?: ".($miindice2=="0");
            echo "<br>___3__?: ".($miindice2>=0);
            echo "<br>___4__?: ".($miindice2<>0);
            echo "<br>___5__?: ".($miindice2!=0);
            
            echo "<br>___6__?: ".($miindice2<>1);
            echo "<br>___7__?: ".($miindice2!=1);
            
            if (!empty($miindice2)){
            
                ECHO "<br>QUE PEDOOOOO?";
                
                echo "<br> Esta armando  completo????????????:".$lineaCompleta;
                fwrite($listaCompleta, "\n". $lineaCompleta);
                fwrite($listaCompleta, "\n". $url);
                $lineaCompleta="";
                $grupo="";
                $url="";
                
                
            }else{
                
            if(!empty($miindice) AND $miindice>=0){
                $grupo=substr($linea, $miindice+9);
                $miindiceFin= strpos($grupo, "()") ;
                echo "<br>en ciclo cuando el indice fue mayor 1 ".$grupo;
                $grupo=trim(substr($grupo, 0, $miindiceFin));
            }
            
            echo "<br>en ciclo while 2 ".$grupo;
            if(($grupo)=="loadConfig"){
                $grupo="ITSTV MEXICO";
                $grupo="group-title='".$grupo."'";
            }else if ($grupo=="loadConfigNovelas"){
                $grupo="ITSTV NOVELAS";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigDiscoverys"){
                $grupo="ITSTV CULTURA";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigCartoons"){
                $grupo="ITSTV INFANTIL";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigPremium"){
                $grupo="ITSTV ENTRETENIMIENTO";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigPeliculas"){
                $grupo="ITSTV PELICULAS";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigMusic"){
                $grupo="ITSTV MUSICA";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigSports"){
                $grupo="ITSTV DEPORTES";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigPluto"){
                $grupo="ITSTV PLUTO";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfig24hrs"){
                $grupo="ITSTV CANALES 24/7";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigMovistar"){
                $grupo="ITSTV MOVISTAR";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigPeru"){
                $grupo="ITSTV TV PERU";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigNoticias"){
                $grupo="ITSTV TV NOTICIAS";
                $grupo="group-title='".$grupo."'";
            }elseif ($grupo=="loadConfigMovies"){
                $grupo="ITSTV PELICULAS DE ESTRENO";
                $grupo="group-title='".$grupo."'";
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
               
                //echo "__propiedad".$propiedad;
                //echo "valor".$valor;
                // echo "_en whilw4";
                if(strpos($propiedad, "Title")>0){
                    echo "<br> nINGUNO VACIO:asaasdadsasda_0___ ";
                    //   echo "escribe el valor";
                    $nombre="tvg-name=".$valor;
                    $nombreFin=", ".$valor;
                    
                    echo "<br> nINGUNO VACIO:asaasdadsasda____ ".$nombre;
                    
                    
                    
                } else if(strpos($propiedad, "Logo")<>""){
                    echo "<br> nINGUNO VACIO22222:asaasdadsasda____ ".$nombre;
                    //   echo "escribe el valor";
                    $logo="tvg-logo=".$valor .$lineaSeparada[2] ." ";
                } else if(strpos($propiedad, "Stream")<>""){
                    echo "<br> URL____ ".$valor;
                    //   echo "escribe el valor";
                    
                    $url=$valor .$lineaSeparada[2].$lineaSeparada[3];
                    echo "<br> URL2____ ".$url;
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
               
                $lineaCompleta = $encabezado .$nombre ." ".$logo .$grupo .$nombreFin;
                echo "<br> LineaComoQueda:::".$lineaCompleta;
                //echo $propCompleta;
            }
            
            }
            
            }
           
            
            //Ejemplo de elemento
            //#EXTINF:-1 tvg-id="" tvg-name="Outlander S05 E02" tvg-logo="http://cf8587662853df3ee.jpg" group-title="",Drama Outlander S05 E02
            //
            
        
            
        }
        echo "casi termina";
        // using file_put_contents() instead of fwrite()
        fclose($fh);
        fclose($listaCompleta);
        
        
   

        ?>