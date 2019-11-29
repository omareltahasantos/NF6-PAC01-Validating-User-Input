<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	  <link rel="stylesheet" href="styles.css">
	  <link href="form.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		$enlace = mysqli_connect("127.0.0.1", "omar", "APTItude01", "reviews");

		if (!$enlace) {
		    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		    exit;
		}

		

		$query = 'CREATE DATABASE IF NOT EXISTS reviews';
		mysqli_query($enlace,$query) or die (mysqli_error($enlace));
		mysqli_select_db($enlace,"reviews") or die (mysqli_error($enlace));

		//echo $_POST['id_people'];
		//echo $_POST['edicion'];
		//	echo $_POST['añadir'];

		switch ($_POST['modo']) {
			case 'edit':

				$error =array();
				$nameprota = isset($_POST['nameprota']) ? trim($_POST['nameprota']): "";
				if(empty($nameprota)){
					$error[]= urlencode('El campo protagonista no puede estar vacio');
				}
				if(is_numeric($nameprota)){
					$error[]= 'El campo protagonista no puede ser un numero';
				}

				$mystring = $nameprota;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo protagonista no puede contener este signo <';
				}
				$mystring = $nameprota;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo protagonista no puede contener este signo >';
				}

				$namedirector = isset($_POST['namedirector']) ? trim($_POST['namedirector']): "";

				if(empty($namedirector)){
					$error[]= urlencode('El campo Director no puede estar vacio');
				}
				if(is_numeric($namedirector)){
					$error[]= 'El campo director no puede ser un numero';
				}
				$mystring = $namedirector;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo director no puede contener este signo <';
				}
				$mystring = $namedirector;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo director no puede contener este signo >';
				}

				$email = isset($_POST['email']) ? trim($_POST['email']): "";
				if(empty($email)){
					$error[]= urlencode('El campo email no puede estar vacio');
				}
				if(is_numeric($email)){
					$error[]= 'El campo email no pueden ser numeros';
				}
				$mystring = $email;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo email no puede contener este signo <';
				}
				$mystring = $email;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo email no puede contener este signo >';
				}

				function valid_email($email) {
				return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
				}

				if(!valid_email($email)){
				echo "Invalid email address.";
					$error[]= 'Please enter a correct email';
				}else{
				echo "Valid email address.";
				}

				echo "<h3>Tu dirección de correo electrónico es: " .$email. "</h3>";


				//O limpiar string


				if(empty($error)){
					$query = 'UPDATE people
					SET people_nameprota ="'.$_POST['nameprota'].'", people_namedirector ="'.$_POST['namedirector'].'"
					where people_id = "'.$_POST['id_people'].'"';
					mysqli_query($enlace,$query) or die(mysqli_error($enlace));
					echo "El registro ha sido editado correctamente, para volver a la pagina principal pulse  ";
					echo "<a href='admin.php'>Volver a la pagina de administracion</a>";
				}else{
					header("Location:people.php?action=edit&people_id=".$_POST['id_people'].'&error='.join($error, urlencode('<br/>')));
				}
				break;
			case 'add':	
				$error =array();
				$nameprota = isset($_POST['nameprota']) ? trim($_POST['nameprota']): "";
				if(empty($nameprota)){
					$error[]= urlencode('El campo protagonista no puede estar vacio');
				}
				if(is_numeric($nameprota)){
					$error[]= 'El campo protagonista no puede ser un numero';
				}

				$mystring = $nameprota;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo protagonista no puede contener este signo <';
				}
				$mystring = $nameprota;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo protagonista no puede contener este signo >';
				}

				$namedirector = isset($_POST['namedirector']) ? trim($_POST['namedirector']): "";

				if(empty($namedirector)){
					$error[]= urlencode('El campo Director no puede estar vacio');
				}
				if(is_numeric($namedirector)){
					$error[]= 'El campo director no puede ser un numero';
				}
				$mystring = $namedirector;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo director no puede contener este signo <';
				}
				$mystring = $namedirector;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo director no puede contener este signo >';
				}

				$email = isset($_POST['email']) ? trim($_POST['email']): "";
				if(empty($email)){
					$error[]= urlencode('El campo email no puede estar vacio');
				}
				if(is_numeric($email)){
					$error[]= 'El campo email no pueden ser numeros';
				}
				$mystring = $email;
				$findme   = '<';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo email no puede contener este signo <';
				}
				$mystring = $email;
				$findme   = '>';
				$pos = strpos($mystring, $findme);
				if ($pos !== false) {
						$error[]= 'El campo email no puede contener este signo >';
				}

				function valid_email($email) {
				return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
				}

				if(!valid_email($email)){
				echo "Invalid email address.";
					$error[]= 'Please enter a correct email';
				}else{
				echo "Valid email address.";
				}

				echo "<h3>Tu dirección de correo electrónico es: " .$email. "</h3>";


				if(empty($error)){
					$query = 'INSERT INTO people
				        (people_nameprota,people_namedirector)
				   		 VALUES
				        ("'.$_POST['nameprota'].'","'.$_POST['namedirector'].'")';
						mysqli_query($enlace,$query) or die(mysqli_error($enlace));
						echo "El registro ha sido añadido correctamente, para volver a la pagina principal pulse  ";
						echo "<a href='admin.php'>Volver a la pagina de administracion</a>";
				}else{
					header("Location:people.php?action=add".'&error='.join($error, urlencode('<br/>')));
				}
				break;

			/*
			$query = 'UPDATE people
			SET people_nameprota ="'.$_POST['nameprota'].'", people_namedirector ="'.$_POST['namedirector'].'"
			where people_id = "'.$_POST['id_people'].'"';
			mysqli_query($enlace,$query) or die(mysqli_error($enlace));
			echo "El registro ha sido editado correctamente, para volver a la pagina principal pulse  ";
			echo "<a href='admin.php'>Volver a la pagina de administracion</a>";
				break;
			
			case 'add':
				echo "He entrado en añadir";
			$query = 'INSERT INTO people
	        (people_nameprota,people_namedirector)
	   		 VALUES
	        ("'.$_POST['nameprota'].'","'.$_POST['namedirector'].'")';
			mysqli_query($enlace,$query) or die(mysqli_error($enlace));
			echo "El registro ha sido añadido correctamente, para volver a la pagina principal pulse  ";
			echo "<a href='admin.php'>Volver a la pagina de administracion</a>";
				break;

			*/
				
		}




