<?php
require_once "../config/conn.php";
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(404);

    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido.'
    ]);

    exit;
}

$titulo = trim($_POST['titulo'] ?? '');
$contenido = trim($_POST['contenido'] ?? '');
$categoria_id = trim($_POST['categoria'] ?? '');

if (empty($titulo) || empty($contenido) || empty($categoria_id)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Faltan campos por completar."
    ]);

    exit;
}

$imagen_url = null;

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
    $archivo = $_FILES['imagen'];

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);

        echo json_encode([
            'status' => 'error',
            'message' => 'Ocurrió un error al subir la imagen.'
        ]);

        exit;
    }

    $maxSize = 5 * 1024 * 1024;
    if ($archivo['size'] > $maxSize) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'La imagen no debe superar los 5MB.'
        ]);
        exit;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($archivo['tmp_name']);
    $archivosPermitidos = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    if (!array_key_exists($mime, $archivosPermitidos)) {
        http_response_code(400);

        echo json_encode([
            'status' => 'error',
            'message' => 'Formato de archivo no permitido.'
        ]);
        exit;
    }

    $nombreArchivo = bin2hex(random_bytes(16));
    $extension = $archivosPermitidos[$mime];
    $nombreArchivo .= '.' . $extension;

    $directorio = "/var/www/html/pagina-teleinformatica/public/img/uploads/noticias/";
    $ruta = $directorio . $nombreArchivo; 
    $imagen_url = "public/img/uploads/noticias" . $nombreArchivo;

    if (!is_dir($directorio)) {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'No existe la ruta ' . $directorio
        ]);
        exit;
    }

    if (!move_uploaded_file($archivo['tmp_name'], $ruta)) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'No se pudo guardar la imagen en el servidor: ' . $ruta
        ]);
        exit;
    }
}


try {
    $query = "
            INSERT INTO noticias (
            titulo,
            contenido,
            imagen_url,
            categoria_id
            ) 
            VALUES
            (:titulo, :contenido, :imagen_url, :categoria_id);
             ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':titulo' => $titulo,
        ':contenido' => $contenido,
        ':imagen_url' => $imagen_url,
        ':categoria_id' => $categoria_id
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success',
            'message' => 'La noticia se ha publicado correctamente.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Ocurrió un error al publicar la noticia.'
        ]);
    }
} catch (PDOException $e) {

    if($imagen_url !== null) {
        $archivo_guardado = __DIR__ . "/../" . $imagen_url;

        if(file_exists($archivo_guardado)) {
            unlink($archivo_guardado);
        }
    }

    http_response_code(500);
    json_encode([
        'status' => 'error',
        'message' => 'Ocurrió un error al crear la noticia.' 
    ]);
}
