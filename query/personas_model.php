<?php
require_once __DIR__. '/../config/database.php';

function getDbconnection() {
    $database = new Database();
    return $database->getConnection();
}

function obtenerDepartamentos() {
    $db = getDbconnection();
    if (!$db) {
        die("Error al conectar con la base de datos");
    }
    $query = "SELECT * FROM departamentos";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $departamentos;
}

function obtenerCiudades() {
    $db = getDbconnection();
    $query = "SELECT * FROM ciudades";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $ciudades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $ciudades;
}

function registrarPersonas($nombre, $departamentoId, $ciudadId, $fechaNacimiento, $sexo, $activo = 1 ) {
    $db = getDbconnection();
    $query = "INSERT INTO personas (nombre,departamento_id,ciudad_id,fecha_nacimiento,sexo,activo) 
              VALUES (:nombre,:departamento_id,:ciudad_id,:fecha_nacimiento,:sexo,:activo)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':departamento_id', $departamentoId);
    $stmt->bindParam(':ciudad_id', $ciudadId);
    $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':activo', $activo, PDO::PARAM_INT);
    return $stmt->execute();
}

function listarPersonas(){
    $db = getDbconnection();
    $query = "SELECT personas.id, personas.nombre, departamentos.nombre AS departamento, ciudades.nombre AS ciudad, personas.fecha_nacimiento , personas.sexo
              FROM personas
              INNER JOIN departamentos ON personas.departamento_id = departamentos.id
              INNER JOIN ciudades ON personas.ciudad_id = ciudades.id
              WHERE personas.activo = 1"; // solo se mostraran registros activos
    $stmt = $db->prepare($query);

    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

function eliminarPersona($id) {
    $db = getDbconnection();
    $query = "UPDATE personas SET activo = 0 WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
// cargar ids para la edicion de usuario
function obtenerPersonaId($id) {
    $db = getDbconnection();
    $query = "SELECT * FROM personas WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function actualizarPersona($id, $nombre, $departamento_id, $ciudad_id, $fecha_nacimiento, $sexo) {
    $db = getDbconnection();
    $query ="UPDATE personas SET nombre = :nombre, departamento_id = :departamento_id, ciudad_id = :ciudad_id, fecha_nacimiento = :fecha_nacimiento, sexo = :sexo WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':departamento_id', $departamento_id);
    $stmt->bindParam(':ciudad_id', $ciudad_id);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();


}


?>