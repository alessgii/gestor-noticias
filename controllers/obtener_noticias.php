<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config/conn.php";

$totalNoticias = 0;

try {
    $query = "SELECT COUNT(*) FROM noticias";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $totalNoticias = $stmt->fetchColumn();
    
} catch (Throwable $e) {
    echo "". $e->getMessage();
}