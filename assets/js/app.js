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

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`)
        }

        const result = await response.json();

        if (result.status === 'success') {

            totalNoticias.textContent = result.total;
            container.innerHTML = '';

            if (result.data.length === 0) {
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

        if (!result.status !== 'success') {
            return;
        }

        const noticia = result.data;
        document.getElementById('noticia-id').value = noticia.id;
        document.getElementById('edit-titulo').value = noticia.titulo;
        document.getElementById('edit-contenido').value = noticia.contenido;
        document.getElementById('edit-categoria').value = noticia.categoria_id;
    } catch {
        showNotifications('Error', 'Ocurrió un error en la conexión.');
    }

}

async function eliminar(id) {

    try {
        const response = await fetch(`controllers/eliminar_noticia.php?id=${id}`, { method: 'DELETE' });
        const result = await response.json();


        if (result.status === 'error') {
            messageType.textContent = "Error";
            message.textContent = result.message;
            return;
        }
        showNotifications("OK", result.message);
        cargarNoticias();


    } catch {
        showNotifications("Error", "Ocurrió un error en la conexión.");
    }

}

const formEdit = document.getElementById('form-edit');
formEdit.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formEdit)
    const datos = Object.fromEntries(formData.entries());

    try {
        const response = await fetch(`controllers/editar_noticias.php`,
            {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(datos)
            }
        );

        if (!response.ok) {
            showNotifications('Error', 'Error en la consulta.');
            return;
        }
        const result = await response.json();

        if (result.status !== 'success') {
            showNotifications(result.status, result.message);

        }

        cargarNoticias();
        document.getElementById('modal-editar').close();
    } catch {
        document.getElementById('modal-editar').close();
        showNotifications('Error', 'Ocurrió un error en la conexión.')
    }
});

function showNotifications(type, message) {
    modalNotis.showModal();
    messageType.textContent = type;
    message.textContent = message;
}

// async function crearNoticia() {
const formCreate = document.getElementById('form-create');

formCreate.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formCreate);

    try {

        const response = await fetch(`controllers/crear_noticia.php`,
            {
                method: 'POST',
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
