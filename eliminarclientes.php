<?php
if(isset($_GET['id'])&& !empty(trim($_GET['id']))){
    require_once 'clientes.php';
    $query = 'DELETE FROM clientes WHERE id_usuario=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i',$_GET['id']);
        if($stmt->execute()){
            header('location: clientes.php');
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