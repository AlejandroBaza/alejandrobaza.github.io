<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$matricula=$_POST['matricula'];
		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$correo=$_POST['correo'];
		$telefono=$_POST['telefono'];

		if(!empty($matricula) && !empty($nombres) && !empty($apellidos) && !empty($correo)  && !empty($telefono) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$con->prepare('INSERT INTO alumnos(matricula,nombres,apellidos,correo,telefono) VALUES(:matricula,:nombres,:apellidos,:correo,:telefono)');
				$consulta_insert->execute(array(
					':matricula' =>$matricula,
					':nombres' =>$nombres,
					':apellidos' =>$apellidos,
					':correo' =>$correo,
					':telefono' =>$telefono
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Alumno</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>REGISTRO DE NUEVO ALUMNO</h2>
		<form action="" method="post">
			<div class="form-group">
			<input type="text" name="matricula" placeholder="Matricula" class="input__text">
				<input type="text" name="nombres" placeholder="Nombres" class="input__text">
				<input type="text" name="apellidos" placeholder="Apellidos" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" placeholder="Correo Electronico" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" placeholder="Telefono" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
