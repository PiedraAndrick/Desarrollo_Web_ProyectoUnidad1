<?php
require_once 'conexion.php';


if($_SERVER['REQUEST_METHOD'] =='POST'){

    if(isset($_POST['id_categoria']) && isset($_POST['color']) && isset($_POST['marca']) && isset($_POST['precio']) && isset($_POST['descripcion'])
    && isset($_POST['estado'])){
        $query = "INSERT INTO bicicletas (id_categoria, color, marca, precio, descripcion, estado) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('ssssss', $_POST['id_categoria'], $_POST['color'], $_POST['marca'], 
            $_POST['precio'], $_POST['descripcion'], $_POST['estado']);

            if($stmt -> execute()){
                header('location: bicicletas.php');
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
    <title>Agregar</title>
    <link rel="stylesheet" href="menu.css">  
    <link rel="stylesheet" href="stylesform.css"> 
    <script src="popup.js" defer></script>
    <!-- GOOGLE FONTs -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>
<body>

<header>
<section>
<label for="toggle-1" class="toggle-menu"><ul><li></li> <li></li> <li></li></ul></label>
<input type="checkbox" id="toggle-1">

<nav>
<ul>
<li><a href="bicicletas.php"><i class="fa fa-film" style="color: #fff;"></i>Bicicletas</a></li>
<li><a href="categorias.php"><i class="fa fa-list" style="color: #fff;"></i>Categorias</a></li>
<li><a href="prestamos.php"><i class="fa fa-laptop" style="color: #fff;"></i>Préstamos</a></li>
<li><a href="clientes.php"><i class="fa fa-users" style="color: #fff;"></i>Clientes</a></li>
</ul>
</nav>
</header>

</section>

<div class="content">
<h2>Agregar un nueva bicicletas</h2>
           <p>Llene este formulario para agregar una nueva bicicletas a la base de datos</p>
    <div class="contact-wrapper animated bounceInUp">
        <div class="contact-form">
        
           <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <p class="block">
             <div>  
              <label>Categorías</label>
              <input type="text" name="id_categoria" required>
             </div>
             </p>
             <p class="block">
             <div>  
              <label>Color</label>
              <input type="text" name="color" required>
             </div>
             <div>  
              <label>Marca</label>
              <input type="text" name="marca" required>
             </div>
             <div>  
              <label>Precio</label>
              <input type="text" name="precio" required>
             </div>
             <div>  
              <label>Descripción</label>
              <input type="text" name="descripcion" required>
             </div>
             <div>  
              <label>Estado</label>
              <input type="text" name="estado" required>
             </div>
            

             </p>
             <p class="block">
             <button type="submit" value="Guardar">Guardar</button>
             </p>
            <p>
             <button class="btn-cancelar" href="bicicletas.php">Cancelar</button>
             </p>
     </form>
    </div>
    <div class="contact-info">
            <h4>Mas información</h4>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i> Santo Domingo</li>
                <li><i class="fas fa-phone"></i> (+593) 096 785 1255 </li>
                <li><i class="fas fa-envelope-open-text"></i> fastbike@gmail.com</li>
            </ul>
        
           
    </div>
    </div>
    </div>
     
</body>
</html>