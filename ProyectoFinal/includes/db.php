<?php
// Parámetros de conexión a la base de datos
$host = 'localhost';        
$dbname = 'dblibreria';      
$username = 'root';         
$password = 'admin';            

try {
    // Crear una instancia de PDO para conectar con la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Establecer el modo de error para que arroje excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Establecer el charset a UTF-8 para evitar problemas con caracteres especiales
    $pdo->exec("set names utf8");
    
} catch (PDOException $e) {
    // Manejo por si ocurre un error de conexión
    echo "Error de conexión: " . $e->getMessage();
    exit();
}
?>
