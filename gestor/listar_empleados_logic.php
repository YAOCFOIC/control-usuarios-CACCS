<?php
// Incluir el archivo de conexión
include 'db.php'; 

// Variables para los mensajes
$message = '';
$alert_type = '';

// Manejar mensajes de estado desde redirecciones
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success_add') {
        $message = '¡Empleado agregado exitosamente!';
        $alert_type = 'success';
    } elseif ($_GET['status'] == 'success_delete') {
        $message = '¡Empleado eliminado exitosamente!';
        $alert_type = 'success';
    } elseif ($_GET['status'] == 'success_update') {
        $message = '¡Empleado actualizado exitosamente!';
        $alert_type = 'success';
    } elseif ($_GET['status'] == 'error') {
        $message = 'Ocurrió un error: ' . (isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Desconocido');
        $alert_type = 'danger';
    }
}

try {
    // Consulta a la base de datos para obtener todos los empleados
    $sql = "SELECT id, nombre, apellido, documento_identidad, fecha_ingreso, salario, fecha_nacimiento FROM empleados ORDER BY id ASC";
    $stmt = $pdo->query($sql);
    
    // Almacenar los resultados en una variable
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // En caso de error, asignamos un mensaje y vaciamos el array de empleados
    $message = 'Error al cargar empleados: ' . $e->getMessage();
    $alert_type = 'danger';
    $empleados = []; // Asegura que $empleados sea un array vacío si hay un error
}

// Devolver los datos procesados para que se usen en la vista
return [
    'empleados' => $empleados,
    'message' => $message,
    'alert_type' => $alert_type
];
?>
