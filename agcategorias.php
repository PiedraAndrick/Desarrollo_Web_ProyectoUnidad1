<?php
require_once 'conexion.php';


if($_SERVER['REQUEST_METHOD'] =='POST'){

    if(isset($_POST['nombre'])){
        $query = "INSERT INTO categoria (nombre) VALUES (?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('s', $_POST['nombre']);

            if($stmt -> execute()){
                header('location: categorias.php');
                exit();
            }else{
                echo "Error! Por favor intenta más tarde";
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
     
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="stylesform.css"> 
    <title>Agregar</title>
</head>
<body>
    <div>
           <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
           <h2>Agregar una nueva categoria</h2>
           <p>Llene este formulario para agregar
              una nueva categoria a la base de datos</p>
             <div>  
              <label>Ingrese el nombre de la categoría</label>
              <input type="text" name="nombre" required>
             </div>
             <input type="submit" value="Guardar">
             <a class="btn-cancelar" href="categorias.php">Cancelar</a>
     </form>
</body>
</html>