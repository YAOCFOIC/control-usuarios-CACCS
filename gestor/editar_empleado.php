<?php
include 'db.php';

$empleado = null;
$message = '';
$alert_type = '';

// Si se ha enviado el formulario de actualización (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $documento_identidad = $_POST['documento_identidad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $salario = $_POST['salario'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    try {
        $sql = "UPDATE empleados SET nombre = ?, apellido = ?, documento_identidad = ?, fecha_ingreso = ?, salario = ?, fecha_nacimiento = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellido, $documento_identidad, $fecha_ingreso, $salario, $fecha_nacimiento, $id]);

        header("Location: listar_empleados.php?status=success_update");
        exit();
    } catch (PDOException $e) {
        $message = 'Error al actualizar empleado: ' . $e->getMessage();
        $alert_type = 'danger';
        // Vuelve a cargar los datos del empleado para mostrar el formulario con el error
        try {
            $stmt = $pdo->prepare("SELECT * FROM empleados WHERE id = ?");
            $stmt->execute([$id]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e_fetch) {
            $message .= "<br>Error al recargar datos: " . $e_fetch->getMessage();
        }
    }
} 
// Si se accede a la página con un ID para editar (GET)
elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM empleados WHERE id = ?");
        $stmt->execute([$id]);
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$empleado) {
            $message = 'Empleado no encontrado.';
            $alert_type = 'warning';
        }
    } catch (PDOException $e) {
        $message = 'Error al cargar datos del empleado: ' . $e->getMessage();
        $alert_type = 'danger';
    }
} else {
    // Si no hay ID en GET ni POST
    header("Location: listar_empleados.php?status=error&message=" . urlencode("ID de empleado no especificado para edición."));
    exit();
}
?>

<html>
<head>
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <style>
        .container { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Editar Empleado</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($empleado): ?>
            <form method="POST" action="editar_empleado.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($empleado['id']); ?>">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($empleado['apellido']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="documento_identidad">Documento de Identidad</label>
                    <input type="text" class="form-control" id="documento_identidad" name="documento_identidad" value="<?php echo htmlspecialchars($empleado['documento_identidad']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?php echo htmlspecialchars($empleado['fecha_ingreso']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="salario">Salario</label>
                    <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="<?php echo htmlspecialchars($empleado['salario']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($empleado['fecha_nacimiento']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                <a href="listar_empleados.php" class="btn btn-secondary mt-3">Cancelar</a>
            </form>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No se pudo cargar la información del empleado.
            </div>
            <a href="listar_empleados.php" class="btn btn-secondary">Volver a la Lista</a>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>