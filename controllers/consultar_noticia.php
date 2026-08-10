<?php
require_once("../config/conn.php");
header("Content-Type: aplication/json");

$noticia = [];

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset( $_GET["id"] )) {
$id = $_GET["id"];

try {

    $query = "SELECT 
    n.id,
    n.titulo,
    n.resumen,
    n.contenido,
    n.imagen_url,
    n.fecha_publicacion,
    c.nombre AS categoria
    FROM noticias n
    INNER JOIN categorias c ON n.categoria_id = c.id
    WHERE n.id = ?";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        $id
        ]);
    $noticia = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if($noticia) {
        echo json_encode($noticia);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'noticia no encontrada']);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


} else {
    echo "error xd";
}