<?php
session_start();
require_once "../config/conn.php";


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    try {
        $query = "DELETE FROM noticias WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([":id" => $id]);

        if( $stmt->rowCount() > 0) {
            $_SESSION['mensaje'] = "La noticia se ha eliminado con éxito.";
            $_SESSION['tipo-msj'] = "succes";
        } else { 
            $_SESSION['mensaje'] = "Error al eliminar la noticia, intenta de nuevo. ($id)";
            $_SESSION['tipo-msj'] = "error";            
        }

    } catch (Throwable $e) {
        $_SESSION['mensaje'] = $e->getMessage();
        $_SESSION['type-msj'] = "error";

    }

        header("Location: ../index.php");
        exit();

} else {
    echo "No se recibio el POST";
    // header('Location: ../index.php');
    // exit();
}

