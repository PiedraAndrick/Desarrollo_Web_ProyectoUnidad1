<?php
if(isset($_GET['id'])&& !empty(trim($_GET['id']))){
    require_once 'conexion.php';
    $query = 'DELETE FROM prestamos WHERE id_prestamos=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i',$_GET['id']);
        if($stmt->execute()){
            header('location: prestamos.php');
            exit();
        }else{
            echo 'Error! Intente más tarde';
            exit();
        }
    }
    $stmt -> close();
    $conn -> close();
}


?>