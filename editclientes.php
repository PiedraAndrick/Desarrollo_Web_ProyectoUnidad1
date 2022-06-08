<?php
require_once "conexion.php";

//Leer los datos y poderlos visualizar en los cuadors de texto para su edición
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = "SELECT * FROM clientes WHERE id_cliente=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt -> get_result();
            if($result -> num_rows == 1){
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                $nombre = $row['nombres'];
                $apellido= $row['apellidos'];
                $cedula= $row['cedula'];
                $telefono = $row['telefono'];
                $direccion = $row['direccion'];
              
            }else{
                echo 'Error! No existen resultados.';
                exit();
            }
        }else{
            echo 'Error! Revise la conexión con la base de datos';
        }
    }
    $stmt -> close();
} else {
   header('location: clientes.php');
    exit();
}
//Tomar datos y actualizar
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['nombres']) && isset($_POST['apellidos'])&& isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['direccion'])){
    $query = "UPDATE clientes SET nombres=?, apellidos=?,cedula=?, telefono=?, direccion=? WHERE id_cliente=?";
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('sssssi', $_POST['nombres'], $_POST['apellidos'], $_POST['cedula'], $_POST['telefono'], $_POST['direccion'], $_GET['id']);
        if($stmt -> execute()){
            header('location:clientes.php');
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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="menu.css">  
    <title>Actualizar cliente</title>
</head>
<body>

<div>

           <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
           <h1> Actualizar datos del Cliente</h1>
            <p>Editar la información para actualizar el cliente</p>
             <div>  
               <label>Nombre</label>
               <input type="text" name="nombres" value="<?php echo $nombre ?>" required>
             </div>
             <div>  
               <label>Apellido</label>
               <input type="text" name="apellidos"  value="<?php echo $apellido ?>"required>
             </div>
             <div>  
               <label>Cédula</label>
               <input type="text" name="cedula" value="<?php echo $cedula ?>" required>
             </div>
             <div>  
               <label>Telefono</label>
               <input type="text" name="telefono" value="<?php echo $telefono ?>" required>
             </div>
             <div>  
               <label>Direccion</label>
               <input type="text" name="direccion" value="<?php echo $direccion ?>" required>
             </div>
              <input type="submit" value="Guardar">
              <a class="btn-cancelar" href="clientes.php" id="btn-cancelar">Cancelar</a>
     </form>
</div>
    
</body>
</html>

</style>
</html>