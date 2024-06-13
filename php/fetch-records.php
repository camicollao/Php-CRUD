<?php

include("database.php");

$query = "SELECT * FROM registros";
$result = mysqli_query($connection, $query);

if(!$result) {
    die('Error en la peticion'. mysqli_error($connection));
}

$json = array();

//Recorrer la base de datos para obtener los registros
while($row = mysqli_fetch_assoc($result)) {
    $json[] = array(
        'id' => $row['id'],
        'rut' => $row['rut'],
        'name' => $row['nombre'],
        'first_surname' => $row['apellido_p'],
        'second_surname' => $row['apellido_m'],
        'email' => $row['correo'],
        'job' => $row['profesion'],
        'address' => $row['direccion'],
        'region' => $row['region'],
    );
}

//Convertir el array en un JSON
$jsonstring = json_encode($json);
echo $jsonstring;