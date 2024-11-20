<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CAMIONES ELIZONDO</title>
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
    <h1>REGISTRO DE CAMIONES</h1>

    <!-- Formularios para Crear, Eliminar y Actualizar -->
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_camion" placeholder="ID Camión">
        <input type="text" name="placas" placeholder="Placas">
        <input type="text" name="modelo" placeholder="Modelo">
        <input type="text" name="costo_renta" placeholder="Costo Renta">
        <input type="submit" name="crear" value="Crear">
    </form>
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_camion" placeholder="ID Camión">
        <input type="submit" name="eliminar" value="Eliminar">
    </form>
    <form method="post" style="margin-bottom: 20px;">
        <input type="text" name="id_camion" placeholder="ID Camión">
        <input type="text" name="costo_renta" placeholder="Nuevo Costo Renta">
        <input type="submit" name="actualizar" value="Actualizar">
    </form>

    <?php
    $con = mysqli_connect("localhost","root","", "fletes_elizondo");
    
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Crear un nuevo registro
    if (isset($_POST['crear'])) {
        $id_camion = $_POST['id_camion'];
        $placas = $_POST['placas'];
        $modelo = $_POST['modelo'];
        $costo_renta = $_POST['costo_renta'];
        $sql = "INSERT INTO camiones (id_camion, placas, modelo, costo_renta) VALUES ('$id_camion', '$placas', '$modelo', '$costo_renta')";

        if ($con->query($sql) === TRUE) {
            echo "Nuevo registro creado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    // Eliminar un registro
    if (isset($_POST['eliminar'])) {
        $id_camion = $_POST['id_camion'];
        $sql = "DELETE FROM camiones WHERE id_camion = '$id_camion'";

        if ($con->query($sql) === TRUE) {
            echo "Registro eliminado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    // Actualizar un registro
    if (isset($_POST['actualizar'])) {
        $id_camion = $_POST['id_camion'];
        $costo_renta = $_POST['costo_renta'];
        $sql = "UPDATE camiones SET costo_renta = '$costo_renta' WHERE id_camion = '$id_camion'";

        if ($con->query($sql) === TRUE) {
            echo "Registro actualizado exitosamente";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }

    $resultado = mysqli_query($con, "SELECT * FROM camiones");

    if ($resultado === FALSE) {
        echo "fallo";
        die(mysqli_error($con));
    }

    echo "<table border='1'>
    <tr>
        <th>id_camion</th>
        <th>placas</th>
        <th>modelo</th>
        <th>costo renta</th>
    </tr>";
    
    while ($row = mysqli_fetch_array($resultado)) {
        echo "<tr>";
        echo "<td align='center'>" .$row['id_camion']."</td>";
        echo "<td align='center'>" .$row['placas']."</td>";
        echo "<td align='center'>" .$row['modelo']."</td>";
        echo "<td align='center'>" .$row['costo_renta']."</td>";
        echo "</tr>";
    }

    echo "</table>";
    $registros = mysqli_num_rows($resultado);
    echo "<br>Registros: " .$registros;
    mysqli_close($con);
    ?>
</center>
</body>
</html>
