<?php
require_once "conexion.php";

//Leer los datos y poderlos visualizar en los cuadors de texto para su edición
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = "SELECT * FROM prestamos WHERE id_prestamos=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt -> get_result();
            if($result -> num_rows == 1){
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $cliente = $row['id_cliente'];
                $bicicletas = $row['id_bicicleta'];
                $fechasalida = $row['fecha_salida'];
                $fechadevolucion = $row['fecha_devolucion'];
            }else{
                echo 'Error! No existen resultados.';
                exit();
            }
        }else{
            echo 'Error! Revise la conexión con la base de datos';
            exit();
        }
    }
    $stmt -> close();
} else {
   header('location: prestamos.php');
    exit();
}

//Tomar datos y actualizar
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['id_cliente']) && isset($_POST['id_bicicleta']) && isset($_POST['fecha_salida']) && isset($_POST['fecha_devolucion'])){
    $query = "UPDATE prestamos SET id_cliente=?, id_bicicleta=?, fecha_salida=?, fecha_devolucion=? WHERE id_prestamos=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('ssssi', $_POST['id_cliente'], $_POST['id_bicicleta'], $_POST['fecha_salida'], $_POST['fecha_devolucion'], $_GET['id']);
        if($stmt -> execute()){
            header('location:prestamos.php');
            exit();
      }else{
          echo 'Error! Por favor intente más tarde';
      }
      $stmt -> close();
    }
  }
  $conn -> close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar cliente</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="menu.css">   
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>

<div>

           <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
           <h1> Actualizar Bicicletas</h1>
<p>Editar la información para actualizar de la categoria</p>
             <div>  
               <label>ID CLIENTE</label>
               <input type="text" name="id_cliente" value="<?php echo $cliente ?>" required>
             </div>
             <div>  
               <label>ID BICICLETA</label>
               <input type="text" name="id_bicicleta" value="<?php echo $bicicletas ?>" required>
             </div>
             <div>  
               <label>Fecha de salida</label>
               <input type="text" name="fecha_salida" value="<?php echo $fechasalida ?>" required>
             </div>
             <div>  
               <label>Fecha de devolución</label>
               <input type="text" name="fecha_devolucion" value="<?php echo $fechadevolucion ?>" required>
             </div>
             <div>
              <input type="submit" value="Guardar">
              <a href="prestamos.php" id="btn-cancelar">Cancelar</a>
     </form>
</div>
    
</body>
</html>