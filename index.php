<!DOCTYPE html>
<html>
<head>

<meta charset="ISO-8859-1">
<title>it's TV</title>
 <link rel="shortcut icon" href="itsTV.png" />

<style type="text/css">
body {
  background: url("mybackgroundimage.gif") repeat;
}
#banner {
  position: fixed;
  top: 0px;
  left: 0px;
  right: 0px;
  width: 100%;
  height: 170px;
  z-index: 1;
   background-color:#330b2d;
  opacity: 0.9;
}
#div_lateral{
  position: fixed;
  z-index: 0; /*Crea una capa nueva por encima, si tenemos una con valor 2 estará a una altura o por encima de una con 
                valor 1*/
  
  top: 170px;
  left: 0px;
  right: 0px;

   height: 68%;
   width: 170px;
   background-image: url('');
   background-position: left;
   background-repeat: no-repeat;
   background-size: cover;
     background-size: 100% 100%;
  background-color:#330b2d;
  opacity: 0.9;
  margin-left:0px; /*Con este margen posicionamos el div donde queramos*/
}
</style>
<script data-ad-client="ca-pub-9702888902505497" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script type="text/javascript">
	var valRadio=-1;
	var uri="";
	
	function modificaPermisos(id,valor){
		window.open("<?php echo "utils.php?";?>"+"act=modifica&valor="+valor+"&id="+document.frameDet.document.getElementById("fila"+id).cells[1].innerHTML, "frameDet");
		alert("Permisos Modificados");
		window.open("<?php echo "utils.php?act=init";?>", "frameDet");
	}
	function resetPass(id,valor){
		window.open("<?php echo "utils.php?";?>"+"act=modificaPass&valor="+valor+"&id="+document.frameDet.document.getElementById("fila"+id).cells[1].innerHTML, "frameDet");
		alert("Password de Control Parental Reiniciado");
		window.open("<?php echo "utils.php?act=init";?>", "frameDet");
	}
	function resetLista(id,valor){
		window.open("<?php echo "utils.php?";?>"+"act=modificaLista&valor="+valor+"&id="+document.frameDet.document.getElementById("fila"+id).cells[1].innerHTML, "frameDet");
		alert("La Lista se Cargara en el Siguiente Inicio de Sesion");
		window.open("<?php echo "utils.php?act=init";?>", "frameDet");
	}
	function modificaDatos(btn){
		if(btn=="Aceptar"){
			window.open("<?php echo "utils.php?";?>"+"act=modificaDatos&id="+document.frameDet.document.getElementById("fila"+valRadio).cells[1].innerHTML+"&nomUser="+document.getElementById("nomUsuario").value+"&usaLista=S"+"&idUsuario="+document.getElementById("idUsuario").value+"&list="+document.getElementById("lista").value, "frameDet");
			alert("Datos modificados con Exito");
			cierraDiv();
			window.open("<?php echo "utils.php?act=init";?>", "frameDet");
		}else{
			
			if(document.getElementById("idUsuario").value=="" || document.getElementById("nomUsuario").value=="" || document.getElementById("lista").value==""){
				var respuesta = confirm("Desea generar el canal sin llenar por completo los datos?")
			}else{
				var respuesta=true;
			}
			if(respuesta == true){
    			window.open("<?php echo "descarga.php?act=descarga&usr=";?>"+document.getElementById("idUsuario").value+"&nomusr="+document.getElementById("nomUsuario").value+"&list="+document.getElementById("lista").value,  "frameDet");
    		   	alert("Canal Generado, Revise sus descargas");
    			cierraDiv();
    			window.open("<?php echo "utils.php?act=init";?>", "frameDet");
			}
			
		}
		
			
		
	}
	function selID(id){
		alert("Funcionalidad no disponible");
	}
	function setRadio(id){
		valRadio=id;
	}
	function generaCanal(){
		abrirGenera();
	}
	function abrirModifica() { //CASF.[7.1.1]
			
		document.getElementById("idUsuario").value=document.frameDet.document.getElementById("detalleUsuarios").rows[valRadio].cells[2].innerText;
		document.getElementById("nomUsuario").value=document.frameDet.document.getElementById("detalleUsuarios").rows[valRadio].cells[3].innerText;
		document.getElementById("lista").value=document.frameDet.document.getElementById("detalleUsuarios").rows[valRadio].cells[9].innerText;
		document.getElementById("btnAceptar").value="Aceptar";
		setSizePantalla();
		setCentro();
		
		document.getElementById("idModifica").style.width = xW + 'px';
		document.getElementById("idModifica").style.height = document.body.offsetHeight + 'px';
		document.getElementById("idModifica").style.backgroud = '#11ffee00';
		document.getElementById("idModifica").style.opacity = '0.1';
		document.getElementById("idModifica").style.visibility = 'visible';
		
		
		
		document.getElementById("modifica").style.left = xCentro - (400)+"px";  
		document.getElementById("modifica").style.top  = (yCentro) - (25)+"px"; 
		document.getElementById("modifica").style.display = '';
		document.getElementById("idModifica").style.opacity = '0.9';
		document.getElementById("idModifica").style.visibility = 'visible';
	
	}

	function abrirGenera() { //CASF.[7.1.1]
			
		document.getElementById("idUsuario").value="";
		document.getElementById("nomUsuario").value="";
		document.getElementById("lista").value="";
		
		document.getElementById("btnAceptar").value="Generar";
		
		setSizePantalla();
		setCentro();
		
		document.getElementById("idModifica").style.width = xW + 'px';
		document.getElementById("idModifica").style.height = document.body.offsetHeight + 'px';
		document.getElementById("idModifica").style.backgroud = '#11ffee00';
		document.getElementById("idModifica").style.opacity = '0.1';
		document.getElementById("idModifica").style.visibility = 'visible';
		
		
		
		document.getElementById("modifica").style.left = xCentro - (400)+"px";  
		document.getElementById("modifica").style.top  = (yCentro) - (25)+"px"; 
		document.getElementById("modifica").style.display = '';
		document.getElementById("idModifica").style.opacity = '0.9';
		document.getElementById("idModifica").style.visibility = 'visible';
	}	
	
	function cierraDiv(){
		document.getElementById("idModifica").style.visibility = 'hidden';
		document.getElementById("idModifica").style.visibility = 'hidden';
	}
	function setCentro(){//CASF.[7.1.1]
		if (window.innerWidth){ 
			
			setCentroXY(parseInt(window.innerWidth / 2), parseInt(window.innerHeight / 2));
		} else if(document.body.clientWidth){
		
			setCentroXY(parseInt(document.body.clientWidth / 2), parseInt(document.body.clientHeight / 2));
		}
	}	
	function setCentroXY(x, y){//CASF.[7.1.1]
		xCentro = x;
		yCentro = y;
	}
	function setSizePantalla() { //CASF.[7.1.1]
		if (window.innerWidth){
			xW = window.innerWidth;
			yH = window.innerHeight;
		} else if(document.body.clientWidth){
			xW = document.body.clientWidth;
			yH = document.body.clientHeight;
		}
	} /** setSizePantalla */
