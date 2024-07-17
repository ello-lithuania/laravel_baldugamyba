<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Valdymo pultas') }}
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

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif


                <div class="p-6 text-gray-900">
                    @if(auth()->user()->role->value =='provider')
                    <div>
                        <!-- Section: Design Block -->
                        @if(auth()->user()->provider_profile == null)
                        <div>
                            <section class="mb-12 relative">
                                <div class="sm:rounded-lg alert alert-dismissible fade show bg-blue-700 z-[1030] w-full items-center justify-between py-4 px-6 text-center text-white md:flex md:text-left">
                                <div class="mb-4 flex flex-wrap items-center justify-center md:mb-0 md:justify-start">
                                    <strong class="mr-1">Sukurkite paslaugų teikėjo profilį</strong> Užpildykite visus profilio duomenis dabar
                                </div>
                                <div class="flex items-center justify-center">
                                    <a class="mr-4 inline-block rounded bg-neutral-50 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-neutral-800 shadow-[0_4px_9px_-4px_rgba(251,251,251,0.05)] transition duration-150 ease-in-out hover:bg-neutral-100 hover:shadow-[0_8px_9px_-4px_rgba(203,203,203,0.05),0_4px_18px_0_rgba(203,203,203,0.05)] focus:bg-neutral-100 focus:shadow-[0_8px_9px_-4px_rgba(203,203,203,0.05),0_4px_18px_0_rgba(203,203,203,0.05)] focus:outline-none focus:ring-0 active:bg-neutral-200 active:shadow-[0_8px_9px_-4px_rgba(203,203,203,0.05),0_4px_18px_0_rgba(203,203,203,0.05)] dark:shadow-[0_4px_9px_-4px_rgba(251,251,251,0.05)] dark:hover:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)] dark:focus:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)] dark:active:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)]"
                                    href="{{route('provider.register')}}" data-te-ripple-init data-te-ripple-color="light">Pildyti</a>
                                </div>
                                </div>
                            </section>
                            <!-- Section: Design Block -->
                            <div class="py-4 px-6">
                                <p>Dar nesate užpildę įmonės profilio duomenų. Jie skirti gauti užklausas iš klientų kuriems reikia baldų gamintojų paslaugų.</p>
                            </div>
                        </div>

                        @else

                        <div class="py-4 px-6">


                            <h2 class="text-[1.3rem] font-bold mb-4">Esate sėkmingai užpildę paslaugų teikėjo profilį.</h2>

                            <div class="mb-4 block max-w-sm p-6 border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                    </svg>
                                    <h5 class="ml-4 text-2xl font-bold tracking-tight text-gray-900">{{ auth()->user()->credits}}</h5>
                                </div>

                                <p class="font-normal text-gray-700 dark:text-gray-400">Esami kreditai, skirti skelbimų iškėlimui.</p>
                                <a href="{{ route('provider.creditAdd') }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                    Pridėti kreditų
                                </a>
                            </div>

                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-12 lg:col-span-4">
                                        @if(auth()->user()->provider_profile->thumbnail)
                                            <div class="min-h-[200px] w-full bg-[url('{{ asset('uploads/thumbnails/'. auth()->user()->provider_profile->thumbnail) }}')] bg-cover bg-center">
                                            </div>
                                        @else
                                            <div class="min-h-[200px] w-full bg-[url('{{ asset('assets/images/default.webp') }}')] bg-cover bg-center">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-span-12 lg:col-span-8">
                                        <div class="px-4 py-5 sm:px-6">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                {{ auth()->user()->provider_profile->title }}
                                            </h3>
                                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                                {{ auth()->user()->provider_profile->description }}
                                            </p>
                                            @if(auth()->user()->provider_profile->upgrade && auth()->user()->provider_profile->upgrade >= $now )
                                            <p class="mt-1 max-w-2xl text-sm italic">
                                                Skelbimas iškeltas iki: {{ auth()->user()->provider_profile->upgrade }}
                                            </p>
                                            @endif

                                            <a href="{{ route('provider.watch', auth()->user()->provider_profile->slug) }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Peržiūrėti
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('provider.upgrade', auth()->user()->provider_profile->id) }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                                                Iškelti skelbimą į viršų
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200">
                                    <dl>
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Elektroninis paštas
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <a target="_blank" href="mailto:{{ auth()->user()->provider_profile->email }}">{{ auth()->user()->provider_profile->email }}</a>
                                            </dd>
                                        </div>
                                        @if(auth()->user()->provider_profile->website)
                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Internetinis puslapis
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <a target="_blank" href="https://{{ auth()->user()->provider_profile->website }}">{{ auth()->user()->provider_profile->website }}</a>
                                            </dd>
                                        </div>
                                        @endif
                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                            <dt class="text-sm font-medium text-gray-500">
                                                Telefono numeris
                                            </dt>
                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                <a target="_blank" href="tel:{{ auth()->user()->provider_profile->phone }}">{{ auth()->user()->provider_profile->phone }}</a>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                            </div>

                            <a href="{{route('provider.edit')}}" class="text-white block w-fit my-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Redaguoti</a>

                            <div class="mt-[40px]">
                                <h2 class="text-[1.3rem] font-bold mb-4">Pridėkite savo darbų, pavyzdžių galerija</h2>

                                <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                                    <a href="{{ route('gallery.add')}}" class=" bg-white border flex flex-col justify-end border-gray-200 h-64 rounded-lg shadow">
                                        <div class="p-5">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Sukurti naują galeriją</h5>
                                        </div>
                                    </a>
                                    @foreach($galleries as $gallery)
                                        @php
                                            $image = null;
                                            if($gallery->images) {
                                                $image = asset('uploads/gallery/'.$gallery->images[0]->file_path);
                                            }
                                        @endphp
                                        <a href="{{ route('gallery.edit', $gallery)}}" class=" bg-white border border-gray-200 min-h-64 rounded-lg shadow flex flex-col justify-end">
                                            @if($image)
                                                <img class="max-h-[130px] !w-auto" src="{{$image}}"/>
                                            @endif
                                            <div class="p-5 bg-white">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$gallery->title}}</h5>
                                                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Redaguoti
                                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>


                            <section class="text-gray-600 body-font bg-white mt-16">
                                <div class="container mx-auto flex md:px-24 md:py-10 md:flex-row flex-col items-center">
                                    <div
                                        class="lg:flex-grow mt-5 md:mt-0   md:w-1.5/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                                        <h2
                                            class="text-2xl font-extrabold leading-9 tracking-tight mb-3 text-gray-900 sm:text-4xl sm:leading-10 md:text-5xl md:leading-normal">
                                            Sužinokite kokios klientų užklausos
                                        </h2>
                                        <p class="mb-8 md:pl-0  pl-2 pr-2 leading-relaxed dark:text-gray-300 hidden">
                                            Paspauskite
                                        </p>
                                        <div class="flex justify-center">
                                            <a href="{{ route('requests.show') }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                Peržiūrėti
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="lg:max-w-lg lg:w-full mb-5 md:mb-0 md:w-1/2 w-3/6">
                                        <img class="object-cover object-center rounded" alt="hero" src="{{ asset('assets/images/png-transparent-shandong-service-client-information-mobile-phone-red-cartoon-furniture-sofa-cartoon-character-angle-furniture-removebg-preview.png')}}">
                                    </div>
                                </div>
                            </section>


                        </div>

                        @endif

                    </div>

                    @else
                        <div class="py-4 px-6">
                            <h2 class="text-[1.3rem] font-bold">Norint gauti užklausas tiesiogiai iš baldų gamintojų, pirma turite sukurti paslaugų skelbimą</h2>
                            <p>Užpildykite laukelius norint sukurti skelbimą</p>

                            <a href="{{ route('requests.create') }}" class="mt-8 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Sukurti naują užklausą
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>

                            @if(count(auth()->user()->clientRequests) > 0)

                                <script>
                                    function confirmDelete(event) {
                                        event.preventDefault(); // Prevent the default button action
                                        const userConfirmed = confirm("Ar tikrai norite ištrinti?");
                                        if (userConfirmed) {
                                            // If user clicked "OK", submit the form
                                            event.target.closest('form').submit();
                                        }
                                    }
                                </script>

                                <div>
                                    <h2 class="text-[1.3rem] font-bold mt-12">Jūsų esamos užklausos</h2>
                                    <p>Galite išjungti/redaguoti užklausas</p>
                                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                        @foreach ( auth()->user()->clientRequests as $client )
                                            <div class="bg-blue/10 flex flex-col my-4 p-6 shadow-lg">
                                                <div class="flex justify-between items-center mb-4">
                                                @if($client->status == 'active')
                                                    <p class="text-xs bg-blue-700 px-4 py-2 font-bold rounded-lg text-white w-fit uppercase flex">Aktyvus </p>
                                                @else
                                                    <p class="text-xs bg-red-700 px-4 py-2 font-bold rounded-lg text-white w-fit uppercase flex">Neaktyvus </p>
                                                @endif
                                                    <form action="{{ route('requests.destroy', $client) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="confirmDelete(event)" class="flex items-center"><img  class="h-[24px]" src="{{ asset('assets/images/icons-delete.svg') }}"/><br/><span>Ištrinti</span></button>
                                                    </form>
                                                </div>
                                                <p class="text-xl font-semibold pb-5">{{$client->title}}</p>
                                                <p class="pb-2">{{$client->description}}</p>
                                                <a href="{{ route('requests.edit', $client )}}"
                                                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                                                    Redaguoti
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
