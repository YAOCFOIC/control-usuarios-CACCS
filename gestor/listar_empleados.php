<?php
// Incluir la lógica (backend) y obtener los datos procesados
$datos = include 'listar_empleados_logic.php';

session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener los datos de empleados, mensajes y tipos de alerta
$empleados = $datos['empleados'];
$message = $datos['message'];
$alert_type = $datos['alert_type'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <style>
        .container { margin-top: 20px; }
        .table th, .table td { text-align: center; }
        .table { border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .alert { border-radius: 10px; }
        .btn { border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Lista de Empleados</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (count($empleados) > 0): ?>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>F. Ingreso</th>
                        <th>Salario</th>
                        <th>F. Nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($empleado['id']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['apellido']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['documento_identidad']); ?></td>
                            <td><?php echo htmlspecialchars($empleado['fecha_ingreso']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($empleado['salario'], 2, ',', '.')); ?></td>
                            <td><?php echo htmlspecialchars($empleado['fecha_nacimiento']); ?></td>
                            <td>
                                <a href="editar_empleado.php?id=<?php echo $empleado['id']; ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <a href="eliminar_empleado.php?id=<?php echo $empleado['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este empleado?');">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                No hay empleados registrados.
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between">
            <a href="agregar_empleado_form.php" class="btn btn-primary">Agregar Nuevo Empleado</a>
            <a href="index.php" class="btn btn-secondary">Volver al Inicio</a>
        </div>
    </div>

    <!-- Bootstrap JS (incluye dependencias) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Agregar iconos de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>
