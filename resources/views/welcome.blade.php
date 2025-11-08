<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoodTrav</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-[#FDFDFC]">

        <x-navigation.header />

        <section class="bg-cover bg-center bg-no-repeat dark:bg-gray-900 h-[85vh]" style="background-image: url('https://www.conmishijos.com/uploads/tareas_escolares/quizpaises-1.jpg');">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6 h-full flex items-center">
                <div class="max-w-screen-md sm:text-center lg:text-left md:text-center">
                    <p class="mb-4 tracking-tight text-2xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-gray-900 dark:text-white">Aprende inglés, conquista nuevos retos y viaja más lejos.</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 sm:justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="text-white bg-[#5170ff] hover:bg-[#4158d0] focus:outline-none focus:ring-4 focus:ring-[#4158d0] font-medium rounded-full text-lg px-8 py-4 text-center cursor-pointer inline-block">Comenzar</a>
                    </div>
                </div>
            </div>
        </section>

        <livewire:component.card />

        <div class="bg-white dark:bg-gray-900">
            <section class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <p class="mb-4 text-4xl tracking-tight font-[600] text-gray-900 dark:text-white">Así funciona</p>
                <div class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 text-center gap-6 md:gap-6 items-stretch">
                    <div class="flex flex-col items-center rounded-2xl bg-[#51c7ff] border-5 border-[#9ce0ff] p-6 flex-1 inset-shadow-sm inset-shadow-[#5170ff] shadow-xl">
                        <div class="py-6">
                            <img src="https://i.pinimg.com/1200x/13/51/bf/1351bf9e366c5d9f2b0be9f5c3b9f2af.jpg" alt="Asi funciona" class="w-15">
                        </div>
                        <div class="flex flex-col gap-4 flex-1">
                            <p class="font-bold text-2xl">1. Se preparan antes de viajar.</p>
                            <p class="font-[400] underline underline-offset-2"><span class="font-bold">Objetivo:</span> Adquirir las frases y estructuras que necesitarán para poder comunicarse en el país destino.</p>
                            <p class="my-8">Cada lunes acceden a una nueva clase de inglés online y a un reto que deben completar con lo aprendido. Disponen hasta el domingo a las 23:59 de esa semana para realizar ambos.</p>
                            <p class="">Aquí aprenden las expresiones que usarán en el viaje: pedir comida, comprar, orientarse…</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center rounded-2xl bg-[#70ff51] border-5 border-[#99ff83] p-6 flex-1 inset-shadow-sm inset-shadow-[#418b31] shadow-xl">
                        <div class="py-6">
                            <img src="https://i.pinimg.com/1200x/13/51/bf/1351bf9e366c5d9f2b0be9f5c3b9f2af.jpg" alt="Asi funciona" class="w-15">
                        </div>
                        <div class="flex flex-col gap-4 flex-1">
                            <p class="font-bold text-2xl">2. Ganan puntos GT</p>
                            <p class="font-[400] underline underline-offset-2"><span class="font-bold">Objetivo:</span> Asegurar que lleguen al viaje con confianza y soltura, no a "probar suerte". Así el aprendizaje será mucho mayor.</p>
                            <p>Cada clase que ven y reto que completan suma puntos GT.</p>
                            <p>Los puntos muestran su nivel de preparación real.</p>
                            <p>Cuantos más puntos, más preparados estarán, más avanzados serán sus retos de inglés en el país destino y, por lo tanto, más aprenderán en los viajes.</p>
                            <p>Por eso recomendamos unirse a la comunidad GoodTrav desde los 11 años, incluso si el viaje será más adelante.</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center rounded-2xl bg-[#ff5170] border-5 border-[#ff8399] p-6 flex-1 inset-shadow-sm inset-shadow-[#ae3a4f] shadow-xl md:col-span-2 lg:col-span-1 md:max-w-md md:mx-auto">
                        <div class="py-6">
                            <img src="https://i.pinimg.com/1200x/13/51/bf/1351bf9e366c5d9f2b0be9f5c3b9f2af.jpg" alt="Asi funciona" class="w-15">
                        </div>
                        <div class="flex flex-col gap-4 flex-1">
                            <p class="font-bold text-2xl">3. Viajan y práctican lo aprendido.</p>
                            <p class="font-[400] underline underline-offset-2"><span class="font-bold">Objetivo:</span> Practicar inglés en situaciones reales a través de retos que tienen que completar hablando con personas nativas.</p>
                            <p>Una vez obtenidos los puntos requeridos para un destino, están listos para viajar.</p>
                            <p>Son viajes de 5 días donde han de completar retos interactuando con hablantes nativos mientras el profesor los supervisa y corrige.</p>
                            <p>Sin riesgos. No hay familias de acogida. Los alumnos viajan y duermen con su grupo y profesores, siempre seguros.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <livewire:component.opiniones />

        <div class="bg-white dark:bg-gray-900">
            <section class="py-8 px-4 mx-auto lg:max-w-screen-xl xl:max-w-4xl md:max-w-screen-md sm:py-16 lg:px-6">
                <p class="mb-4 text-4xl tracking-tight font-[600] text-gray-900 dark:text-white">Únete a la comunidad</p>
                <div class="flex flex-col md:grid gap-6 md:gap-6 items-stretch">
                    <div class="flex flex-col items-start rounded-2xl bg-[#70ff51] border-5 border-[#99ff83] p-6 flex-1 inset-shadow-sm inset-shadow-[#418b31] shadow-xl">
                        <div class="flex flex-col lg:gap-4 md:gap-2 flex-1 lg:p-8 md:p-4">
                            <p class="font-bold lg:text-4xl md:text-2xl">GoodTrav incluye:</p>
                            <ul class="list-disc list-inside lg:text-xl md:text-base">
                                <li>Clases online enfocadas en prepararlos para moverse por el mundo</li>
                                <li>Retos de inglés semanales que tienen que completar</li>
                                <li>Puntos GT para medir su aprendizaje y progreso</li>
                                <li class="font-bold">Acceso a viajes de inglés seguros, con profesores cualificados 24/7</li>
                            </ul>
                        </div>
                        <div class="flex flex-col p-8 justify-center text-center w-full">
                            <p class="font-bold lg:text-4xl md:text-2xl">1ª semana GRATIS</p>
                            <p>Después 16EUR/mes o <span class="font-bold">12EUR/mes</span> <br>
                            (si formas parte de uno de nuestros centros colaboradores)</p>
                        </div>
                        <div class="flex flex-col lg:p-8 md:p-4 justify-center text-center w-full">
                            <p class="lg:text-2xl md:text-base font-bold">Cancela cuando quieras.</p>
                        </div>
                        <div class="flex flex-col lg:p-8 md:p-4 md:mt-4 lg:mt-1 justify-center text-center lg:w-1/2 md:w-full mx-auto">
                            <button class="text-white bg-[#5170ff] hover:bg-[#4158d0] focus:outline-none focus:ring-4 focus:ring-[#4158d0] font-medium rounded-full text-lg px-8 py-4 text-center cursor-pointer inline-block">Quiero unirme GRATIS</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <livewire:component.colaboradores />

        <div class="bg-white dark:bg-gray-900">
            <section class="p-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <p class="mb-4 text-4xl tracking-tight font-[600] text-gray-900 dark:text-white">Preguntas frecuentes</p>
                <div class="grid grid-cols-1 gap-6 md:gap-6">
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿A partir de que edad pueden apuntarse a GoodTrav?</p>
                            <p class="text-base md:text-lg">Desde los 11 años. <br> Aunque el viaje lo quieran realizar más adelante, empezar antes permite acumular puntos GT, ganar práctica y llegar al viaje mucho más preparado y seguro. 
                            Eso hace que su aprendizaje en el extranjero sea mucho mayor.</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Cómo son las clases online?</p>
                            <p class="text-base md:text-lg">Las clases son online, impartidas por profesores nativos y bilingües. Están centradas en hablar, entender y aprender el inglés real que usarán en los viajes, por ejemplo, pedir agua en una cafeteria.
                                 Cada lunes a las 9:00 aparece una nueva clase y los alumnos dispondrán hasta el domingo a las 23:59 de esa semana para verla.</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Qué son los puntos GT?</p>
                            <p class="text-base md:text-lg">Cuantos más puntos consiguen, más avanzan en su aprendizaje y más listos están para viajar. 
                                Solo los alumnos con los puntos necesarios pueden acceder a los viajes, para asegurar que aprovechen la experiencia al máximo.</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Cómo son los viajes GoodTrav?</p>
                            <p class="text-base md:text-lg">Son viajes de 5 días, organizados y supervisados en todo momento por profesores nativos y bilingües.
                            Sin riesgos, no hay familias de acogida: los alumnos viajan y duermen con su grupo y profesores, en
                            un entorno seguro y acompañados las 24 horas del día. <br>
                            Durante el viaje, además de visitar, practican inglés con retos que preparan y supervisan los
                            profesores, donde van a tener que interactuar con personas locales para completarlos.</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Quién acompaña a los alumnos?</p>
                            <p class="text-base md:text-lg">Todo el viaje está coordinado por el equipo GoodTrav, formado por profesores nativos y bilingües y
                            personal cualificado.
                            Están con los alumnos desde la salida hasta el regreso, garantizando seguridad y apoyo constante.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Qué pasa si mi hijo quiere viajar pero aún no tiene los puntos suficientes?</p>
                            <p class="text-base md:text-lg">Podrá seguir preparándose con las clases y retos hasta alcanzarlos. <br> Los puntos nos garantizan que todos nuestros alumnos aprovechen el viaje de verdad, 
                            por eso es importante empezar cuanto antes.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Dónde se realizan los viajes?</p>
                            <p class="text-base md:text-lg">Los destinos pueden variar en cada edición, pero siempre son países de habla inglesa.
                            Seleccionamos lugares ideales para practicar el idioma en contextos reales, seguros y divertidos.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl border-5 p-6 md:p-8 shadow-sm">
                        <div class="py-2 grid gap-4">
                            <p class="font-bold text-xl md:text-2xl">¿Por qué empezar ya si mi hijo quiere viajar más adelante?</p>
                            <p class="text-base md:text-lg">Cuanto antes empiece, más puntos acumulará y más preparado estará para disfrutar y aprender durante su viaje. <br> Empezar pronto significa viajar con ventaja.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <livewire:form-contacto />

        <x-navigation.footer />

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
