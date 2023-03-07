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
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value= <?php echo "\"".$data['superheroe'][0]['nombre']."\""; ?> >
        <label for="velocidad">Velocidad</label>
        <input type="number" name="velocidad" id="velocidad" value= <?php echo "\"".$data['superheroe'][0]['velocidad']."\""; ?>>
        <input type="hidden" name="id" value= <?php echo "\"".$data['superheroe'][0]['id']."\""; ?>>
        <input type="submit" value="Editar" name="send">
    </form>
    <a href="http://superheroes.localhost/">Volver</a>

</body>
</html>