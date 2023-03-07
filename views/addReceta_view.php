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
    <h2>Añadir</h2>
    <form action="" method="post" enctype="multipart/form-data" >
        <label for="nombre">Titulo</label>
        <input type="text" name="titulo" id="titulo"><br><br>
        <label for="ingredientes">Ingredientes</label>
        <input type="text" name="ingredientes" id="ingredientes"><br><br>
        <label for="elaboracion">Elaboración</label>
        <input type="text" name="elaboracion" id="elaboracion"><br><br>
        <label for="etiquetas">Etiquetas</label>
        <input type="text" name="etiquetas" id="etiquetas"><br><br>
        <label for="publica">Publica</label>
        <input type="checkbox" name="publica" id="publica"><br><br>
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen"><br><br>
        <input type="submit" value="Añadir" name="send">
    </form>
    <a href="http://comidasaludable.localhost/">Volver</a>
</body>
</html>