</script>
</head>
<body   style="background-image: url('');   background-position: left;
   background-repeat: no-repeat;
   background-size: cover;
   background-color:#330b2d;
     background-size: 100% 100%;text">


<font color="white">

<img id="banner" src="WTSPlay.jpg" style="" alt=""/>
<div id="div_lateral"  >
			 	<table >
			 	<tr height="50px">
			 			<td ><td>
			 		</tr>
			 		<tr height="50px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#CSTV" style="color: blue"></a><td>
			 		</tr>
			 		<tr height="50px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="alert('Seleccione permisos')" style="color: red">Bloqueo de Usuarios</a><td>
			 		</tr>
			 		<tr height="50px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="alert('Seleccione un registro')" style="color: blue">Editar Usuario</a><td>
			 		</tr>
			 		<tr height="50px">
			 		 
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="alert('Presionar + Generar Canal')"  style="color: red">Generar Canales</a><td>
			 		</tr>
			 		<tr height="50px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#CSTV" style="color: blue"></a><td>
			 		</tr>
			 		<tr height="50px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#CONTACTO" style="color: red"></a><td>
			 		</tr>
			 		<tr height="10px">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#CONTACTO"  style="color: blue"></a>
			 		<tr height="10px" align="right">
			 			<td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a   style="color: red">
	 		
	&nbsp;&nbsp;
	</a>
	
	<td>	</tr>	 		
			 	</table>
			 </div>
