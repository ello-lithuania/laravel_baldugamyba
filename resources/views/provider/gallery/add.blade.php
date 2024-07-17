<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sukurti naują galeriją') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form enctype="multipart/form-data" method="POST" action="{{ route('gallery.store') }}">
                    @csrf
                    <div class="py-4 px-6">
                        <h2 class="font-bold text-[1.3rem]">Sukurti darbų pavyzdžių ar atliktų darbų galeriją</h2>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">
                            <div>
                                <div class="flex flex-col justify-between h-full mb-8">
                                    <div class="flex flex-col">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pavadinimas</label>
                                        <input name="title" value="{{ old('title') }}" id="pavadinimas" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite pavadinimą" />
                                        @if ($errors->has('title'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Aprašymas
                                        </label>
                                        <textarea name="description" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" rows="7" cols="7">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>

                                <div class="max-w-2xl mx-auto bg-white p-6 rounded-md shadow-md">
                                    <h2 class="text-2xl font-semibold mb-4">Pridėkite nuotraukų</h2>

                                    <!-- File input button -->
                                    <label class="block mb-4">
                                        <span class="sr-only">Pasirinkti paveiksliukus</span>
                                        <input type="file" name="file[]" multiple id="fileInput" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100"
                                            multiple accept="image/*">
                                    </label>
                                    @if ($errors->has('file'))
                                        <span class="text-red-500 text-sm">{{ $errors->first('file') }}</span>
                                    @endif
                                    <!-- Preview Container -->
                                    <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                                </div>

                                <script>
                                    const fileInput = document.getElementById('fileInput');
                                    const previewContainer = document.getElementById('previewContainer');

                                    fileInput.addEventListener('change', (event) => {
                                        const files = event.target.files;
                                        previewContainer.innerHTML = ''; // Clear previous previews

                                        Array.from(files).forEach((file, index) => {
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                const imageUrl = e.target.result;

                                                // Create preview element
                                                const previewElement = document.createElement('div');
                                                previewElement.classList.add('relative', 'bg-slate-700', 'border', 'border-gray-300', 'rounded-md', 'p-2');

                                                // Create image element
                                                const img = document.createElement('img');
                                                img.src = imageUrl;
                                                img.classList.add('w-full', 'h-auto', 'rounded-md');

                                                // Create remove button
                                                const removeButton = document.createElement('button');
                                                removeButton.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-6', 'h-6', 'flex', 'items-center', 'justify-center', 'focus:outline-none');
                                                removeButton.innerHTML = '&times;';
                                                removeButton.onclick = () => {
                                                    fileInput.value = ''; // Reset the file input
                                                    previewContainer.removeChild(previewElement); // Remove the preview element
                                                };

                                                // Append image and remove button to preview element
                                                previewElement.appendChild(img);
                                                previewElement.appendChild(removeButton);

                                                // Append preview element to preview container
                                                previewContainer.appendChild(previewElement);
                                            };
                                            reader.readAsDataURL(file);
                                        });
                                    });
                                </script>

                            </div>
                        </div>

                        <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Sukurti galeriją
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
