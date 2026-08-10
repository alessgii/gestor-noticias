<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "config/conn.php";

$noticias = [];
$totalNoticias = 0;


try {
    $query = "SELECT id, titulo, resumen FROM noticias ORDER BY fecha_publicacion DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalNoticias = count($noticias);
    // $totalNoticias = $stmt->fetchColumn();


    
} catch (Throwable $e) {
    echo "". $e->getMessage();
}