<table  >
		<tr height="200px"   >
			<td   width="220px"  >
			
			</td>
			<td   width="220px"  >
			
			</td>
			<td   width="220px"  >
			
			</td>
			
		</tr>
		
		<tr height="20%" >
			
			
		</tr>
		
		<tr height="80%"  >
			<td   width="220px"  >
			
			</td>
			<td    colspan="2">
			<table>
			<tr>
			<td>
				    <h1>Mantenimiento y Bloqueo de Dispositivos</h1>
    				<p>Seleccione el registro para editar o seleccione estatus de bloqueo</p>
					
			
				</td>
			</tr>
			<tr>
				<td  align="right" height="10px" style='vertical-align: top' >
				  <img id='agrega' src='mas.png' width='20px' height='20px' style='vertical-align: top' onclick='generaCanal()' alt=''/> Generar nuevo canal&nbsp;&nbsp;&nbsp;
				</td>
			
			</tr>
			</table>	
			</td>
		</tr>
		
			
				</td>
				
		</tr>
		
		
		
		<tr height="80%" >
			<td   width="220px"  >
			 
			</td>
			<td colspan="2" id="desarrollador" width="80%">
			<iframe width="100%" height="500px" id="frameDet" name="frameDet" src="utils.php?act=init" style="border: none;" >
				<font color="white">
				</font>
			</iframe> 
				    <!-- 
				    <table id ="detalleUsuarios" cellpadding="1" cellspacing="1" border="1" style="border: 1px solid white;" > 
				    	<tr id="encabezado" style="border-width: 2px" id="fila0">
				    		<td >Sel </td>
				    		<td > ID Canal </td>
				    		<td > ID Usuario </td>
				    		<td > Usuario </td>
				    		<td > ID de dispositivo </td>
				    		<td > IP de conexi�n </td>
				    		
				    		<td > Permisos </td>
				    		<td id="cdLista" style="display:none ; width: 0px" width="0px" > </td>
				    	</tr>
				    	<tr style="border-width: 2px" id="fila1">
				    	<td ><input id="radioSel" value="1" onclick="setRadio(this.value)"
										name="radioSel"  type="radio"
										> </td>
				    		<td >1 </td>
				    		<td >Usuario1 </td>
				    		<td >PANCHO ROBLES </td>
				    		<td >123456 </td>
				    		<td >10.123.12.01 </td>
				    		
				    		<td >Permisos: <select>
				    				<option>S</option>
				    				<option>N</option>
				    			  </select> 
				    		</td>
				    		<td id="cdLista" style="display:none ;" >http://IP:PUERTO2/ </td>
				    	</tr>
				    	<tr  style="border-width: 2px" id="fila2">
				    	<td ><input id="radioSel" value="2" onclick="setRadio(this.value)"
										name="radioSel"  type="radio"
										> </td>
				    		<td >2 </td>
				    		<td >Usuario2 </td>
				    		<td >PANCHO ROBLES 2</td>
				    		<td >123456 </td>
				    		<td >10.123.12.01 </td>
				    		
				    		<td >Permisos: <select>
				    				<option>S</option>
				    				<option>N</option>
				    			  </select> 
				    		</td>
				    		<td id="cdLista" style="display:none ;" width="0px" >http://IP:PUERTO3/ </td>
				    	</tr>
				    	<tr id="encabezado" style="border-width: 2px" id="fila3">
				    	<td ><input id="radioSel" value="3" onclick="setRadio(this.value)"
										name="radioSel"  type="radio"
										> </td>
				    		<td >3 </td>
				    		<td >Usuario3 </td>
				    		<td >PANCHO ROBLES 3</td>
				    		<td >123456 </td>
				    		<td >10.123.12.01 </td>
				    		
				    		<td >Permisos: <select>
				    				<option>S</option>
				    				<option>N</option>
				    			  </select> 
				    		</td>
				    		<td id="cdLista" style="display:none ;" width="0px" >http://IP:PUERTO4/ </td>
				    	</tr>
				    	<tr id="encabezado" style="border-width: 2px" id="fila4">
				    	<td ><input id="radioSel" value="4" onclick="setRadio(this.value)"
										name="radioSel"  type="radio"
										> </td>
				    		<td >4  </td>
				    		<td >Usuario4 </td>
				    		<td >PANCHO ROBLES 4</td>
				    		<td >123456 </td>
				    		<td >10.123.12.01 </td>

				    		<td >Permisos: <select>
				    				<option>S</option>
				    				<option>N</option>
				    			  </select> 
				    		</td>
				    	<td id="cdLista" style="display:none ;" width="0px" >http://IP:PUERTO5/ </td>
				    	</tr>
				    	<tr id="encabezado" style="border-width: 2px" id="fila5">
				    	<td ><input id="radioSel" value="5" onclick="setRadio(this.value)"
										name="radioSel"  type="radio"
										> </td>
				    		<td >5 </td>
				    		<td >Usuario5 </td>
				    		<td >PANCHO ROBLES 5</td>
				    		<td >123456 </td>
				    		<td >10.123.12.01 </td>
				    	
				    		<td >Permisos: <select id="5" onchange='modificaPermisos (this.id, this.value);'>
				    				<option >S</option>
				    				<option >N</option>
				    			  </select> 
				    		</td>
				    	<td id="cdLista" style="display:none ;" width="0px"  >http://IP:PUERTO6/ </td>
				    	</tr>
				    	
				    	
				    	
				    </table>

				</td>
		</tr>
	-->
		<tr height="80%" >
			<td   width="220px"  >
			
			</td>
			<td colspan="2" >
				    <h1>Soporte Tecnico</h1>
				    <p>Para soporte y apoyo es necesario que vayas a </p>
    				<a href="https://t.me/cs_IPTV">Nuestro grupo de telegram</a>
    				<p>Recuerda apoyar nuestro canal de youtube</p>
    				<p>Y apoyar dando click en la publicidad</p>
				<br>
					<br>
					<a  id="CONTACTO"></a>	
				</td>
		</tr>
		<tr height="80%" >
			
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
		<tr height="80%" >
			
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
		
		<tr height="80%" >
		
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
		<tr height="80%" >
		
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
		<tr height="80%" >
		
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
		<tr height="80%" >
		
			<td colspan="3">
				    <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
				</td>
		</tr>
	</table>
