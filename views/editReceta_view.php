<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Superheroes</h1>
    <h2>Editar</h2>
    <form action="" method="post" enctype="multipart/form-data" >
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $data['receta']['titulo'] ?>"><br><br>
        <label for="ingredientes">Ingredientes</label>
        <input type="text" name="ingredientes" id="ingredientes" value="<?php echo $data['receta']['ingredientes'] ?>"><br><br>
        <label for="elaboracion">Elaboración</label>
        <input type="text" name="elaboracion" id="elaboracion" value="<?php echo $data['receta']['elaboracion'] ?>"><br><br>
        <label for="etiquetas">Etiquetas</label>
        <input type="text" name="etiquetas" id="etiquetas" value="<?php echo $data['receta']['etiquetas'] ?>"><br><br>
        <label for="publica">Publica</label>
        <input type="checkbox" name="publica" id="publica" <?php if ($data['receta']['publica'] == 1) {echo "checked";} ?>><br><br>
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen" value="<?php echo $data['receta']['imagen'] ?>" ><br><br>
        <?php
            echo "<img  width='200' src= ../uploads/" . $data['receta']['imagen'] . ">";
            echo "<br>";
        ?>
        <input type="hidden" name="id" value="<?php echo $data['receta']['id'] ?>">
        <input type="submit" value="Editar" name="send">
    </form>
    <a href="http://comidasaludable.localhost/">Volver</a>

</body>
</html>