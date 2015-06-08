<?php
/**
 * Datos del Formulario
 */
$comando	=	isset($_POST['comando'])	?	$_POST['comando']	:	'';

// Datos del Lienzo
$lienzo	=	isset($_POST['lienzo'])	?	$_POST['lienzo']	:	'';
$ancho	=	isset($_POST['ancho'])	?	$_POST['ancho']		:	'';
$alto	=	isset($_POST['alto'])	?	$_POST['alto']		: 	'';

// Datos de la Línea	
$x1		=	isset($_POST['x1'])		?	$_POST['x1']		:	0;
$y1		=	isset($_POST['y1'])		?	$_POST['y1']		:	0;
$x2		=	isset($_POST['x2'])		?	$_POST['x2']		:	0;
$y2		=	isset($_POST['y2'])		?	$_POST['y2']		:	0;

// Tarea a ejecutar
$tarea	=	isset($_POST['tarea'])	?	$_POST['tarea']		:	'';

// Si el comando es para crear el lienzo, entonces asignar a la variable lienzo el valor del comando
if ($tarea == 'Crear'){
	$lienzo = 'C';
}
if ($comando == 'Q'){
	$lienzo = '';
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>...::: Drawing Tool :::...</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="author" content="J. Alexander Vargas G.">
	<meta name="copyright" content="2015 - JAVG">
	
	<script type="text/javascript">
		function ObtenerDatos( comando ){
			if ((comando == 'L') || (comando == 'R')){
				// Pedimos al usuario que introduzca las coordenadas
				var inicio = prompt('Digite el Punto Inicial (X,Y):');
				var fin = prompt('Digite el Punto Final (X,Y):');
				var i = inicio.split(',')
				var f = fin.split(',')
				document.forms[0].x1.value = i[0]
				document.forms[0].y1.value = i[1]
				document.forms[0].x2.value = f[0]
				document.forms[0].y2.value = f[1]			
			}
			document.forms[0].submit();
		}
	</script>
	
</head>
<body>

	<center style="background:none">
		<div id="datos">
			<form method="POST" action="" style="font: normal 0.9em verdana">
				<center>
					<table border="0">
						<tr align="center" style="color:blue;">
							<td colspan="2">DIBUJA</td>
						</tr>
						<tr>
							<td colspan="2">Comienza a dibujar con los siguientes comandos:</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php 
									if ($lienzo == 'C'){
								?>
										L: Nueva Línea <br>
										R: Nuevo Rectángulo <br>
										Q: Salir
								<?php
									}
									else{						
								?>
										C: Nuevo Lienzo
								<?php
									}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<?php 
							if ($lienzo == 'C'){
						?>
								<tr>						
									<td>Digita el Comando:</td>
									<td>
										<input type="text" name="comando" onkeyup="ObtenerDatos(this.value)">
										<input type="hidden" name="ancho" value="<?php echo $ancho; ?>">
										<input type="hidden" name="alto" value="<?php echo $alto; ?>">
									</td>
								</tr>									
						<?php
							}
							else{
						?>
								<tr>								
									<td>Ancho:</td>
									<td><input type="text" name="ancho" value="<?php echo $ancho; ?>"></td>
								<tr>
								<tr>						
									<td>Alto:</td>
									<td><input type="text" name="alto" value="<?php echo $alto; ?>"></td>
								<tr>									
						<?php	
							}
						?>
						<?php 
							if (($comando == 'L') or ($comando == 'R')){								
						?>
								<tr>
									<td>
						<?php
										if ($comando == 'L'){
											print "Línea:";
										}
										if ($comando == 'R'){
											print "Rectángulo:";
										}
						?>
									</td>
									<td>
						<?php
										print "(".$x1.",".$y1.") (".$x2.",".$y2.")";
						?>
									</td>
								</tr>
						<?php
							}
						?>
						<tr>
							<td colspan="2" align="center" id="enviar">
								<input type="hidden" name="lienzo" value="<?php echo $lienzo; ?>">
								<input type="hidden" name="x1" value="<?php echo $x1; ?>">
								<input type="hidden" name="y1" value="<?php echo $y1; ?>">
								<input type="hidden" name="x2" value="<?php echo $x2; ?>">
								<input type="hidden" name="y2" value="<?php echo $y2; ?>">								
								<input type="submit" name="tarea" value="<?php if ($lienzo != 'C'){?>Crear<?php } else{ ?>Ejecutar<?php } ?>">
							</td>
						</tr>
					</table>
				</center>
			</form>
			
			
			<!-- Crear Lienzo -->
			<?php
				if ( $lienzo == 'C'){				
			?>
					<table bgcolor="#EFEFEF" border="0">
						<tr>
							<td width="<?php echo $ancho;?>px" height="<?php echo $alto;?>px">
							
							<!-- Dibujar Línea -->
							<?php
								// Línea
								if ( $comando == "L"){
									$i = 0;
									while( $i <= $y2){
										$j = 0;
										if (( $i >= $y1 ) and ( $i <= $y2)){
											while ( $j <= $x2 ){
												if (( $j >= $x1 ) and ( $j <= $x2 )){
													print "X";
												}
												else{
													print "&nbsp;";
												}
												$j++;
											}
										}
										print "<br>";
										$i++;
									}
								}
								
								// Rectángulo
								if ( $comando == "R"){
									$i = 0;
									while( $i < $y2 ){
										if (($i == 0) or ($i == $y2-1)){
											$j = 0;
											while ( $j <= $x2 ){
												if (( $j >= $x1 ) and ( $j <= $x2 )){
													print "&nbsp;X&nbsp;";
												}
												else{
													print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
												}
												$j++;
											}
										}
										else{
											$j = 0;
											while ( $j <= $x2 ){
												if (( $j == $x1 ) or ( $j == $x2 )){
													print "&nbsp;X&nbsp;";
												}
												else{
													print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
												}
												$j++;
											}
										}
										print "<br>";
										$i++;
									}
								}
							?>							
							</td>
						</tr>
					</table>
			<?php
				}
			?>
		</div>		
	</center>	
</html>