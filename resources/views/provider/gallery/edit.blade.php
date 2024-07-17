<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Redaguoti galeriją') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="py-4 px-6">
                <form action="{{ route('gallery.destroy', $gallery) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="text-white bg-red-500 rounded-lg px-4 py-2">Ištrinti galeriją</button>
                </form>
                </div>

                <form enctype="multipart/form-data" id="upload-form" method="POST" action="{{ route('gallery.update', $gallery) }}">
                    @csrf
                    @method('put')
                    <div class="py-4 px-6">
                        <h2 class="font-bold text-[1.3rem]">Sukurti darbų pavyzdžių ar atliktų darbų galeriją</h2>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">
                            <div>
                                <div class="flex flex-col h-full mb-8">
                                    <div class="flex flex-col">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pavadinimas</label>
                                        <input name="title" value="{{ old('title', $gallery->title) }}" id="pavadinimas" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite pavadinimą" />
                                        @if ($errors->has('title'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Aprašymas
                                        </label>
                                        <textarea name="description" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" rows="7" cols="7">{{ old('description', $gallery->description ) }}</textarea>
                                        @if ($errors->has('description'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>

                                <style>
                                    .preview {
                                        display: flex;
                                        flex-wrap: wrap;
                                    }
                                    .preview img {
                                        margin: 10px;
                                        width: 100px;
                                        height: 100px;
                                        object-fit: cover;
                                    }
                                    .preview .image-container {
                                        position: relative;
                                        display: inline-block;
                                    }
                                    .preview .image-container button {
                                        position: absolute;
                                        top: 5px;
                                        right: 5px;
                                        background: red;
                                        color: white;
                                        border: none;
                                        border-radius: 50%;
                                        cursor: pointer;
                                        min-width: 20px;
                                    }
                                </style>

<div class="mb-4">
    <label for="images" class="block text-gray-700 font-bold mb-2">Pasirinkite pridėti naujų nuotraukų:</label>
    <input type="file" name="file[]" id="images" multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
</div>
<div class="preview" id="preview">
    @foreach ($gallery->images as $image)
        <div class="image-container" data-id="{{ $image->id }}">
            <img src="{{ asset('uploads/gallery/' . $image->file_path) }}" alt="{{ $image->file_path }}">
            <button type="button" onclick="removeExistingImage({{ $image->id }})">&times;</button>
            <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
        </div>
    @endforeach
</div>

<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const files = event.target.files;
        const preview = document.getElementById('preview');

        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('image-container');

                const img = document.createElement('img');
                img.src = e.target.result;

                const button = document.createElement('button');
                button.innerHTML = '&times;';
                button.onclick = function() {
                    removeNewImage(index);
                };

                imageContainer.appendChild(img);
                imageContainer.appendChild(button);
                preview.appendChild(imageContainer);
            }
            reader.readAsDataURL(file);
        });
    });

    function removeExistingImage(id, e) {
        //e.preventDefault();
        const preview = document.getElementById('preview');
        const container = document.querySelector(`div[data-id="${id}"]`);
        preview.removeChild(container);

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'removed_images[]';
        input.value = id;
        document.getElementById('upload-form').appendChild(input);
    }

    function removeNewImage(index) {
        const input = document.getElementById('images');
        const dt = new DataTransfer();
        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]);
            }
        }

        input.files = dt.files;
        const preview = document.getElementById('preview');
        preview.removeChild(preview.childNodes[index]);
    }
</script>


                            </div>
                        </div>

                        <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Atnaujinti galeriją
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
