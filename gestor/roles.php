<?php
include 'db.php';

$message = '';
$alert_type = '';
$rol_to_edit = null;
$empleados = [];

// Cargar lista de empleados para asignación de roles
try {
    $stmt = $pdo->query("SELECT id, nombre, apellido FROM empleados ORDER BY nombre ASC");
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error al cargar empleados: ' . $e->getMessage();
    $alert_type = 'danger';
}

// Procesar el formulario de agregar/editar rol
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre_rol'])) {
        $nombre_rol = $_POST['nombre_rol'];

        if (isset($_POST['id_rol']) && !empty($_POST['id_rol'])) {
            // Actualizar rol existente
            $id_rol = $_POST['id_rol'];
            try {
                $sql = "UPDATE roles SET nombre_rol = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nombre_rol, $id_rol]);
                $message = 'Rol actualizado exitosamente!';
                $alert_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error al actualizar rol: ' . $e->getMessage();
                $alert_type = 'danger';
            }
        } else {
            // Agregar nuevo rol
            try {
                $sql = "INSERT INTO roles (nombre_rol) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nombre_rol]);
                $message = 'Rol agregado exitosamente!';
                $alert_type = 'success';
            } catch (PDOException $e) {
                if ($e->getCode() == '23505') {
                    $message = 'Error: El nombre de rol ya existe.';
                } else {
                    $message = 'Error al agregar rol: ' . $e->getMessage();
                }
                $alert_type = 'danger';
            }
        }
    }
    
    // Procesar asignación de rol a empleado
    if (isset($_POST['asignar_rol'])) {
        $empleado_id = $_POST['empleado_id'];
        $rol_id = $_POST['rol_id'];
        $fecha_asignacion = date('Y-m-d');
        
        try {
            // Verificar si ya existe la asignación
            $stmt = $pdo->prepare("SELECT * FROM empleado_roles WHERE empleado_id = ? AND rol_id = ?");
            $stmt->execute([$empleado_id, $rol_id]);
            
            if ($stmt->rowCount() > 0) {
                $message = 'Error: Este empleado ya tiene asignado este rol.';
                $alert_type = 'warning';
            } else {
                $sql = "INSERT INTO empleado_roles (empleado_id, rol_id, fecha_asignacion) VALUES (?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$empleado_id, $rol_id, $fecha_asignacion]);
                $message = 'Rol asignado exitosamente al empleado!';
                $alert_type = 'success';
            }
        } catch (PDOException $e) {
            $message = 'Error al asignar rol: ' . $e->getMessage();
            $alert_type = 'danger';
        }
    }
}

// Procesar eliminación de rol
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $sql = "DELETE FROM roles WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $message = 'Rol eliminado exitosamente!';
        $alert_type = 'success';
    } catch (PDOException $e) {
        if ($e->getCode() == '23503') {
            $message = 'Error: No se puede eliminar este rol porque está asignado a uno o más empleados.';
        } else {
            $message = 'Error al eliminar rol: ' . $e->getMessage();
        }
        $alert_type = 'danger';
    }
    header("Location: roles.php?status=$alert_type&message=" . urlencode($message));
    exit();
}

// Cargar rol para edición
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->execute([$id]);
        $rol_to_edit = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rol_to_edit) {
            $message = 'Rol no encontrado para edición.';
            $alert_type = 'warning';
        }
    } catch (PDOException $e) {
        $message = 'Error al cargar rol para edición: ' . $e->getMessage();
        $alert_type = 'danger';
    }
}

