<?php
//Solucionar problema de CORS
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

include("database.php");


//Verificar si se envió el formulario a traves de POST
if(isset($_POST['rut'])){
    $rut = $_POST['rut'];
    $name = $_POST['name'];
    $first_surname = $_POST['first_surname'];
    $second_surname = $_POST['second_surname'];
    $email = $_POST['email'];
    $job = $_POST['job'];
    $address = $_POST['address'];
    $region= $_POST['region'];

    $query = "INSERT into registros (rut, nombre, apellido_p, apellido_m, correo, profesion, direccion, region) VALUES ('$rut', '$name', '$first_surname', '$second_surname', '$email', '$job', '$address', '$region')";
    $result = mysqli_query($connection, $query);

    //Verificar si se añadió el registro
    if(!$result) {
        die("Error al añadir un registro".mysqli_error($connection));
    } else {
        echo "Registro añadido exitosamente";
    }
}