<?php

include("database.php");

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $rut = $_POST["rut"];
    $name = $_POST["name"];
    $first_surname = $_POST["first_surname"];
    $second_surname = $_POST["second_surname"];
    $email = $_POST["email"];
    $job = $_POST["job"];
    $address = $_POST["address"];
    $region = $_POST["region"];

    $query = "UPDATE registros SET rut = '$rut', nombre = '$name', apellido_p = '$first_surname', apellido_m = '$second_surname', correo = '$email', profesion = '$job', direccion = '$address', region = '$region' WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Ocurrio un error al momento de ejecutar la accion".mysqli_error($connection));
    }

    echo "Registro actualizado exitosamente";
}