// Cargar todos los roles para la lista
try {
    $sql = "SELECT r.*, COUNT(er.id) as empleados_asignados 
            FROM roles r
            LEFT JOIN empleado_roles er ON r.id = er.rol_id
            GROUP BY r.id
            ORDER BY nombre_rol ASC";
    $stmt = $pdo->query($sql);
    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Error al cargar roles: ' . $e->getMessage();
    $alert_type = 'danger';
    $roles = [];
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
    <title>Gestionar Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .container { margin-top: 20px; }
        .card { margin-bottom: 20px; }
        .table-responsive { overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Gestionar Roles</h1>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $alert_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><?php echo ($rol_to_edit ? 'Editar Rol' : 'Agregar Nuevo Rol'); ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="roles.php">
                    <?php if ($rol_to_edit): ?>
                        <input type="hidden" name="id_rol" value="<?php echo htmlspecialchars($rol_to_edit['id']); ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="nombre_rol" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" 
                               value="<?php echo htmlspecialchars($rol_to_edit['nombre_rol'] ?? ''); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?php echo ($rol_to_edit ? 'Actualizar Rol' : 'Agregar Rol'); ?>
                    </button>
                    <?php if ($rol_to_edit): ?>
                        <a href="roles.php" class="btn btn-secondary">Cancelar Edición</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Roles Existentes</h5>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#asignarRolModal">
                    <i class="bi bi-person-plus"></i> Asignar Rol a Empleado
                </button>
            </div>
            <div class="card-body">
                <?php if (count($roles) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del Rol</th>
                                    <th>Empleados Asignados</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roles as $rol): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($rol['id']); ?></td>
                                        <td><?php echo htmlspecialchars($rol['nombre_rol']); ?></td>
                                        <td><?php echo htmlspecialchars($rol['empleados_asignados']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editRolModal"
                                                    data-id="<?php echo $rol['id']; ?>"
                                                    data-nombre="<?php echo htmlspecialchars($rol['nombre_rol']); ?>">
                                                <i class="bi bi-pencil"></i> Editar
                                            </button>
                                            <button class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteRolModal"
                                                    data-id="<?php echo $rol['id']; ?>"
                                                    data-nombre="<?php echo htmlspecialchars($rol['nombre_rol']); ?>">
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
                        No hay roles registrados.
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <a href="index.php" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Volver al Inicio
        </a>
    </div>

    <!-- Modal para Asignar Rol a Empleado -->
    <div class="modal fade" id="asignarRolModal" tabindex="-1" aria-labelledby="asignarRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="roles.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="asignarRolModalLabel">Asignar Rol a Empleado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="empleado_id" class="form-label">Empleado</label>
                            <select class="form-select" id="empleado_id" name="empleado_id" required>
                                <option value="" selected disabled>Seleccione un empleado</option>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?php echo $empleado['id']; ?>">
                                        <?php echo htmlspecialchars($empleado['nombre'] . ' ' . $empleado['apellido']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rol_id" class="form-label">Rol</label>
                            <select class="form-select" id="rol_id" name="rol_id" required>
                                <option value="" selected disabled>Seleccione un rol</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?php echo $rol['id']; ?>">
                                        <?php echo htmlspecialchars($rol['nombre_rol']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="asignar_rol" value="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Asignar Rol</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Rol -->
    <div class="modal fade" id="editRolModal" tabindex="-1" aria-labelledby="editRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="roles.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRolModalLabel">Editar Rol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_rol" id="edit_id_rol">
                        <div class="mb-3">
                            <label for="edit_nombre_rol" class="form-label">Nombre del Rol</label>
                            <input type="text" class="form-control" id="edit_nombre_rol" name="nombre_rol" required>
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

    <!-- Modal para Eliminar Rol -->
    <div class="modal fade" id="deleteRolModal" tabindex="-1" aria-labelledby="deleteRolModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRolModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de eliminar el rol "<span id="delete_rol_nombre"></span>"?</p>
                    <p class="text-danger">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDelete" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script para manejar los modales de edición y eliminación
        document.addEventListener('DOMContentLoaded', function() {
            // Modal de edición
            var editRolModal = document.getElementById('editRolModal');
            if (editRolModal) {
                editRolModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-nombre');
                    
                    document.getElementById('edit_id_rol').value = id;
                    document.getElementById('edit_nombre_rol').value = nombre;
                });
            }
            
            // Modal de eliminación
            var deleteRolModal = document.getElementById('deleteRolModal');
            if (deleteRolModal) {
                deleteRolModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-nombre');
                    
                    document.getElementById('delete_rol_nombre').textContent = nombre;
                    document.getElementById('confirmDelete').href = 'roles.php?action=delete&id=' + id;
                });
            }
        });
    </script>
</body>
</html>