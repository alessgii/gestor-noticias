<?php
require_once "../config/conn.php";
header("Content-Type: application/json; charset=utf-8");

try {
    $query = "SELECT id, titulo, contenido FROM noticias ORDER BY fecha_publicacion DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'total' => count($noticias),
        'data' => $noticias 
    ]);
    
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status'=> 'error',
        'message'=> 'Error al obtener las noticias.' . $e->getMessage()
    ]);
}