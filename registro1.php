<?php
// Iniciar sesión
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "test");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validación y procesamiento del formulario

    $correo = $_POST['correo'];
    $contrasena = md5($_POST['contrasena']); // No es la mejor práctica, considera usar algo más seguro como bcrypt

    // Procesar archivos
    $imagen = $_FILES['imagen'];
    $pdf = $_FILES['pdf'];

    // Validación de archivos
    // (Implementar lógica de validación según tus necesidades)

    // Mover archivos a una carpeta específica
    move_uploaded_file($imagen['tmp_name'], 'archivos/' . $imagen['name']);
    move_uploaded_file($pdf['tmp_name'], 'archivos/' . $pdf['name']);

    // Guardar en la base de datos
    $insertar = $conexion->prepare("INSERT INTO usuarios (correo, contrasena, imagen, pdf) VALUES (?, ?, ?, ?)");
    $insertar->bind_param("ssss", $correo, $contrasena, $imagen['name'], $pdf['name']);
    $insertar->execute();
    $insertar->close();

    // Redirigir a la ventana de login
    header("Location: login.php");
    exit();
}
?>

<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <input type="text" name="correo" placeholder="Correo">
    <input type="password" name="contrasena" placeholder="Contraseña">
    <input type="file" name="imagen" accept="image/jpeg,image/jpg">
    <input type="file" name="pdf" accept="application/pdf">
    <input type="submit" value="Registrar">
</form>
</body>
</html>
