<?php
// db.php
try {
    $host = 'gestor_db';
    $dbname = 'gestor';
    $user = 'postgres';
    $password = 'ale2025';

    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Comenta o elimina esta línea una vez que confirmes que funciona:
    // echo "DEBUG: Conexión a PostgreSQL exitosa en db.php<br>"; 

} catch (PDOException $e) {
    echo "DEBUG: Error de conexión a la base de datos en db.php: " . $e->getMessage() . "<br>";
    $pdo = null;
}
?>
