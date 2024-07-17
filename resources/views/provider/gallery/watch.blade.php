@extends('layouts.guest')

@section('title', $gallery->title)

@section('content')

    <div class="bg-gray-100 py-8 container">
        <h2 class="text-2xl font-bold text-gray-800 text-center mt-8">{{ $gallery->title }}</h2>
        <p class="text-center mb-8">{{ $gallery->description }}</p>

        <div class="">

            <div id="gallery" class="flex flex-wrap -mx-4 justify-start">

                @foreach ($gallery->images as $index => $image )
                <div class="w-1/4 px-4 mb-4 relative">
                    <img src="{{ $public . '/' . $image['file_path'] }}" alt="Gallery Image" class="w-full h-auto cursor-pointer"
                        onclick="openLightbox({{ $index }})">
                </div>
                @endforeach
            </div>

            <!-- Lightbox Modal -->
            <div id="lightbox" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 flex justify-center items-center z-50 hidden">
                <button class="absolute top-4 right-4 text-white text-xl" onclick="closeLightbox()">✕</button>
                <button class="absolute top-1/2 transform -translate-y-1/2 left-4 text-white text-xl" onclick="prevImage()">‹</button>
                <button class="absolute top-1/2 transform -translate-y-1/2 right-4 text-white text-xl" onclick="nextImage()">›</button>
                <img id="lightbox-image" src="" alt="Lightbox Image">
                <p id="lightbox-caption" class="text-white text-center mt-4"></p>
            </div>

            <script>
                const images = @json($gallery->images);
                const public = @json($public);

                function openLightbox(index) {
                    console.log(public + '/' + images[index].file_path);
                    document.getElementById('lightbox-image').src = public + '/' + images[index].file_path;
                    document.getElementById('lightbox-caption').textContent = images[index].caption || '';
                    document.getElementById('lightbox').classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                    currentIndex = index;
                }

                function closeLightbox() {
                    document.getElementById('lightbox').classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }

                let currentIndex = 0;

                function nextImage() {
                    currentIndex = (currentIndex + 1) % images.length;
                    document.getElementById('lightbox-image').src = public + '/' + images[currentIndex].file_path;
                    document.getElementById('lightbox-caption').textContent = images[currentIndex].caption || '';
                }

                function prevImage() {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    document.getElementById('lightbox-image').src = public + '/' + images[currentIndex].file_path;
                    document.getElementById('lightbox-caption').textContent = images[currentIndex].caption || '';
                }

                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        closeLightbox();
                    } else if (event.key === 'ArrowRight') {
                        nextImage();
                    } else if (event.key === 'ArrowLeft') {
                        prevImage();
                    }
                });
            </script>

        </div>

        <a href="{{ route('provider.watch', $gallery->provider) }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Atgal
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>

    </div>

@endsection
