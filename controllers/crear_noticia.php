<?php

require_once("../config/conn.php");
if(isset($_POST['titulo']) && isset($_POST['resumen']) && isset($_POST['contenido'])) {

try {
$query = "
    INSERT INTO noticias (id, titulo, resumen, contenido, imagen_url, fecha_publicacion, categoria_id) values
    ()

";
} catch (PDOException $e) {
    die("Error en la consulta SQL: " . $e->getMessage());

}}


