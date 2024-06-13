<?php

include("database.php");

if(isset($_POST["id"])){

    $id = $_POST["id"];

    $query = "DELETE FROM registros WHERE id = $id";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Ocurrio un error al momento de ejecutar la accion".mysqli_error($connection));
    }
    echo "El registro fue eliminado exitosamente";

}