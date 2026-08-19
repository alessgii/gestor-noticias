<?php
require_once "../config/conn.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$inputRaw = file_get_contents("php://input");
$data = json_decode($inputRaw, true);

if(empty($data)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message'=> 'No se enviaron campos para actualizar.'
    ]);
    exit;
}

$id = $data['id'];
$titulo = $data['titulo'];
$contenido = $data['contenido'];
$categoria_id = $data['categoria_id'];

try {

    $query = "
        UPDATE noticias
        SET titulo = :titulo,
            contenido = :contenido,
            categoria_id = :categoria_id
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($query);
    
    $stmt->execute([
        ':titulo' => $titulo,
        ':contenido' => $contenido,
        ':categoria_id' => $categoria_id,
        ':id' => $id
        ]);

    echo json_encode([
        'status'=> 'success',
        'message'=> $data
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status'=> 'error',
        'message'=> 'Ocurrió un error en la conexión.'
    ]);    
}


// if($_SERVER['REQUEST_METHOD'] == 'PATCH') {
    
// }