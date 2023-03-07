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
    <?php 
        if ($_SESSION['auth'] == "admin") {
            echo "<a href='http://cocinasaludable.localhost/add'>Agregar</a><br>";
            echo "<a href='http://cocinasaludable.localhost/logout'>Cerrar sesión</a> <br>";
        }
        ?>
        <form action="http://cocinasaludable.localhost/search" method="post">
            <label for="search">Buscar</label>
            <input type="text" name="nombre" id="nombre" placeholder="Introduce nombre">
            <input type="submit" name="searcher" value="Buscar">
        </form>
        <?php
        foreach($data['recetas'] as $receta){
            // echo $superheroe['nombre'] . ' ' . $superheroe['velocidad'] . ' ';
            // titulo, ingredientes, elaboracion, etiquetas, imagen, usuarios
            if ($_SESSION['auth'] == "admin") {
                echo "<a href='http://cocinasaludable.localhost/edit/" . $superheroe['id'] . "'>Editar</a> " . " ";
                echo "<a href='http://cocinasaludable.localhost/delete/" . $superheroe['id'] . "'>Eliminar</a>";
            }
            echo "<br>";
        }
    ?> 
</body>
</html> 