<!doctype html>
<html lang="es">

<head>
    
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shorcut icon" type="image/x-icon" href="assets/icons/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Panel de administración: Noticias</title>
</head>

<body class="bg-zinc-800">

    <!-- HEADER -->
    <header class="w-screen h-20 flex items-center justify-between bg-zinc-900 border-b-2 border-indigo-600">
        <div class="w-1/4 px-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Panel de Administración
            </h2>
        </div>
        <nav class="">
            <div class="flex flex-row">
                <a href="#inicio" class=" px-3 py-1 mr-4 no-underline rounded-s text-white hover:font-bold">INICIO</a>
                <a href="/pagina-teleinformatica/noticias"
                    class=" px-3 py-1 mr-4 no-underline rounded-xl text-white hover:font-bold">NOTICIAS</a>
                <a href="#" class=" px-3 py-1 mr-4 no-underline rounded-xl text-white hover:font-bold">SOPORTE</a>
            </div>
        </nav>
    </header>

    <!-- SECCION PRINCIPAL -->
    <section class="main">
        <!-- Informacion del panel -->
        <div class="flex flex-col-2 justify-between align-items-center p-5 m-5 text-white" >
            <div>
                <h2 class=" font-bold text-2xl">Panel de administración de noticias</h2>
                <p class=" pt-1">Herramienta interna - Ingeniería en Teleinformática</p>
            </div>
            <h2 class="w-60 h-10 text-center bg-indigo-800 rounded-xl p-1 font-bold">Noticias publicadas:
            <span id="total-noticias">Cargando</span>
            </h2>
        </div>

        <!-- Contenedor de formularios -->
        <div class="flex">
        <!-- Formulario: creacion de noticia -->
            <form id="form-create" enctype="multipart/form-data"
                class=" w-180 h-150 flex flex-col align-items-center p-10 m-15 text-white bg-zinc-900 border-2 rounded-2xl border-indigo-800">
                <label class="text-xl font-black" for="">Publicar una noticia</label>

                <label class="pt-6 mb-3 font-extrabold" for="titulo">Titulo:</label>
                <input type="text" name="titulo" required placeholder="Escribe el titulo" id="titulo"
                    class="border-2 border-white rounded-sm p-2">

                <!-- <label class="pt-6 mb-3 font-extrabold" for="resumen">Resumen:</label>
                <input type="text" name="resumen" placeholder="Escribe un resumen" required id="resumen" class="border-2 border-white rounded-sm p-2"> -->

                <label class="pt-6 pb-3 font-extrabold" for="contenido">Contenido:</label>
                <input type="text" name="contenido" placeholder="Redacta la noticia" required id="contenido" class="border-2 border-white rounded-sm p-2">

                <div class="flex flex-col align-items-center">
                    <label class="pt-6 pb-3 font-extrabold" for="categoria">Categoria:</label>
                    <select name="categoria" required id="categoria" class="border-2 border-white rounded-sm p-2">
                        <option value="" disabled selected>Seleccionar categoría</option>
                        <option value="1">Logros</option>
                        <option value="2">Alianzas</option>
                        <option value="3">Avisos</option>
                    </select>
                </div>

                <label for="file" class="pt-6 pb-3 font-extrabold">Subir portada:</label>
                <input type="file" name="imagen" id="imagen" accept=".jpg, .jpeg, .png"
                class="rounded-sm p-2 bg-indigo-600">

                <input class="m-10 mt-10 p-3 bg-indigo-700 font-black text-xl rounded-xl" type="submit"
                    value="Publicar noticia">
            </form>

            <!-- Mostrar noticias publicadas -->
            <div class="w-full text-white p-10 m-15 bg-zinc-900 border-2 border-indigo-600 rounded-2xl">
                <div>
                    <h3 class="text-2xl font-extrabold">Noticias publicadas:</h3>
                    <!-- <button>Actualizar</button> -->
                </div>

                <div id="news-container" class="news-container">

                </div>
            </div>

            <!-- modal-editar -->
             <dialog id="modal-editar" class="w-1/3 h-120 bg-zinc-800 border-2 border-indigo-800 rounded-2xl text-white p-5 m-auto align-items-center">

                <form id="form-edit" class="flex flex-col">
                <h3 class="font-bold text-xl mb-3">Editar noticia</h3>

                <input type="hidden" name="id" required id="noticia-id">

                <label for="titulo" class="font-bold">Titulo:</label>
                <input type="text" name="titulo" id="edit-titulo" required class="border-2 border-white rounded-sm p-1 mt-2">

                <label for="resumen" class="font-bold mt-2">Contenido:</label>
                <textarea name="contenido" id="edit-contenido" required class="border-2 border-white rounded-sm p-1 mt-2"></textarea>

                <div class="flex flex-col align-items-center">
                    <label class="pt-6 pb-3 font-extrabold" for="edit-categoria">Categoria:</label>
                    <select name="categoria_id" id="edit-categoria" required class="border-2 border-white rounded-sm p-2">
                        <option value="" disabled>Seleccionar categoría</option>
                        <option value="1">Logros</option>
                        <option value="2">Alianzas</option>
                        <option value="3">Avisos</option>
                    </select>
                </div>

                <div class="flex flex-col-2 mt-13 align-items-center backdrop:backdrop-blur-sm backdrop:bg-slate-950/80">
                    <button class="w-1/2  font-bold rounded-sm border-white bg-indigo-700 p-1 mb-3"
                    type="submit" id="submit-edit">
                        Editar
                    </button>
                    <button type="button" class="w-1/2 font-bold rounded-sm border-white bg-indigo-700 p-1 mb-3 ml-6"
                    onclick="document.getElementById('modal-editar').close()">
                        Cancelar
                    </button>
                </div>
                </form>
             </dialog>
        </div>

        <!-- modal-notificaciones -->
         <dialog id="modal-notifications">
            <div>
                <h3 id="message-type"></h3>
                <p id="message"></p>
                <button type="button" onclick="document.getElementById('modal-notifications').close()">
                    Aceptar
                </button>
            </div>
         </dialog>

         <!-- modal-delete-confirmation -->
         <dialog id="modal-delete-confirmation">
            <div>
                <h3>Estás a punto de eliminar una noticia</h3>
                <p>Nombre noticia</p>
                <button onclick="" id="btn-delete-confirmation">ELIMINAR</button>
                <button onclick="document.getElementById('modal-delete-confirmation').close()">CANCELAR</button>
            </div>

         </dialog>

    </section>

    <script src="assets/js/app.js"></script>
</body>
</html>