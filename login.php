<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "test");

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = md5($_POST['contrasena']);

    // Verificar credenciales
    $consulta = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasena'";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        // Iniciar sesión y redirigir a la página privada
        $_SESSION['usuario'] = $correo;
        header("Location: pagina_privada.php");
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="correo" placeholder="Correo">
    <input type="password" name="contrasena" placeholder="Contraseña">
    <input type="submit" value="Iniciar sesión">
</form>
</body>
</html>
