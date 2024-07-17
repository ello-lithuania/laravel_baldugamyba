<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Redaguoti įmonės profilį') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form enctype="multipart/form-data" method="POST" action="{{ route('provider.update', auth()->user()->provider_profile) }}">
                    @csrf
                    @method('PUT')
                    <!-- Section: Design Block -->
                  <div class="py-4 px-6">
                      <h2 class="font-bold text-[1.3rem]">Atnaujinkite savo kontaktinius duomenis, bei paslaugas</h2>
                      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">
                          <div class="col-span-1">

                              <div class="flex flex-col justify-between h-full">
                                  <div class="flex flex-col">
                                      <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pavadinimas</label>
                                      <input name="title" value="{{ old('title', auth()->user()->provider_profile->title) }}" id="pavadinimas" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite pavadinimą" />
                                      @if ($errors->has('title'))
                                        <span class="text-red-500 text-sm">{{ $errors->first('title') }}</span>
                                      @endif
                                  </div>
                                  <div class="flex flex-col">
                                      <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Veiklos aprašymas, detalės, svarbi informacija klientams</label>
                                      <textarea name="description" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" rows="7" cols="7">{{ old('description', auth()->user()->provider_profile->description) }}</textarea>
                                      @if ($errors->has('description'))
                                        <span class="text-red-500 text-sm">{{ $errors->first('description') }}</span>
                                      @endif
                                  </div>
                              </div>

                          </div>
                          <div class="col-span-1">
                            @php
                                $img_url = asset('assets/images/default.webp');
                                if(auth()->user()->provider_profile->thumbnail) {
                                    $img_url = asset('uploads/thumbnails/'. auth()->user()->provider_profile->thumbnail);
                                }
                            @endphp
                              <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pagrindinė nuotrauka</label>
                              <div class="flex items-center justify-center w-full">
                                  <label id="imagePreview" for="dropzone-file" class="bg-[url('{{$img_url}}')] bg-cover bg-no-repeat bg-center flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                      <div class="bg-black/60 w-full h-full flex flex-col items-center justify-center pt-5 pb-6">
                                          <svg class="w-8 h-8 mb-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                          </svg>
                                          <p class="mb-2 text-sm text-white"><span class="font-semibold">Paspauskite mygtuką</span> arba užvilkite pelyte nuotrauką</p>
                                          <p class="text-xs text-white">SVG, PNG, JPG, JPEG arba GIF formatu</p>
                                      </div>
                                      <input value="{{ old('thumbnail') }}" name="thumbnail" id="dropzone-file" type="file" class="hidden" />
                                  </label>
                              </div>
                              @if ($errors->has('thumbnail'))
                                <span class="text-red-500 text-sm">{{ $errors->first('thumbnail') }}</span>
                              @endif
                          </div>

                        <script>
                            // Get reference to the file input and image preview element
                            const fileInput = document.getElementById('dropzone-file');
                            const imagePreview = document.getElementById('imagePreview');

                            // Add change event listener to file input
                            fileInput.addEventListener('change', function() {
                                // Check if a file is selected
                                if (fileInput.files && fileInput.files[0]) {
                                    const reader = new FileReader();

                                    reader.onload = function(e) {
                                        // Set the background image of the image preview div
                                        imagePreview.style.backgroundImage = `url(${e.target.result})`;
                                    };

                                    // Read the image file as a data URL
                                    reader.readAsDataURL(fileInput.files[0]);
                                }
                            });
                        </script>

                      </div>

                      <div class="mt-8">
                        <h2 class="font-bold text-[1.3rem]">Pasirinkite kategorijas</h2>

                        <div class=" bg-white p-6 rounded-md shadow-md">
                            <label for="categories" class="text-sm font-medium text-gray-700 hidden">Categories</label>
                            <div class="mt-2 grid grid-cols-2 gap-4 sm:grid-cols-2" id="checkboxContainer">

                                <div class="flex items-center">
                                    <input type="checkbox" id="toggleAll" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="category1" class="ml-2 block text-sm text-gray-900">Pažymėti/atžymėti visus</label>
                                </div>

                                @php
                                $cat_arr = [];
                                if(auth()->user()->provider_profile->categories) {
                                    foreach (auth()->user()->provider_profile->categories as $x) {
                                        array_push($cat_arr, $x->id);
                                    }
                                }
                                @endphp

                                @foreach($categories as $category)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="category{{$category->id}}" name="categories[]" value="{{$category->id}}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                        @if((old('categories') && in_array($category->id, old('categories')) || in_array($category->id, $cat_arr) ))
                                            checked
                                        @endif
                                        >
                                        <label for="category{{$category->id}}" class="ml-2 block text-sm text-gray-900">{{$category->name}}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                            @if ($errors->has('categories'))
                                <span class="text-red-500 text-sm">{{ $errors->first('categories') }}</span>
                            @endif

                            <script>
                                const toggleAllCheckbox = document.getElementById('toggleAll');
                                const checkboxes = document.querySelectorAll('#checkboxContainer input[type="checkbox"]');

                                toggleAllCheckbox.addEventListener('change', function() {
                                    checkboxes.forEach(checkbox => {
                                        checkbox.checked = toggleAllCheckbox.checked;
                                    });
                                });
                            </script>

                      </div>

                      <div class="mt-8">
                          <h2 class="font-bold text-[1.3rem]">Kontaktiniai duomenys</h2>
                          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">

                              <div class="col-span-1">

                                  <div class="flex flex-col">
                                      <div class="flex flex-col">
                                          <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Įmonės elektroninis paštas</label>
                                          <input name="email" value="{{ old('email', auth()->user()->provider_profile->email) }}" id="pavadinimas" type="email" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite elektroninį paštą" />
                                          @if ($errors->has('email'))
                                            <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                                          @endif
                                      </div>
                                  </div>
                              </div>

                              <div class="col-span-1">

                                  <div class="flex flex-col">
                                      <div class="flex flex-col">
                                          <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Telefono numeris</label>
                                          <input name="phone" value="{{ old('phone', auth()->user()->provider_profile->phone) }}" id="pavadinimas" type="phone" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite telefono numerį" />
                                          @if ($errors->has('phone'))
                                            <span class="text-red-500 text-sm">{{ $errors->first('phone') }}</span>
                                          @endif
                                      </div>
                                  </div>
                              </div>

                          </div>

                          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">
                              <div class="col-span-1">
                                <div class="">
                                    <div class="">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Miestas</label>
                                        <select class="text-gray-600 mt-2 block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 items-center pl-3 text-sm border-gray-300 rounded border shadow" name="city">
                                            <optgroup>
                                            <option value="">Pasirinkite miestą ar savivaldybę</option>
                                            </optgroup>
                                            <optgroup style="font-style: normal;" label="&nbsp;Didieji miestai">
                                            <option value="Vilnius" @selected(old('city', auth()->user()->provider_profile->city) == 'Vilnius')>Vilnius </option>
                                            <option value="Kaunas" @selected(old('city', auth()->user()->provider_profile->city) == 'Kaunas')>Kaunas </option>
                                            <option value="Klaipėda" @selected(old('city', auth()->user()->provider_profile->city) == 'Klaipėda')>Klaipėda </option>
                                            <option value="Šiauliai" @selected(old('city', auth()->user()->provider_profile->city) == 'Šiauliai')>Šiauliai </option>
                                            <option value="Panevėžys" @selected(old('city', auth()->user()->provider_profile->city) == 'Panevėžys')>Panevėžys </option>
                                            <option value="Alytus" @selected(old('city', auth()->user()->provider_profile->city) == 'Alytus')>Alytus </option>
                                            <option value="Palanga" @selected(old('city', auth()->user()->provider_profile->city) == 'Palanga')>Palanga </option>
                                            </optgroup>
                                            <optgroup style="font-style: normal" label="&nbsp;Savivaldybės">
                                            <option value="Akmenės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Akmenės r. sav.')>Akmenės r. sav. </option>
                                            <option value="Alytaus r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Alytaus r. sav.')>Alytaus r. sav. </option>
                                            <option value="Anykščių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Anykščių r. sav.')>Anykščių r. sav. </option>
                                            <option value="Birštono sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Birštono sav.')>Birštono sav. </option>
                                            <option value="Biržų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Biržų r. sav.')>Biržų r. sav. </option>
                                            <option value="Druskininkų sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Druskininkų sav.')>Druskininkų sav. </option>
                                            <option value="Elektrėnų sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Elektrėnų sav.')>Elektrėnų sav. </option>
                                            <option value="Ignalinos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Ignalinos r. sav.')>Ignalinos r. sav. </option>
                                            <option value="Jonavos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Jonavos r. sav.')>Jonavos r. sav. </option>
                                            <option value="Joniškio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Joniškio r. sav.')>Joniškio r. sav. </option>
                                            <option value="Jurbarko r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Jurbarko r. sav.')>Jurbarko r. sav. </option>
                                            <option value="Kaišiadorių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kaišiadorių r. sav.')>Kaišiadorių r. sav. </option>
                                            <option value="Kalvarijos sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kalvarijos sav.')>Kalvarijos sav. </option>
                                            <option value="Kauno r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kauno r. sav.')>Kauno r. sav. </option>
                                            <option value="Kazlų Rūdos sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kazlų Rūdos sav.')>Kazlų Rūdos sav. </option>
                                            <option value="Kelmės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kelmės r. sav.')>Kelmės r. sav. </option>
                                            <option value="Klaipėdos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Klaipėdos r. sav.')>Klaipėdos r. sav. </option>
                                            <option value="Kretingos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kretingos r. sav.')>Kretingos r. sav. </option>
                                            <option value="Kupiškio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kupiškio r. sav.')>Kupiškio r. sav. </option>
                                            <option value="Kėdainių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Kėdainių r. sav.')>Kėdainių r. sav. </option>
                                            <option value="Lazdijų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Lazdijų r. sav.')>Lazdijų r. sav. </option>
                                            <option value="Marijampolės sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Marijampolės sav.')>Marijampolės sav. </option>
                                            <option value="Mažeikių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Mažeikių r. sav.')>Mažeikių r. sav. </option>
                                            <option value="Molėtų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Molėtų r. sav.')>Molėtų r. sav. </option>
                                            <option value="Neringos sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Neringos sav.')>Neringos sav. </option>
                                            <option value="Pagėgių sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Pagėgių sav.')>Pagėgių sav. </option>
                                            <option value="Pakruojo r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Pakruojo r. sav.')>Pakruojo r. sav. </option>
                                            <option value="Panevėžio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Panevėžio r. sav.')>Panevėžio r. sav. </option>
                                            <option value="Pasvalio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Pasvalio r. sav.')>Pasvalio r. sav. </option>
                                            <option value="Plungės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Plungės r. sav.')>Plungės r. sav. </option>
                                            <option value="Prienų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Prienų r. sav.')>Prienų r. sav. </option>
                                            <option value="Radviliškio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Radviliškio r. sav.')>Radviliškio r. sav. </option>
                                            <option value="Raseinių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Raseinių r. sav.')>Raseinių r. sav. </option>
                                            <option value="Rietavo sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Rietavo sav.')>Rietavo sav. </option>
                                            <option value="Rokiškio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Rokiškio r. sav.')>Rokiškio r. sav. </option>
                                            <option value="Skuodo r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Skuodo r. sav.')>Skuodo r. sav. </option>
                                            <option value="Tauragės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Tauragės r. sav.')>Tauragės r. sav. </option>
                                            <option value="Telšių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Telšių r. sav.')>Telšių r. sav. </option>
                                            <option value="Trakų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Trakų r. sav.')>Trakų r. sav. </option>
                                            <option value="Ukmergės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Ukmergės r. sav.')>Ukmergės r. sav. </option>
                                            <option value="Utenos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Utenos r. sav.')>Utenos r. sav. </option>
                                            <option value="Varėnos r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Varėnos r. sav.')>Varėnos r. sav. </option>
                                            <option value="Vilkaviškio r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Vilkaviškio r. sav.')>Vilkaviškio r. sav. </option>
                                            <option value="Vilniaus r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Vilniaus r. sav.')>Vilniaus r. sav. </option>
                                            <option value="Visagino sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Visagino sav.')>Visagino sav. </option>
                                            <option value="Zarasų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Zarasų r. sav.')>Zarasų r. sav. </option>
                                            <option value="Šakių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Šakių r. sav.')>Šakių r. sav. </option>
                                            <option value="Šalčininkų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Šalčininkų r. sav.')>Šalčininkų r. sav. </option>
                                            <option value="Šiaulių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Šiaulių r. sav.')>Šiaulių r. sav. </option>
                                            <option value="Šilalės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Šilalės r. sav.')>Šilalės r. sav. </option>
                                            <option value="Šilutės r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Šilutės r. sav.')>Šilutės r. sav. </option>
                                            <option value="Širvintų r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Širvintų r. sav.')>Širvintų r. sav. </option>
                                            <option value="Švenčionių r. sav." @selected(old('city', auth()->user()->provider_profile->city) == 'Švenčionių r. sav.')>Švenčionių r. sav. </option>
                                            </optgroup>
                                            </select>

                                        @if ($errors->has('city'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                              </div>
                              <div class="col-span-1">
                                  <div class="max-w-sm">
                                      <div>
                                          <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Tinklapio adresas(pasirinktinai)</label>
                                          <div class="flex rounded-lg shadow-sm mt-2">
                                          <div class="px-4 inline-flex items-center min-w-fit rounded-s-md border border-e-0 border-gray-200 bg-gray-50">
                                              <span class="text-sm text-gray-500">https://</span>
                                          </div>
                                          <input name="website" value="{{ old('website', auth()->user()->provider_profile->website) }}" type="text" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="www.pavyzdys.lt">
                                          </div>
                                      </div>
                                  </div>
                                  @if ($errors->has('website'))
                                    <span class="text-red-500 text-sm">{{ $errors->first('website') }}</span>
                                  @endif
                              </div>
                          </div>

                      </div>

                      <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Sukurti įmonės profilį
                      </button>
                  </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
