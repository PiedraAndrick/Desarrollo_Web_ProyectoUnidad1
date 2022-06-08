<?php
require_once 'conexion.php';


if($_SERVER['REQUEST_METHOD'] =='POST'){

    if(isset($_POST['nombres']) && isset($_POST['apellidos']) && isset
    ($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['direccion'])){
        $query = "INSERT INTO clientes (nombres, apellidos, cedula, telefono, direccion) VALUES (?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('sssss', $_POST['nombres'], $_POST['apellidos'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion']);

            if($stmt -> execute()){
                header('location: clientes.php');
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
           <h2>Agregar un nuevo cliente</h2>
           <p>Llene este formulario para agregar
              un nuevo cliente a la base de datos</p>
             <div>  
              <label>Nombre</label>
              <input type="text" name="nombres" required>
             </div>
             <div>  
              <label>Apellido</label>
              <input type="text" name="apellidos" required>
             </div>
             <div>  
              <label>Cédula</label>
              <input type="text" name="cedula" required>
             </div>
             <div> 
             <label>Teléfono</label>
              <input type="text" name="telefono" required>
             </div>
             <div> 
             <label>Dirección</label>
              <input type="text" name="direccion" required>
             </div>
             <input type="submit" value="Guardar">
             <a class="btn-cancelar" href="clientes.php">Cancelar</a>
     </form>
</body>
</html>