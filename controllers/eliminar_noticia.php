<?php
require_once "../config/conn.php";


if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "DELETE FROM noticias WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id]);
      
        if( $stmt->rowCount() > 0) {
            echo json_encode([
                'status' => 'success',
                'message'=> 'La noticia se ha eliminado con éxito.'
            ]);
        } else { 
           echo json_encode([
            'status'=> 'error',
            'message'=> 'Ocurrió un error al eliminar la noticia. La noticia no existe.'
           ]);           
        }

    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode([
            'status'=> 'error',
            'message'=> $e->getMessage()
        ]);

    }

} else {
    http_response_code(500);
}

