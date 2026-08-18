document.addEventListener('DOMContentLoaded', () => {
    cargarNoticias();
});

const modalNotis = document.getElementById('modal-notifications');
const messageType = document.getElementById('message-type');
const message = document.getElementById('message');

async function cargarNoticias() {
    const totalNoticias = document.getElementById('total-noticias');
    const container = document.getElementById('news-container');

    try {
        const response = await fetch(`controllers/obtener_noticias.php`);

        if(!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
        }

        const result = await response.json();

        if (result.status === 'success') {

            totalNoticias.textContent = result.total;
            container.innerHTML = '';

            if(result.data.length === 0) {
                container.innerHTML = '<p>No hay noticias publicadas</p>';
                return;
            }

            result.data.forEach(noticia => {
                const card = document.createElement('article');
                card.className = 'news-card flex flex-col-2 p-5';

                card.innerHTML = `
                    <h3 class="m-3">${noticia.titulo}</h3>
                    <p class="m-3">${noticia.contenido}</p>
                    <button onclick="eliminar(${noticia.id})" class="w-25 h5 ml-40 mt-3 mb-3 bg-red-600 rounded-xl font-bold text-center">Eliminar</button>

                    <button onclick="edit(${noticia.id})" class="w-25 h5 ml-3 mt-3 mb-3 bg-indigo-800 rounded-xl font-bold text-center">Editar</button>
                    
                `;

                container.appendChild(card);

            });

        } else {
            totalNoticias.textContent = '0';
            container.innerHTML = '<p>Error al cargar las noticias.</p>';
        }
     } catch (error) {
        totalNoticias.textContent = '0';
        container.innerHTML = '<p>Ocurrió un lll en la conexión.</p>';
    }
}

async function edit(id) {
    document.getElementById('modal-editar').showModal();
    try {
        const response = await fetch(`controllers/consultar_noticia.php?id=${id}`);
        const result = await response.json();

        if(!result.succes) {
            return;
        }

        const noticia = result.data;
        document.getElementById('noticia-id').value =noticia.id;
        document.getElementById('edit-titulo').value = noticia.titulo;
        document.getElementById('edit-resumen').value = noticia.contenido;
        document.getElementById('edit-categoria').value = noticia.categoria_id;

        cargarNoticias();
    } catch {
        // mensaje de error
    }
    
}

async function eliminar(id) {

    try {
        const response = await fetch(`controllers/eliminar_noticia.php?id=${id}`, {method: 'DELETE'});
        const result = await response.json();

        modalNotis.showModal();

        if (result.status === 'error') {
            messageType.textContent = "Error";
            message.textContent = result.message;
            return;
        }
        messageType.textContent = "OK";
        message.textContent = result.message;
        cargarNoticias();
        
        
    } catch {
        modalNotis.showModal();
        messageType.textContent = "Error";
        message.textContent = "Error en la conexión con la base de datos."
    }

}

// async function crearNoticia() {
    const form = document.getElementById('form-create');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {

            const response = await fetch(`controllers/crear_noticia.php`,
                {method: 'POST',
                body: formData
                }

            );
            const result = await response.json();

            if (!response.ok) {
                modalNotis.showModal();
                messageType.textContent = "Error";
                message.textContent = result.message;
                return;
            }
            modalNotis.showModal();
            messageType.textContent = "OK";
            message.textContent = result.message;

            cargarNoticias();
            form.reset();
    } catch {
            modalNotis.showModal();
            messageType.textContent = "Error";
            message.textContent = "Error al crear la noticia."
    }

    });

    
// }
