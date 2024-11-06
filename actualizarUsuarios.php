<?php
require_once 'query/personas_model.php';

$departamentos = obtenerDepartamentos();
$ciudades = obtenerCiudades();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $persona = obtenerPersonaId($id); 

    if ($persona) {
        $nombre = $persona['nombre'];
        $departamento_id = $persona['departamento_id'];
        $ciudad_id = $persona['ciudad_id'];
        $fecha_nacimiento = $persona['fecha_nacimiento'];
        $sexo = $persona['sexo'];
    }
        
    else{
        echo "Registro no encontrado";
        exit();
    
    }
}
// actualizar el registro
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])){
    $nombre = $_POST['nombre'];
    $departamento_id = $_POST['departamento_id'];
    $ciudad_id = $_POST['ciudad_id'];
    $fecha_nacimiento = $_POST['fechaNacimiento'];
    $sexo = $_POST['sexo'];

    if (actualizarPersona($id, $nombre, $departamento_id, $ciudad_id, $fecha_nacimiento, $sexo)){
        header("Location:registrosUsuarios.php");
        exit();
    } else {
        echo "Error al actualizar el registro";
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
        <form action="actualizarUsuarios.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <input type="hidden" name="id" value="">
            
<div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
</div>
<div class="mb-3">
        <label for="departamento" class="form-label">Departamento</label>
        <select id="departamento" name="departamento_id" class="form-control" required onchange="cambiarCiudades()">
            <option value="">Seleccione un departamento</option>
            <?php foreach ($departamentos as $departamento): ?>
                <option value="<?php echo $departamento['id']; ?>" 
                    <?php echo $departamento['id'] == $departamento_id ? 'selected' : ''; ?>>
                    <?php echo $departamento['nombre']; ?>
                </option>
            <?php endforeach; ?>
        </select>
</div>
<div class="mb-3">
    <label for="ciudad" class="form-label">Ciudad</label>
    <select name="ciudad_id" id="ciudad" class="form-control" required>
        <option value="">Seleccione una ciudad</option>
        <?php foreach ($ciudades as $ciudad): ?>
            <option value="<?php echo $ciudad['id']; ?>" 
                <?php echo $ciudad['id'] == $ciudad_id ? 'selected' : ''; ?>>
                <?php echo $ciudad['nombre']; ?>
        </option>
        <?php endforeach; ?>
    </select>
</div>
<div class="mb-3">
    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
    <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control" value="<?php echo htmlspecialchars($fecha_nacimiento); ?>" required>
<div class="mb-3">
    <label for="sexo" class="form-label">Sexo</label>
    <select name="sexo" id="sexo" class="form-control" required>
        <option value="M" <?php echo $sexo === 'M' ? 'selected' : ''; ?>>M</option>
        <option value="F" <?php echo $sexo === 'F' ? 'selected' : ''; ?>>F</option>
    </select>
</div>
            <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
</form>
</div>

<script>
    // Pasar las ciudades de PHP a JavaScript
 const ciudades = <?php echo json_encode($ciudades);?>

</script>
<script src="js/cambiarCiudades.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41Jie8M584E31jAfB7euYJOm6fak/kD68GBiFfjh4q" crossorigin="anonymous"></script>
</body>
</html>
