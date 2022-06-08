<?php
require_once 'conexion.php';


if($_SERVER['REQUEST_METHOD'] =='POST'){

    if(isset($_POST['id_usuario']) && isset($_POST['id_bicicleta']) && isset($_POST['fecha_salida']) && isset($_POST['fecha_devolucion'])){
        $query = "INSERT INTO prestamos (id_usuario, id_bicicleta,fecha_salida, fecha_devolucion) VALUES (?, ?, ?, ?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('ssss', $_POST['id_usuario'], $_POST['id_bicicleta'], $_POST['fecha_salida'], $_POST['fecha_devolucion']);

            if($stmt -> execute()){
                header('location: prestamos.php');
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
           <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
           <h2>Agregar un nuevo prestamo</h2>
           <p>Llene este formulario para agregar
         un nuevo prestamo a la base de datos</p>
             <div>  
              <label>ID CLIENTE</label>
              <input type="text" name="id_usuario" required>
             </div>
             <div>  
              <label>ID BICICLETAS</label>
              <input type="text" name="id_bicicleta" required>
             </div>
             <div>  
              <label>FECHA DE SALIDA</label>
              <input type="text" name="fecha_salida" required>
             </div>
             <div>  
              <label>FECHA DE DEVOLUCIÓN</label>
              <input type="text" name="fecha_devolucion" required>
             </div>
             <input type="submit" value="Guardar">
             <a class="btn-cancelar" href="prestamos.php">Cancelar</a>

     </form>
</body>
</html>