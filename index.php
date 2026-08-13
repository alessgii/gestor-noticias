<?php
session_start();
require_once "controllers/obtener_noticias.php";
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Panel de administración: Noticias</title>
</head>

<body class="bg-zinc-800">
    <header class="w-screen h-20 flex items-center justify-between bg-zinc-900 border-b-2 border-indigo-600">
        <div class="w-1/4 px-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Panel de Administración
            </h2>
        </div>
        <nav class="">
            <div class="flex flex-row">
                <a href="#inicio" class=" px-3 py-1 mr-4 no-underline rounded-s text-white hover:font-bold">INICIO</a>
                <a href="/pagina-teleinformatica/index.php?page=noticias"
                    class=" px-3 py-1 mr-4 no-underline rounded-xl text-white hover:font-bold">NOTICIAS</a>
                <a href="#" class=" px-3 py-1 mr-4 no-underline rounded-xl text-white hover:font-bold">SOPORTE</a>
            </div>
        </nav>
    </header>

    <section class="main">
        <!-- Informacion del panel -->
        <div class="flex flex-col-2 justify-between align-items-center p-5 m-5 text-white" >
            <div>
                <h2 class=" font-bold text-2xl">Panel de administración de noticias</h2>
                <p class=" pt-1">Herramienta interna - Ingeniería en Teleinformática</p>
            </div>
            <span class="w-60 h-10 text-center bg-indigo-800 rounded-xl p-1 font-bold">Noticias publicadas: <?php echo $totalNoticias; ?> </span>
        </div>

        <!-- Alertas -->
        <?php if(isset($_SESSION['mensaje'])): ?>
            <div class="text-white border-2 border-white rounded-2xl p-5 alert-<?php echo $_SESSION['tipo-msj'];?>">
                <p><?php echo $_SESSION['mensaje'];?></p>

            </div>
            <?php
                unset($_SESSION['mensaje']);
                unset($_SESSION['tipo-msj']);
            ?>
        <?php endif; ?>

        <!-- Contenedor de formularios -->
        <div class="flex flex-col-2">
        <!-- Formulario: creacion de noticia -->
            <form action="controllers/crear_noticia.php" method="POST"
                class=" w-180 h-150 flex flex-col align-items-center p-10 m-15 text-white bg-zinc-900 border-2 rounded-2xl border-indigo-800">
                <label class="text-xl font-black" for="">Publicar una noticia</label>

                <label class="pt-6 mb-3 font-extrabold" for="titulo">Titulo:</label>
                <input type="text" name="titulo" required placeholder="Escribe el titulo" id=""
                    class="border-2 border-white rounded-sm p-2">

                <label class="pt-6 mb-3 font-extrabold" for="resumen">Resumen:</label>
                <input type="text" name="resumen" placeholder="Escribe un resumen" required id="" class="border-2 border-white rounded-sm p-2">

                <label class="pt-6 pb-3 font-extrabold" for="contenido">Contenido:</label>
                <input type="text" name="contenido" placeholder="Redacta la noticia" required id="" class="border-2 border-white rounded-sm p-2">

                <div class="flex flex-col align-items-center">
                    <label class="pt-6 pb-3 font-extrabold" for="categoria">Categoria:</label>
                    <select name="categoria" required id="" class="border-2 border-white rounded-sm p-2">
                        <option value="" disabled selected>Seleccionar categoría</option>
                        <option value="1">Logros</option>
                        <option value="2">Alianzas</option>
                        <option value="3">Avisos</option>
                    </select>
                </div>

                <input class="m-10 mt-10 p-3 bg-indigo-700 font-black text-xl rounded-xl" type="submit"
                    value="Publicar noticia">
            </form>

            <!-- Mostrar noticias publicadas -->
            <div class="w-full text-white p-10 m-15 bg-zinc-900 border-2 border-indigo-600 rounded-2xl">
                <h3 class="text-2xl font-extrabold">Noticias publicadas:</h3>
                <?php if($totalNoticias > 0): ?>
                <?php foreach($noticias as $noticia): ?>
                    <div class="flex flex-col-2 p-5">
                        <!-- Noticia -->
                        <h3 class="m-3"><?php echo htmlspecialchars($noticia['titulo']) ?></h3>
                        <p class="m-3"><?php echo htmlspecialchars($noticia['resumen']) ?></p>

                        <!-- Boton: eliminar noticia -->
                        <form action="controllers/eliminar_noticia.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">
                            <input type="submit" value="Eliminar" class="w-25 h5 ml-40 mt-3 mb-3 bg-indigo-800 rounded-xl font-bold text-center">

                        </form>
                        <!-- Boton: editar noticia -->
                        <div>
                            <input type="hidden" name="id" value="<?php echo $noticia['id']; ?>">
                            <button onclick="edit(<?php echo $noticia['id']; ?>)"
                            class="w-25 h5 ml-3 mt-3 mb-3 bg-indigo-800 rounded-xl font-bold text-center">
                                Editar
                            </button>


                        </div>
                    </div>

                <?php endforeach; ?>

                <?php else: ?>
                    <div>
                        <p class="mt-10 font-bold">No hay noticias publicadas. 
                            Prueba a crear una publicación!
                        </p>
                    </div>
                <?php endif;?>
            </div>

            <!-- modal-editar -->
             <dialog id="modal-editar" class="w-1/3 h-120 bg-zinc-800 border-2 border-indigo-800 rounded-2xl text-white p-5 m-auto align-items-center">

                <form class="flex flex-col">
                <h3 class="font-bold text-xl mb-3">Editar noticia</h3>

                <input type="hidden" name="edit-id" required id="noticia-id">

                <label for="titulo" class="font-bold">Titulo:</label>
                <input type="text" id="edit-titulo" required class="border-2 border-white rounded-sm p-1 mt-2">

                <label for="resumen" class="font-bold mt-2">Resumen:</label>
                <textarea name="edit-resumen" id="edit-resumen" required class="border-2 border-white rounded-sm p-1 mt-2"></textarea>

                <div class="flex flex-col align-items-center">
                    <label class="pt-6 pb-3 font-extrabold" for="edit-categoria">Categoria:</label>
                    <select name="edit-categoria" id="edit-categoria" required class="border-2 border-white rounded-sm p-2">
                        <option value="" disabled>Seleccionar categoría</option>
                        <option value="1">Logros</option>
                        <option value="2">Alianzas</option>
                        <option value="3">Avisos</option>
                    </select>
                </div>

                <div class="flex flex-col-2 mt-13 align-items-center">
                    <button class="w-1/2  font-bold rounded-sm border-white bg-indigo-700 p-1 mb-3"
                    type="submit" id="submit">
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
    </section>

    <script src="assets/js/app.js"></script>
</body>
</html>