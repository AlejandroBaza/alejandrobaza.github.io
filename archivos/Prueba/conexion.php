<?php
	$database="bdproyec2";
	$user='admindb';
	$password='Askeladd123@';


try {
	
	$con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}

?>