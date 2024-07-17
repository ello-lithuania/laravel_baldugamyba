<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Puslapis nerastas</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto min-h-screen max-w-screen-xl lg:py-16 lg:px-6 flex items-center justify-center">
            <div class="mx-auto max-w-screen-sm text-center">
                <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Neradome puslapio.</p>
                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Atsiprašome neradome puslapio, įvyko klaida. </p>
                <a href="{{ url('/') }}" class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Grižti į pradžią</a>
            </div>
        </div>
    </section>

</body>
</html>
