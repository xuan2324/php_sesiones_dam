<html>
<body>
<form method="post" action=""<?php $_SERVER['PHP_SELF']?>">
    <input type="text" name="nombre">
    <input type="number" name="creditos">
    <input type="date" name="fecha">
    <input type="submit" value="enviar">
</form>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre=$_POST['nombre'];
    $creditos=$_POST['creditos'];
    $fecha=$_POST['fecha'];
    $conexion=new mysqli("localhost","root","","test");
    $insertar="insert into test.asignaturas (id, nombre,creditos,fecha_inicio) values (null,'$nombre',$creditos,'$fecha');";
    $conexion->query($insertar);
    $consultar="select*from test.asignaturas";
    $resultado=$conexion->query($consultar);
    //echo var_dump($resultado);
    //echo "<p>datos guardados</p>";
    echo '<table border="1">';
    while($fila=$resultado->fetch_assoc())
    {
        echo '<tr>';
        echo '<td>'.$fila['id'].'</td>>';
        echo '<td>'.$fila['nombre'].'</td>>';
        echo '<td>'.$fila['creditos'].'</td>>';
        echo '<td>'.$fila['fecha_inicio'].'</td>>';
        echo '</tr>';
    }
    echo '</table>';
}

?>

</body>
</html>