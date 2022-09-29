<?php
	include_once 'conexion.php';

	$sentencia_select=$con->prepare('SELECT *FROM alumnos ORDER BY id DESC');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM alumnos WHERE nombres LIKE :campo OR apellidos LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>SISTEMA DE ALUMNOS</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o apellidos" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo Alumno</a>
			</form>
		</div>
		<table>
			<tr class="table-success table-striped">
				<td>Id</td>
				<td>Matricula</td>
				<td>Nombres</td>
				<td>Apellidos</td>
				<td>Correo</td>
				<td>Telefono</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['matricula']; ?></td>
					<td><?php echo $fila['nombres']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar Alumno</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar Alumno</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>