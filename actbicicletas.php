<?php
require_once "conexion.php";

//Leer los datos y poderlos visualizar en los cuadors de texto para su edición
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = "SELECT * FROM bicicletas WHERE id_bicicleta=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt -> get_result();
            if($result -> num_rows == 1){
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $categoria = $row['id_categoria'];
                $color = $row['color'];
                $marca = $row['marca'];
                $precio = $row['precio'];
                $descripcion = $row['descripcion'];
                $estado = $row['estado'];

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
   header('location: bicicletas.php');
    exit();
}

//Tomar datos y actualizar
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['id_categoria']) && isset($_POST['color']) && isset($_POST['marca']) && isset($_POST['precio']) && isset($_POST['descripcion']) && isset($_POST['estado'])){
    $query = "UPDATE bicicletas SET id_categoria=?, color=?, marca=?, precio=?,descripcion=?,estado=? WHERE id_bicicleta=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('ssssssi', $_POST['id_categoria'] , $_POST['color'] , $_POST['marca'] , $_POST['precio'] , $_POST['descripcion'] , $_POST['estado'], $_GET['id']);
        if($stmt -> execute()){
            header('location:bicicletas.php');
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
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="menu.css">     
</head>
<body>

<div>

           <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" align="center">
           <h1> Actualizar bicicletas</h1>
            <p>Editar la información para actualizar de la categoria</p>
             <div>  
               <label>ID CATEGORIA: </label>
               <input type="text" name="id_categoria" value="<?php echo $categoria ?>" required>
             </div>
             <div>  
               <label>Color: </label>
               <input type="text" name="color" value="<?php echo $color ?>" required>
             </div>
             <div>  
               <label>Marca: </label>
               <input type="text" name="marca" value="<?php echo $marca ?>" required>
             </div>
             <div>  
               <label>Precio: </label>
               <input type="text" name="precio" value="<?php echo $precio ?>" required>
             </div>
             <div>  
               <label>Descripción: </label>
               <input type="text" name="descripcion" value="<?php echo $descripcion ?>" required>
             </div>
             <div>  
               <label>Estado: </label>
               <input type="text" name="estado" value="<?php echo $estado ?>" required>
             </div><br>
             <div>
              <input type="submit" value="Guardar"><br>
              <a href="bicicletas.php" id="btn-cancelar">Cancelar</a>
     </form>
</div>
    
</body>
</html>