<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sukurti užklausą') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form enctype="multipart/form-data" method="POST" action="{{ route('requests.store') }}">
                    @csrf
                    <!-- Section: Design Block -->

                    <div class="py-4 px-6">
                        <h2 class="font-bold text-[1.3rem]">Nurodykite savo kontaktinius duomenis, bei užklausą</h2>
                        <p>Sulaukite baldų gamintojų pasiūlymų greitu metu</p>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">
                            <div class="col-span-1">

                                <div class="flex flex-col justify-between h-full">
                                    <div class="flex flex-col mb-4">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pavadinimas</label>
                                        <input name="title" value="{{ old('title') }}" id="pavadinimas" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite pavadinimą" />
                                        @if ($errors->has('title'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Pageidavimai baldui, matmenys, bei furnitūra ar kita svarbi informacija</label>
                                        <textarea name="description" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" rows="7" cols="7">{{ old('description') }}</textarea>
                                        @if ($errors->has('description'))
                                          <span class="text-red-500 text-sm">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-span-1">

                                <div class="flex flex-col mb-4">
                                    <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Numatoma kaina nuo - iki</label>
                                    <input name="price" value="{{ old('price') }}" id="pavadinimas" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite numatomos kainos rėžius" />
                                    @if ($errors->has('price'))
                                      <span class="text-red-500 text-sm">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>

                                <div class="flex flex-col mb-4">
                                    <label for="pavadinimas" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Numatomas laikotarpis atlikti</label>
                                    <select name="deadline" class="text-gray-600 mt-2 block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 items-center pl-3 text-sm border-gray-300 rounded border shadow" name="city">
                                        <optgroup>
                                        <option value="">Pasirinkite pageidaujamą atlikimo terminą</option>
                                        </optgroup>
                                        <option value="iki mėnesio" @selected(old('deadline') == 'iki mėnesio')>iki mėnesio </option>
                                        <option value="mėnesis - du" @selected(old('deadline') == 'mėnesis - du')>mėnesis - du </option>
                                        <option value="du - trys mėnesiai" @selected(old('deadline') == 'du - trys mėnesiai')>du - trys mėnesiai </option>
                                        <option value="nesvarbu" @selected(old('deadline') == 'nesvarbu')>nesvarbu </option>
                                    </select>
                                    @if ($errors->has('deadline'))
                                      <span class="text-red-500 text-sm">{{ $errors->first('deadline') }}</span>
                                    @endif
                                </div>

                            </div>


                        </div>

                        <div class="mt-8">
                            <h2 class="font-bold text-[1.3rem]">Kontaktiniai duomenys</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-12 mt-4">

                                <div class="col-span-1">

                                    <div class="flex flex-col">
                                        <div class="flex flex-col">
                                            <label for="phone" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Telefono numeris</label>
                                            <input name="phone" value="{{ old('phone') }}" type="phone" autocomplete="off" class="text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 flex items-center pl-3 text-sm border-gray-300 rounded border shadow" placeholder="Įrašykite telefono numerį" />
                                            @if ($errors->has('phone'))
                                              <span class="text-red-500 text-sm">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div class="">
                                        <div class="">
                                            <label for="city" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mb-2">Miestas</label>
                                            <select class="text-gray-600 block focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 bg-white font-normal w-full min-w-64 h-10 items-center pl-3 text-sm border-gray-300 rounded border shadow" name="city">
                                                <optgroup>
                                                <option value="">Pasirinkite miestą ar savivaldybę</option>
                                                </optgroup>
                                                <optgroup style="font-style: normal;" label="&nbsp;Didieji miestai">
                                                <option value="Vilnius" @selected(old('city') == 'Vilnius')>Vilnius </option>
                                                <option value="Kaunas" @selected(old('city') == 'Kaunas')>Kaunas </option>
                                                <option value="Klaipėda" @selected(old('city') == 'Klaipėda')>Klaipėda </option>
                                                <option value="Šiauliai" @selected(old('city') == 'Šiauliai')>Šiauliai </option>
                                                <option value="Panevėžys" @selected(old('city') == 'Panevėžys')>Panevėžys </option>
                                                <option value="Alytus" @selected(old('city') == 'Alytus')>Alytus </option>
                                                <option value="Palanga" @selected(old('city') == 'Palanga')>Palanga </option>
                                                </optgroup>
                                                <optgroup style="font-style: normal" label="&nbsp;Savivaldybės">
                                                <option value="Akmenės r. sav." @selected(old('city') == 'Akmenės r. sav.')>Akmenės r. sav. </option>
                                                <option value="Alytaus r. sav." @selected(old('city') == 'Alytaus r. sav.')>Alytaus r. sav. </option>
                                                <option value="Anykščių r. sav." @selected(old('city') == 'Anykščių r. sav.')>Anykščių r. sav. </option>
                                                <option value="Birštono sav." @selected(old('city') == 'Birštono sav.')>Birštono sav. </option>
                                                <option value="Biržų r. sav." @selected(old('city') == 'Biržų r. sav.')>Biržų r. sav. </option>
                                                <option value="Druskininkų sav." @selected(old('city') == 'Druskininkų sav.')>Druskininkų sav. </option>
                                                <option value="Elektrėnų sav." @selected(old('city') == 'Elektrėnų sav.')>Elektrėnų sav. </option>
                                                <option value="Ignalinos r. sav." @selected(old('city') == 'Ignalinos r. sav.')>Ignalinos r. sav. </option>
                                                <option value="Jonavos r. sav." @selected(old('city') == 'Jonavos r. sav.')>Jonavos r. sav. </option>
                                                <option value="Joniškio r. sav." @selected(old('city') == 'Joniškio r. sav.')>Joniškio r. sav. </option>
                                                <option value="Jurbarko r. sav." @selected(old('city') == 'Jurbarko r. sav.')>Jurbarko r. sav. </option>
                                                <option value="Kaišiadorių r. sav." @selected(old('city') == 'Kaišiadorių r. sav.')>Kaišiadorių r. sav. </option>
                                                <option value="Kalvarijos sav." @selected(old('city') == 'Kalvarijos sav.')>Kalvarijos sav. </option>
                                                <option value="Kauno r. sav." @selected(old('city') == 'Kauno r. sav.')>Kauno r. sav. </option>
                                                <option value="Kazlų Rūdos sav." @selected(old('city') == 'Kazlų Rūdos sav.')>Kazlų Rūdos sav. </option>
                                                <option value="Kelmės r. sav." @selected(old('city') == 'Kelmės r. sav.')>Kelmės r. sav. </option>
                                                <option value="Klaipėdos r. sav." @selected(old('city') == 'Klaipėdos r. sav.')>Klaipėdos r. sav. </option>
                                                <option value="Kretingos r. sav." @selected(old('city') == 'Kretingos r. sav.')>Kretingos r. sav. </option>
                                                <option value="Kupiškio r. sav." @selected(old('city') == 'Kupiškio r. sav.')>Kupiškio r. sav. </option>
                                                <option value="Kėdainių r. sav." @selected(old('city') == 'Kėdainių r. sav.')>Kėdainių r. sav. </option>
                                                <option value="Lazdijų r. sav." @selected(old('city') == 'Lazdijų r. sav.')>Lazdijų r. sav. </option>
                                                <option value="Marijampolės sav." @selected(old('city') == 'Marijampolės sav.')>Marijampolės sav. </option>
                                                <option value="Mažeikių r. sav." @selected(old('city') == 'Mažeikių r. sav.')>Mažeikių r. sav. </option>
                                                <option value="Molėtų r. sav." @selected(old('city') == 'Molėtų r. sav.')>Molėtų r. sav. </option>
                                                <option value="Neringos sav." @selected(old('city') == 'Neringos sav.')>Neringos sav. </option>
                                                <option value="Pagėgių sav." @selected(old('city') == 'Pagėgių sav.')>Pagėgių sav. </option>
                                                <option value="Pakruojo r. sav." @selected(old('city') == 'Pakruojo r. sav.')>Pakruojo r. sav. </option>
                                                <option value="Panevėžio r. sav." @selected(old('city') == 'Panevėžio r. sav.')>Panevėžio r. sav. </option>
                                                <option value="Pasvalio r. sav." @selected(old('city') == 'Pasvalio r. sav.')>Pasvalio r. sav. </option>
                                                <option value="Plungės r. sav." @selected(old('city') == 'Plungės r. sav.')>Plungės r. sav. </option>
                                                <option value="Prienų r. sav." @selected(old('city') == 'Prienų r. sav.')>Prienų r. sav. </option>
                                                <option value="Radviliškio r. sav." @selected(old('city') == 'Radviliškio r. sav.')>Radviliškio r. sav. </option>
                                                <option value="Raseinių r. sav." @selected(old('city') == 'Raseinių r. sav.')>Raseinių r. sav. </option>
                                                <option value="Rietavo sav." @selected(old('city') == 'Rietavo sav.')>Rietavo sav. </option>
                                                <option value="Rokiškio r. sav." @selected(old('city') == 'Rokiškio r. sav.')>Rokiškio r. sav. </option>
                                                <option value="Skuodo r. sav." @selected(old('city') == 'Skuodo r. sav.')>Skuodo r. sav. </option>
                                                <option value="Tauragės r. sav." @selected(old('city') == 'Tauragės r. sav.')>Tauragės r. sav. </option>
                                                <option value="Telšių r. sav." @selected(old('city') == 'Telšių r. sav.')>Telšių r. sav. </option>
                                                <option value="Trakų r. sav." @selected(old('city') == 'Trakų r. sav.')>Trakų r. sav. </option>
                                                <option value="Ukmergės r. sav." @selected(old('city') == 'Ukmergės r. sav.')>Ukmergės r. sav. </option>
                                                <option value="Utenos r. sav." @selected(old('city') == 'Utenos r. sav.')>Utenos r. sav. </option>
                                                <option value="Varėnos r. sav." @selected(old('city') == 'Varėnos r. sav.')>Varėnos r. sav. </option>
                                                <option value="Vilkaviškio r. sav." @selected(old('city') == 'Vilkaviškio r. sav.')>Vilkaviškio r. sav. </option>
                                                <option value="Vilniaus r. sav." @selected(old('city') == 'Vilniaus r. sav.')>Vilniaus r. sav. </option>
                                                <option value="Visagino sav." @selected(old('city') == 'Visagino sav.')>Visagino sav. </option>
                                                <option value="Zarasų r. sav." @selected(old('city') == 'Zarasų r. sav.')>Zarasų r. sav. </option>
                                                <option value="Šakių r. sav." @selected(old('city') == 'Šakių r. sav.')>Šakių r. sav. </option>
                                                <option value="Šalčininkų r. sav." @selected(old('city') == 'Šalčininkų r. sav.')>Šalčininkų r. sav. </option>
                                                <option value="Šiaulių r. sav." @selected(old('city') == 'Šiaulių r. sav.')>Šiaulių r. sav. </option>
                                                <option value="Šilalės r. sav." @selected(old('city') == 'Šilalės r. sav.')>Šilalės r. sav. </option>
                                                <option value="Šilutės r. sav." @selected(old('city') == 'Šilutės r. sav.')>Šilutės r. sav. </option>
                                                <option value="Širvintų r. sav." @selected(old('city') == 'Širvintų r. sav.')>Širvintų r. sav. </option>
                                                <option value="Švenčionių r. sav." @selected(old('city') == 'Švenčionių r. sav.')>Švenčionių r. sav. </option>
                                                </optgroup>
                                                </select>

                                            @if ($errors->has('city'))
                                              <span class="text-red-500 text-sm">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                  </div>

                            </div>

                        </div>

                        <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Sukurti užklausą
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
