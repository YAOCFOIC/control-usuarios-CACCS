<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Preparar la consulta SQL para eliminar el empleado
        $sql = "DELETE FROM empleados WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        header("Location: listar_empleados.php?status=success_delete");
        exit();
    } catch (PDOException $e) {
        header("Location: listar_empleados.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: listar_empleados.php?status=error&message=" . urlencode("ID de empleado no especificado."));
    exit();
}
?>