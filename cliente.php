<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultar Maestros COLEGIO_5L1</title>
    <link rel="stylesheet" type="text/css" href="fletes.css"> 
</head>
<body>
<div class="sidebar">
        <h2>Menú</h2>
        <button onclick="location.href='fletes.html'">Menu</button><p></p>
        <button onclick="location.href='camiones.php'">Registro Camiones</button><p></p>
        <button onclick="location.href='cliente.php'">Clientes</button><p></p>
        <button onclick="location.href='control.transporte.php'">Control transporte</button><p></p>
    </div>
<center>
    <h1>Clientes</h1>

    <!-- Formularios para Crear, Eliminar y Actualizar -->
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_cliente" placeholder="ID Cliente">
        <input type="text" name="nombre" placeholder="Nombre">
        <input type="text" name="direccion" placeholder="Dirección">
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="text" name="camion_solicitado" placeholder="Camión Solicitado">
        <input type="text" name="placas" placeholder="Placas">
        <input type="text" name="id_camion" placeholder="ID Camión">
        <input type="submit" name="crear" value="Crear">
    </form>
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_cliente" placeholder="ID Cliente">
        <input type="submit" name="eliminar" value="Eliminar">
    </form>
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_cliente" placeholder="ID Cliente">
        <input type="text" name="direccion" placeholder="Nueva Dirección">
        <input type="submit" name="actualizar" value="Actualizar">
    </form>

    <?php
    $con = mysqli_connect("localhost", "root", "", "fletes_elizondo");
    $resultado = mysqli_query($con, "SELECT * FROM clientes");

    if ($resultado === FALSE) {
        echo "fallo";
        die(mysqli_error($con));
    }

    // Crear un nuevo registro
    if (isset($_POST['crear'])) {
        $id_cliente = $_POST['id_cliente'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $camion_solicitado = $_POST['camion_solicitado'];
        $placas = $_POST['placas'];
        $id_camion = $_POST['id_camion'];

        $sql = "INSERT INTO clientes (id_cliente, nombre, direccion, telefono, camion_solicitado, placas, id_camion)
                VALUES ('$id_cliente', '$nombre', '$direccion', '$telefono', '$camion_solicitado', '$placas', '$id_camion')";

        if ($con->query($sql) === TRUE) {
            echo "Nuevo registro creado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    // Eliminar un registro
    if (isset($_POST['eliminar'])) {
        $id_cliente = $_POST['id_cliente'];
        $sql = "DELETE FROM clientes WHERE id_cliente = '$id_cliente'";

        if ($con->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    // Actualizar un registro
    if (isset($_POST['actualizar'])) {
        $id_cliente = $_POST['id_cliente'];
        $direccion = $_POST['direccion'];

        $sql = "UPDATE clientes SET direccion = '$direccion' WHERE id_cliente = '$id_cliente'";

        if ($con->query($sql) === TRUE) {
            echo "Registro actualizado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    echo "<table border='1'>
    <tr>
        <th>id_cliente</th>
        <th>nombre</th>
        <th>direccion</th>
        <th>telefono</th>
        <th>camion_solicitado</th>
        <th>placas</th>
        <th>id_camion</th>
    </tr>";
    
    while ($row = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td align='center'>" . $row['id_cliente'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['direccion'] . "</td>";
        echo "<td>" . $row['telefono'] . "</td>";
        echo "<td align='center'>" . $row['camion_solicitado'] . "</td>";
        echo "<td>" . $row['placas'] . "</td>";
        echo "<td>" . $row['id_camion'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    $registros = mysqli_num_rows($resultado);
    echo "<br>Registros: " . $registros;
    mysqli_close($con);
    ?>
</center>
</body>
</html>
