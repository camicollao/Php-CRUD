<?php

include("database.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $query = "SELECT * FROM registros WHERE id = {$id}";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Ocurrio un error al momento de ejecutar la accion".mysqli_error($connection));
    }

    //Recorrer la base de datos para obtener los registros y convertilo e json

    $json = array();

    while($row = mysqli_fetch_array($result)){
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
    
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}


