
// Obtener la informacion para mostrarla en los campos de edicion
async function edit(id) {
    document.getElementById('modal-editar').showModal();
    // hacer la consulta
    const response = await fetch(`controllers/consultar_noticia.php?id=${id}`);
    const result = await response.json();

    if(!result.succes) {
        return;
    }

    const noticia = result.data;
    document.getElementById('noticia-id').value =noticia.id;
    document.getElementById('edit-titulo').value = noticia.titulo;
    document.getElementById('edit-resumen').value = noticia.resumen;
    document.getElementById('edit-categoria').value = noticia.categoria_id;
}

