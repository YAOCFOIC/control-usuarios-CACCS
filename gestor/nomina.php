<?php
include 'db.php';

$message = '';
$alert_type = '';
$pago_to_edit = null;
$empleados = [];

// Cargar lista de empleados para nómina
try {
    $stmt = $pdo->query("SELECT id, nombre, apellido, salario FROM empleados WHERE estado = TRUE ORDER BY nombre ASC");
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error al cargar empleados: ' . $e->getMessage();
    $alert_type = 'danger';
}

// Procesar el formulario de agregar/editar pago de nómina
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['empleado_id'])) {
        $empleado_id = $_POST['empleado_id'];
        $salario = $_POST['salario'];
        $fecha_pago = $_POST['fecha_pago'];
        $tipo_pago = $_POST['tipo_pago'];
        $estado_pago = $_POST['estado_pago'];

        if (isset($_POST['id_pago']) && !empty($_POST['id_pago'])) {
            // Actualizar pago existente
            $id_pago = $_POST['id_pago'];
            try {
                $sql = "UPDATE nomina SET empleado_id = ?, salario = ?, fecha_pago = ?, 
                        tipo_pago = ?, estado_pago = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$empleado_id, $salario, $fecha_pago, $tipo_pago, $estado_pago, $id_pago]);
                $message = 'Pago de nómina actualizado exitosamente!';
                $alert_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error al actualizar pago: ' . $e->getMessage();
                $alert_type = 'danger';
            }
        } else {
            // Agregar nuevo pago
            try {
                $sql = "INSERT INTO nomina (empleado_id, salario, fecha_pago, tipo_pago, estado_pago) 
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$empleado_id, $salario, $fecha_pago, $tipo_pago, $estado_pago]);
                $message = 'Pago de nómina registrado exitosamente!';
                $alert_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error al registrar pago: ' . $e->getMessage();
                $alert_type = 'danger';
            }
        }
    }
}

// Procesar eliminación de pago
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM nomina WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $message = 'Pago de nómina eliminado exitosamente!';
        $alert_type = 'success';
    } catch (PDOException $e) {
        $message = 'Error al eliminar pago: ' . $e->getMessage();
        $alert_type = 'danger';
    }
    header("Location: nomina.php?status=$alert_type&message=" . urlencode($message));
    exit();
}

// Cargar pago para edición
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM nomina WHERE id = ?");
        $stmt->execute([$id]);
        $pago_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$pago_to_edit) {
            $message = 'Pago no encontrado para edición.';
            $alert_type = 'warning';
        }
    } catch (PDOException $e) {
        $message = 'Error al cargar pago para edición: ' . $e->getMessage();
        $alert_type = 'danger';
    }
}

// Cargar todos los pagos de nómina
try {
    $sql = "SELECT n.*, e.nombre, e.apellido 
            FROM nomina n
            JOIN empleados e ON n.empleado_id = e.id
            ORDER BY n.fecha_pago DESC";
    $stmt = $pdo->query($sql);
    $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error al cargar nómina: ' . $e->getMessage();
    $alert_type = 'danger';
    $pagos = [];
}

