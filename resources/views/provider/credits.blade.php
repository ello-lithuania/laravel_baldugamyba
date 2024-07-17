<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pridėti kreditų') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('provider.creditAdd2', auth()->user()->provider_profile->id) }}">
                    @csrf
                    <!-- Section: Design Block -->
                  <div class="py-4 px-6">
                      <h2 class="font-bold text-[1.3rem]">Pasirinkite kiek kreditų norite pridėti</h2>

                      <select name="credits" id="years" size="7" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="100">100 kreditų - 1eu</option>
                        <option value="300">300 kreditų - 2,6eu</option>
                        <option value="500">500 kreditų - 4eu</option>
                        <option value="700">700 kreditų - 6eu</option>
                        <option value="1000">1000 kreditų - 7eu</option>
                        <option value="2000">2000 kreditų - 14eu</option>
                        <option value="5000">5000 kreditų - 30eu</option>
                      </select>

                      <x-input-error :messages="$errors->get('credits')" class="mt-2" />

                      <button type="submit" class="text-white mt-6 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Pirkti kreditus
                      </button>
                  </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
