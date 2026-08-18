<?php
require_once("../config/conn.php");
header("Content-Type: application/json");

$noticia = [];

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset( $_GET["id"] )) {
    $id = $_GET["id"];

    try {
        $query = "SELECT 
        n.id,
        n.titulo,
        n.contenido,
        n.imagen_url,
        n.fecha_publicacion,
        n.categoria_id
        FROM noticias n
        WHERE n.id = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $id
            ]);
        $noticia = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($noticia) {
            echo json_encode([
                "succes" => true,
                "data" => $noticia
            ]);
        } else {
            echo json_encode([
                'succes' => false
            ]);
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }


} else {
    echo "error xd";
}