<!--   <div  class="barra-lateral" style="background-image: url('iptv13.png');  background-size:cover;"> -->
    
<!--   </div> -->
<!--   <div class="contenido"> -->
<!--     <h1>Otro tÃ­tuloâ¦</h1> -->
<!--     <p>Otro texto</p> -->
<!--     <p>MÃ¡s textoâ¦ </p> -->
<!--   </div> -->
</font>
<font color="white">
<div id="idModifica" align="center" style="left: 0; top: 0; position: absolute; visibility:hidden;background-color:#330b2d;" >
<table border="0" align="center">
<tbody align="center">	
	<tr align="center">
		<td align="center">
			<div id="modifica" style=" left: 0; top: 0; position: fixed;border: 1px solid white;" >
	  <table  border="0" cellpadding="1" cellspacing="0">
		<tr>
			<td colspan="5" style="align-content: center;" align="center">
				Edici&oacute;n de usuario
			</td>
			
		</tr>
		<tr>
			<td >
			</td>
			<td>
			<td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				ID Usuario:
			<td>
				<input type="text" size="30" maxlength="30" name="idUsuario" id="idUsuario" value="">
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				Nombre Usuario:
			<td>
				<input type="text" size="70" maxlength="200" name="nomUsuario" id="nomUsuario" value="">
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
				Lista:
			<td>
				<textarea  name="lista" size="200" cols="70	" rows="10" maxlength="200"  id="lista" >
				http://IP:PORT/
				</textarea>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		<tr align="center">
			<td >
			</td>
			<td  >
				
			</td>
			<td >
			
			<input type="button" onclick="modificaDatos(this.value)" id="btnAceptar" value="Aceptar">
			<input type="button" onclick="cierraDiv();" value="Cancelar">
			</td>
			<td >  
				
			</td>
			<td >
			</td>
		</tr>
	</table>
				</div>
		</td>
	</tr>
	
</tbody>
</table>
</div>
</font>
</body>
</html>