/*

			if($_POST['añadir']){
			echo "He entrado en añadir";
			$query = 'INSERT INTO people
	        (people_nameprota,people_isprota,people_namedirector,people_isdirector)
	   		 VALUES
	        ("'.$_POST['name_protagonista'].'","'.$_POST['id_protagonista'].'","'.$_POST['name_director'].'","'.$_POST['id_director'].'")';
			mysqli_query($enlace,$query) or die(mysqli_error($enlace));
			echo "El registro ha sido añadido correctamente, para volver a la pagina principal pulse  ";
			echo "<a href='admin.php'>Volver a la pagina de administracion</a>";

		}
		if($_POST['edicion']){

			$query = 'UPDATE people
			SET people_nameprota ="'.$_POST['name_protagonista'].'",people_isprota= "'.$_POST['id_protagonista'].'", people_namedirector ="'.$_POST['name_director'].'",people_isdirector ="'.$_POST['id_director'].'"
			where people_id = "'.$_POST['id_people'].'"';
			mysqli_query($enlace,$query) or die(mysqli_error($enlace));
			echo "El registro ha sido editado correctamente, para volver a la pagina principal pulse  ";
			echo "<a href='admin.php'>Volver a la pagina de administracion</a>";


		}


*/

		$query = 'SELECT
		      people_nameprota,people_namedirector
		    FROM
		      people';
		 

		$result = mysqli_query($enlace,$query) or die(mysqli_error($enlace));



$table = <<<ENDHTML
				<div style="text-align: center;">
				 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
				    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
				    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
				  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
				  <link rel="stylesheet" href="styles.css">
				  <link href="form.css" rel="stylesheet" type="text/css">
				<h2>---PEOPLE---</h2>
				ENDHTML;
				$table .= <<<ENDHTML


ENDHTML;
				$table .= <<<ENDHTML
				<table class = "table table-stripped"border="1" cellpadding="2" cellspacing="2"
				style="width: 70%; margin-left: auto; margin-right: auto;">
				<tr>
				<th>Game protagonist</th>
				
				<th>Game director</th>
				
				</tr>
				ENDHTML;

				while($row=mysqli_fetch_assoc($result)){
				  extract($row);
  /*
    $prota= get_prota($people_nameprota);
      $director= get_director($people_namedirector);
      $juegotype = get_juegostype($juegos_type);

      */
				$table .= '<tr>';
				 $table .= '   	<td>'.$people_nameprota.'</td>';
				$table .= '    	<td>'.$people_namedirector.'</td>';
				$table .= ' </tr>';
				    

				    }
				 
				//$table .= '    	<td>'.$juegotype.'</td>';
				//$table .= '    	<td>'.$prota.'</td>';
				//$table .= '    	<td>'.$director.'</td>';
				$table .= <<<ENDHTML
				    	</table>
				ENDHTML;

				echo $table;




		?>

</body>
</html>