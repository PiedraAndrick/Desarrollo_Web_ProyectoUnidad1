<?php
require_once 'conexion.php';
$query = "SELECT id_categoria, nombre FROM categoria";
$result = $conn -> query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <link rel="stylesheet" href="stylesform.css"> 
    <link rel="stylesheet" href="menu.css">
    <title>Categorias</title>
    <style>


    nav{
          
          width: auto;
           float: right;
           background-color: rgb(0 0 0);
       }
       .boton_agregar{
           margin-top: 20px;
           text-decoration: none;
           padding: 10px;
           font-weight: 600;
           font-size: 20px;
           color: #000000;
           background-color: #ffffff;
           border-radius: 6px;
           border: 2px solid #b00075;
           margin-bottom: 20px;
         }
       
         h4{
            margin: 20px;
         }
     </style>
</head>

<header>
<section>
<img src="img/logobici.jpg" alt="logo" srcset=""  width="240px" height="130px">
<label for="toggle-1" class="toggle-menu"><ul><li></li> <li></li> <li></li></ul></label>
<input type="checkbox" id="toggle-1">

<nav>



<ul >
<li><a href="bicicletas.php" style="color: green;"><i class="fa fa-film" style="color: green;"></i>Bicicletas</a></li>
<li><a href="categorias.php"style="color: green;"><i class="fa fa-list" style="color: green;"></i>Categorias</a></li>
<li><a href="prestamos.php" style="color: green;"><i class="fa fa-external-link" style="color: green;"></i>Préstamos</a></li>
<li><a href="clientes.php" style="color: green;"><i class="fa fa-users" style="color: green;"></i>Clientes</a></li>

</ul>
</nav>

</header>
<body  style="background-color:#FFE0C0">
    <div> 
       <h2 class="tittle-clientes">Categorias</h2>
       <h4><a class="boton_agregar" href= "agcategorias.php"> Agregar categorias</a> </h4>
         <table style="margin: 20px;"> 
            <thead>
             <tr>
                <th>#</th>
                <th>Categoria</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
             </thead>
             <tbody>
                <?php
                if($result->num_rows >0){
                    while($row = $result -> fetch_assoc()){
                        echo "<tr>";
                        echo "<td>". $row['id_categoria']. "</td>";
                        echo "<td>". $row['nombre']. "</td>";
                        echo "<td>";
                        echo  '<a  class="boton_editar" href="actCategorias.php?id='. $row['id_categoria'].'"><i class="fas fa-user-edit"></i></a>';
                        echo '<a class="boton_eliminar" href="eliminarcategoria.php?id='.$row['id_categoria'].'" class="tabla-datos"> <i class="fas fa-user-times"></i> </a>';
                    }
                    $result -> free();
                } else 
                   echo "<p><em>No existen datos registrados</em></p>";
                ?>
                </td>
                </tr>
               </tbody>
          </table>
         </div>
         <script src="confirmacion.js"></script>
</body>
</html>