<?php
// agregar_empleado.php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $documento_identidad = $_POST['documento_identidad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salario = $_POST['salario'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    try {
        $sql = "INSERT INTO empleados (nombre, apellido, documento_identidad, fecha_ingreso, salario, fecha_nacimiento)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellido, $documento_identidad, $fecha_ingreso, $salario, $fecha_nacimiento]);

        header("Location: listar_empleados.php?status=success_add");
        exit();
    } catch (PDOException $e) {
        header("Location: agregar_empleado_form.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: agregar_empleado_form.php");
    exit();
}
?>