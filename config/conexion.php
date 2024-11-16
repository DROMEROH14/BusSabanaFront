<?php

$host = 'localhost';      
$dbname = 'SabanaBus';     
$username = 'root';       
$password = '';           

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $e->getMessage()]);
    exit; 
}
?>
