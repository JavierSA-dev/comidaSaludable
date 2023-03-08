<h2>Datos de Acceso</h2>
<form action="" method="post">
    <label for="user">Usuario</label>
    <input type="text" name="user" id="user">
    <label for="pass">Contraseña</label>
    <input type="password" name="pass" id="pass">
    <label for="perfil">Perfil</label>
    <select name="perfil" id="perfil">
        <option value="Admin">Admin</option>
        <option value="User">User</option>
        <option value="Collaborator">Collaborator</option>
    </select>
    <input type="submit" name="auth" value="Enviar">
</form>