// Manejar mensajes de estado desde redirecciones
if (isset($_GET['status'])) {
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';
    $alert_type = $_GET['status'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Nómina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .container { margin-top: 20px; }
        .card { margin-bottom: 20px; }
        .table-responsive { overflow-x: auto; }
        .badge-pendiente { background-color: #ffc107; color: #000; }
        .badge-completado { background-color: #198754; }
        .badge-cancelado { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestionar Nómina</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Registrar Pago de Nómina</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pagoModal">
                    <i class="bi bi-plus-circle"></i> Nuevo Pago
                </button>
            </div>
            <div class="card-body">
                <?php if (count($pagos) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Empleado</th>
                                    <th>Salario</th>
                                    <th>Fecha de Pago</th>
                                    <th>Tipo de Pago</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pagos as $pago): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($pago['id']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['nombre'] . ' ' . $pago['apellido']); ?></td>
                                        <td><?php echo '$' . number_format($pago['salario'], 2); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($pago['fecha_pago'])); ?></td>
                                        <td><?php echo htmlspecialchars($pago['tipo_pago']); ?></td>
                                        <td>
                                            <?php 
                                            $badge_class = '';
                                            switch($pago['estado_pago']) {
                                                case 'Completado': $badge_class = 'badge-completado'; break;
                                                case 'Cancelado': $badge_class = 'badge-cancelado'; break;
                                                default: $badge_class = 'badge-pendiente';
                                            }
                                            ?>
                                            <span class="badge rounded-pill <?php echo $badge_class; ?>">
                                                <?php echo htmlspecialchars($pago['estado_pago']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editPagoModal"
                                                    data-id="<?php echo $pago['id']; ?>"
                                                    data-empleado="<?php echo $pago['empleado_id']; ?>"
                                                    data-salario="<?php echo $pago['salario']; ?>"
                                                    data-fecha="<?php echo $pago['fecha_pago']; ?>"
                                                    data-tipo="<?php echo $pago['tipo_pago']; ?>"
                                                    data-estado="<?php echo $pago['estado_pago']; ?>">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deletePagoModal"
                                                    data-id="<?php echo $pago['id']; ?>"
                                                    data-empleado="<?php echo htmlspecialchars($pago['nombre'] . ' ' . $pago['apellido']); ?>"
                                                    data-fecha="<?php echo date('d/m/Y', strtotime($pago['fecha_pago'])); ?>">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        No hay registros de nómina.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <a href="menu.php" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Volver al Inicio
        </a>
    </div>

    <!-- Modal para Nuevo Pago -->
    <div class="modal fade" id="pagoModal" tabindex="-1" aria-labelledby="pagoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="nomina.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pagoModalLabel">Registrar Nuevo Pago</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="empleado_id" class="form-label">Empleado</label>
                            <select class="form-select" id="empleado_id" name="empleado_id" required>
                                <option value="" selected disabled>Seleccione un empleado</option>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?php echo $empleado['id']; ?>" data-salario="<?php echo $empleado['salario']; ?>">
                                        <?php echo htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="salario" class="form-label">Salario</label>
                            <input type="number" step="0.01" class="form-control" id="salario" name="salario" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                            <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" 
                                   value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                            <select class="form-select" id="tipo_pago" name="tipo_pago" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia Bancaria</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estado_pago" class="form-label">Estado</label>
                            <select class="form-select" id="estado_pago" name="estado_pago" required>
                                <option value="Pendiente" selected>Pendiente</option>
                                <option value="Completado">Completado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Pago</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Pago -->
    <div class="modal fade" id="editPagoModal" tabindex="-1" aria-labelledby="editPagoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="nomina.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPagoModalLabel">Editar Pago de Nómina</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_pago" id="edit_id_pago">
                        <div class="mb-3">
                            <label for="edit_empleado_id" class="form-label">Empleado</label>
                            <select class="form-select" id="edit_empleado_id" name="empleado_id" required>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?php echo $empleado['id']; ?>">
                                        <?php echo htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_salario" class="form-label">Salario</label>
                            <input type="number" step="0.01" class="form-control" id="edit_salario" name="salario" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_fecha_pago" class="form-label">Fecha de Pago</label>
                            <input type="date" class="form-control" id="edit_fecha_pago" name="fecha_pago" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_tipo_pago" class="form-label">Tipo de Pago</label>
                            <select class="form-select" id="edit_tipo_pago" name="tipo_pago" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia Bancaria</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_estado_pago" class="form-label">Estado</label>
                            <select class="form-select" id="edit_estado_pago" name="estado_pago" required>
                                <option value="Pendiente">Pendiente</option>
                                <option value="Completado">Completado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Eliminar Pago -->
    <div class="modal fade" id="deletePagoModal" tabindex="-1" aria-labelledby="deletePagoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePagoModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el pago a <strong><span id="delete_pago_empleado"></span></strong> con fecha <strong><span id="delete_pago_fecha"></span></strong>?</p>
                    <p class="text-danger">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeletePago" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-completar salario cuando se selecciona empleado
            const empleadoSelect = document.getElementById('empleado_id');
            const salarioInput = document.getElementById('salario');
            
            if (empleadoSelect && salarioInput) {
                empleadoSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    const salario = selectedOption.getAttribute('data-salario');
                    if (salario) {
                        salarioInput.value = salario;
                    }
                });
            }
            
            // Modal de edición
            const editPagoModal = document.getElementById('editPagoModal');
            if (editPagoModal) {
                editPagoModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    
                    document.getElementById('edit_id_pago').value = button.getAttribute('data-id');
                    document.getElementById('edit_empleado_id').value = button.getAttribute('data-empleado');
                    document.getElementById('edit_salario').value = button.getAttribute('data-salario');
                    document.getElementById('edit_fecha_pago').value = button.getAttribute('data-fecha');
                    document.getElementById('edit_tipo_pago').value = button.getAttribute('data-tipo');
                    document.getElementById('edit_estado_pago').value = button.getAttribute('data-estado');
                });
            }
            
            // Modal de eliminación
            const deletePagoModal = document.getElementById('deletePagoModal');
            if (deletePagoModal) {
                deletePagoModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    
                    document.getElementById('delete_pago_empleado').textContent = button.getAttribute('data-empleado');
                    document.getElementById('delete_pago_fecha').textContent = button.getAttribute('data-fecha');
                    document.getElementById('confirmDeletePago').href = 'nomina.php?action=delete&id=' + button.getAttribute('data-id');
                });
            }
        });
    </script>
</body>
</html>
