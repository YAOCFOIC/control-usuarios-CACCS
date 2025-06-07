<?php
// agregar_empleado_form.php
// Esto es para mostrar mensajes de éxito o error que vienen de la redirección de agregar_empleado.php
$message = '';
$alert_type = '';
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'error') {
        $message = 'Error al agregar empleado: ' . (isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Error desconocido.');
        $alert_type = 'danger';
    }
}
?>
<html>
<head>
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <style>
        .container { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Agregar Empleado</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="agregar_empleado.php"> <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="form-group">
                <label for="documento_identidad">Documento de Identidad</label>
                <input type="text" class="form-control" id="documento_identidad" name="documento_identidad" required>
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
            </div>
            <div class="form-group">
                <label for="salario">Salario</label>
                <input type="number" step="0.01" class="form-control" id="salario" name="salario" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Agregar Empleado</button>
            <a href="index.php" class="btn btn-secondary mt-3">Volver al Inicio</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>