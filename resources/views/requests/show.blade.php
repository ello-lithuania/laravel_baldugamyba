<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peržiūrėti užkausas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                @forelse ( $client as $clientt )
                    <div class=" py-4 px-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <div class="col-span-1 lg:col-span-2">
                                <h1 class="font-bold text-[1.3rem]">{{$clientt->title}}</h1>
                                <p>{{$clientt->description}}</p>
                            </div>
                            <div class="col-span-1 lg:col-span-1">
                                <p><span class="font-bold">Kaina nuo - iki: </span>{{$clientt->price}}</p>
                                <p><span class="font-bold">Terminas: </span>{{$clientt->deadline}}</p>
                                <p><span class="font-bold">Miestas: </span>{{$clientt->city}}</p>
                                <p><span class="font-bold">Telefono numeris: </span><a href="tel:{{$clientt->phone}}">{{$clientt->phone}}</a></p>
                                <p><span class="font-bold">Elektroninis paštas: </span><a href="tel:{{$clientt->email}}">{{$clientt->user->email}}</a></p>
                            </div>
                        </div>
                        <hr class="my-4"/>
                    </div>
                @empty
                    Nerasta aktyvių klientų užklausų
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
