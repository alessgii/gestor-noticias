<?php
session_start();
require_once "../config/conn.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titulo = trim($_POST['titulo'] ?? '');
    $resumen = trim($_POST['resumen'] ?? '');
    $contenido = trim($_POST['contenido'] ?? '');
    $categoria_id = trim($_POST['categoria'] ?? '');

    if(!empty($titulo) && !empty($resumen) && !empty($contenido) && !empty($categoria_id)) {
    try {
    $query = "
        INSERT INTO noticias (titulo, resumen, contenido, categoria_id) values
        (:titulo, :resumen, :contenido, :categoria_id)

    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':titulo'=>$titulo,
        ':resumen'=>$resumen,
        ':contenido'=> $contenido,
        ':categoria_id'=>$categoria_id
    ]);

    $_SESSION['mensaje'] = "La noticia se ha publicado correctamente.";
    $_SESSION['tipo-msj'] = "succes";

    } catch (PDOException $e) {
        die("Error en la consulta SQL: " . $e->getMessage());

    }
    } else {
        $_SESSION['mensaje'] = "Por favor, rellena todos los campos.";
        $_SESSION['tipo-msj'] = "error";
    }
    header("Location: ../index.php");
} else {
    exit();
}





