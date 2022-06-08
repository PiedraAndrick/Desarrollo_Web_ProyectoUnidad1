<?php
require_once "conexion.php";

//Leer los datos y poderlos visualizar en los cuadors de texto para su edición
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = "SELECT * FROM categorias WHERE id_categorias=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt -> get_result();
            if($result -> num_rows == 1){
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $nombre = $row['nombre'];
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
   header('location: categorias.php');
    exit();
}

//Tomar datos y actualizar
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['nombre'])){
    $query = "UPDATE categorias SET nombre=? WHERE id_categorias=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('si', $_POST['nombre'], $_GET['id']);
        if($stmt -> execute()){
            header('location:categorias.php');
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
           <h1> Actualizar Categorias</h1>
<p>Editar la información para actualizar de la categoria</p>
             <div>  
               <label>Nombre</label>
               <input type="text" name="nombre" value="<?php echo $nombre ?>" required>
             </div>
             <div>
              <input type="submit" value="Guardar">
              <a href="categorias.php" id="btn-cancelar">Cancelar</a>
     </form>
</div>
    
</body>
</html>