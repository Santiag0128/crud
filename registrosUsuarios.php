<?php
require_once 'query/personas_model.php';

$personas = listarPersonas();

// elimar registro

if (isset($_GET['delete_id'])){
    $deleteId = $_GET['delete_id'];
        if (eliminarPersona($deleteId)){
        header("Location:registrosUsuarios.php");
        exit();
    }
    else {
        echo "Error al eliminar los datos";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div>
<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Departamento</th>
      <th scope="col">Ciudad</th>
      <th scope="col">F-nacimiento</th>
      <th scope="col">Sexo</th>
      <th></th>
    </tr>
  </thead>
  
  <tbody>
    <?php foreach ($personas as $persona):?>
    <tr>
      <th scope="row"><?php echo htmlspecialchars($persona['id']); ?></th>
      <td><?php echo htmlspecialchars($persona['nombre']); ?></td>
      <td><?php echo htmlspecialchars($persona['departamento']); ?></td>
      <td><?php echo htmlspecialchars($persona['ciudad']); ?></td>
      <td><?php echo htmlspecialchars($persona['fecha_nacimiento']); ?></td>
      <td><?php echo htmlspecialchars($persona['sexo']); ?></td>
      <td>
      <a href="actualizarUsuarios.php?id=<?php echo htmlspecialchars($persona['id']); ?>" class="btn btn-primary">Editar</a>
      <a href="registrosUsuarios.php?delete_id=<?php echo htmlspecialchars($persona['id']); ?>" class="btn btn-danger" onclick="return confirm('vas a liminar un registro');">Eliminar</a>
    </td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
</div>
</body>
</html>
