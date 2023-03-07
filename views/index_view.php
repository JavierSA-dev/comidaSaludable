<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CocinasSaludable</h1>
    <?php

    if ($_SESSION['auth'] == "guest") {
        include_once 'login_view.php';
    }
    if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

    ?>
    <h2>Listado</h2>
        <form action="http://comidasaludable.localhost/search" method="post">
            <label for="search">Buscar</label>
            <input type="text" name="titulo" id="titulo" placeholder="Introduce titulo">
            <input type="submit" name="searcher" value="Buscar">
        </form>
        <table>
            
        </table>
        <?php 



            if ($_SESSION['auth'] !== "guest" && $_SESSION['estado'] == "Activo") {
                echo "<a href='http://comidasaludable.localhost/logout'>Cerrar Sesión</a>";
            }
            if ($_SESSION['auth'] == "Collaborator" && $_SESSION['estado'] == "Activo") {
                echo "<br>";
                echo "<a href='http://comidasaludable.localhost/add'>Añadir Receta</a>";
            }
            echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Titulo</th>";
            echo "<th>Ingredientes</th>";
            echo "<th>Elaboración</th>";
            echo "<th>Etiquetas</th>";
            echo "<th>Imagen</th>";
            echo "</tr>";
            foreach($data['recetas'] as $receta){
                if ($receta['publica'] == 1 || $receta['idColaborador'] == $_SESSION['id']) {


                    echo "<tr>";
                    echo "<td>" . $receta['titulo'] . "</td>";
                    echo "<td>" . $receta['ingredientes'] . "</td>";
                    echo "<td>" . $receta['elaboracion'] . "</td>";
                    echo "<td>" . $receta['etiquetas'] . "</td>";
                    echo "<td><img width='200'  src='uploads/" . $receta['imagen'] . "'/></td>";
                    // print_r("User:" . $_SESSION['id']);
                    // print_r("Receta: ". $receta['idColaborador']);
                    if ($_SESSION['auth'] == "Collaborator" && $receta['idColaborador'] == $_SESSION['id'] && $_SESSION["estado"] == "Activo") {
                        echo "<td><a href='http://comidasaludable.localhost/edit/" . $receta['id'] . "'>Editar</a></td>";
                        echo "<td><a href='http://comidasaludable.localhost/delete/" . $receta['id'] . "'>Eliminar</a></td>";
                    }
                    if ($_SESSION['auth'] == "User" && $_SESSION["estado"] == "Activo") {
                        echo "<td>";
                        echo "<select name='puntuacion' id='puntuacion'>";
                        echo "<option value='1'>1</option>";
                        echo "<option value='2'>2</option>";
                        echo "<option value='3'>3</option>";
                        echo "<option value='4'>4</option>";
                        echo "<option value='5'>5</option>";
                        echo "</select>";
                        echo "</td>";
                    }
                    echo "</tr>";
                    
                }
                
                echo "<br>";
            }
            echo "</table>";

        ?>


</body>
</html> 