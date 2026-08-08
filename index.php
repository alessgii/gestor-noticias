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
        <div class="flex flex-col-2 justify-between align-items-center p-5 m-5 text-white" >
            <div>
                <h2 class=" font-bold text-2xl">Panel de administración de noticias</h2>
                <p class=" pt-1">Herramienta interna - Ingeniería en Teleinformática</p>
            </div>
            <span class="w-60 h-10 text-center bg-indigo-800 rounded-xl p-1 font-bold">Noticias publicadas: 0</span>
        </div>

        <div>
            <form action=""
                class=" w-120 h-150 flex flex-col align-items-center p-10 m-15 text-white bg-zinc-900 border-2 rounded-2xl border-indigo-800">
                <label class="text-xl font-black" for="">Publicar una noticia</label>

                <label class="pt-6 mb-3 font-extrabold" for="titulo">Titulo:</label>
                <input type="text" name="titulo" require placeholder="Escribe el titulo" id=""
                    class="border-2 border-white rounded-sm p-2">

                <label class="pt-6 mb-3 font-extrabold" for="resumen">Resumen:</label>
                <input type="text" name="resumen" placeholder="Escribe un resumen" require id="" class="border-2 border-white rounded-sm p-2">

                <label class="pt-6 pb-3 font-extrabold" for="contenido">Contenido:</label>
                <input type="text" name="contenido" placeholder="Redacta la noticia" require id="" class="border-2 border-white rounded-sm p-2">

                <div class="flex flex-col align-items-center">
                    <label class="pt-6 pb-3 font-extrabold" for="categoria">Categoria:</label>
                    <select name="categoria" require id="" class="border-2 border-white rounded-sm p-2">
                        <option value="" disable selectd>Seleccionar categoría</option>
                        <option value="logros">Logros</option>
                        <option value="alianzas">Alianzas</option>
                        <option value="avisos">Avisos</option>
                    </select>
                </div>



                <input class="m-10 mt-10 p-3 bg-indigo-700 font-black text-xl rounded-xl" type="submit"
                    value="Publicar noticia">
            </form>
        </div>
    </section>

</body>

</html>