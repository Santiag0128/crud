<?php
// incluir el archivo de configuración de la base de datos
require_once 'query/personas_model.php';

$departamentos = obtenerDepartamentos();
$ciudades = obtenerCiudades();

// envio del formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $departamentoId = $_POST['departamento_id'];
    $ciudadId = $_POST['ciudad_id'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $sexo = $_POST['sexo'];
    

    if (registrarPersonas($nombre, $departamentoId, $ciudadId, $fechaNacimiento, $sexo)) {
        header("Location: registrosUsuarios.php");
        exit();
    } else {
        echo "Error al registrar los datos";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">
    <div>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <select id="departamento" name="departamento_id" class="form-control" required onchange="cambiarCiudades()">
                <option value="">Seleccione un departamento</option>
                <?php foreach ($departamentos as $departamento): ?>
                    <option value="<?php echo $departamento['id']; ?>"><?php echo $departamento['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <select id="ciudad" name="ciudad_id" class="form-control" required>
                <option value="">Seleccione una ciudad</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>
        <div class="mb-3">
            <label for="sexo" class="form-label">Sexo</label>
            <select class="form-control" id="sexo" name="sexo" required>
                <option value="">Seleccione un sexo</option>
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
</div>
<script>
// Pasar las ciudades de PHP a JavaScript
const ciudades = <?php echo json_encode($ciudades); ?>;
</script>

<script src="js/cambiarCiudades.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
