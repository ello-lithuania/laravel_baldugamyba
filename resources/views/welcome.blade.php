@extends('layouts.guest')

@section('title', 'Pagrindinis')

@section('content')
        <header>
            <!-- Hero section with background image, heading, subheading and button -->
            <div
                class="relative min-h-[400px] lg:min-h-[350px] overflow-hidden bg-[url('{{ asset('assets/images/Furniture-making.webp') }}')] bg-cover bg-[50%] bg-no-repeat">

                <div
                class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-black/60 bg-fixed">
                <div class="flex h-full items-center justify-center">
                    <div class="px-6 text-center text-white md:px-12">
                    <h1 class="mb-6 text-5xl font-bold">Raskite visus baldų gamintojus Lietuvoje!</h1>
                    <h3 class="mb-8 text-3xl font-bold">Peržiūrėkite visus baldų gamintojus</h3>
                    </div>
                </div>
                </div>
            </div>
            <div class="relative mb-[40px]">
                <div class="m-auto bg-white shadow w-[90vw] lg:w-[50vw] rounded p-6 mt-[-40px] z-10 relative">
                    <div class="flex justify-center items-center absolute w-full m-auto top-[-30px]">
                        <button class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-900"> Ieškoti <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"></path></svg></button>

                        @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center bg-white ml-[10px] text-blue-600 rounded-lg border-[2px] border-blue-800 focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-900"> Užpildyti paraišką</a>
                        @endauth
                        @guest
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center bg-white ml-[10px] text-blue-600 rounded-lg border-[2px] border-blue-800 focus:ring-1 focus:ring-blue-300 dark:focus:ring-blue-900"> Užpildyti paraišką</a>
                        @endguest
                    </div>
                    <div class="mt-[30px]">
                        <div>
                            <form class="w-full mx-auto" method="GET" action="{{ route('provider.search')}}">
                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Ieškoti</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input type="search" name="paieska" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Įveskite pavadinimą paieškai" required />
                                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ieškoti</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <div class="container py-[50px]">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                    @forelse ($providers as $provider)

                        <a href="{{ route('provider.watch', $provider->slug) }}" class=" bg-white @if($provider->upgrade && $provider->upgrade >= $now) relative !bg-blue-100 @endif border border-gray-200 rounded-lg shadow block">
                            @if($provider->upgrade && $provider->upgrade >= $now)
                            <svg class="w-8 h-8 text-yellow-300 absolute" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                            @endif

                            @if($provider->thumbnail)
                            <div class="min-h-[200px] rounded-t-lg w-full bg-[url('{{ asset('uploads/thumbnails/'. $provider->thumbnail) }}')] bg-cover bg-center">
                                </div>
                            @else
                                <div class="min-h-[200px] rounded-t-lg w-full bg-[url('{{ asset('assets/images/default.webp') }}')] bg-cover bg-center">
                                </div>
                            @endif

                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $provider->title }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $provider->description_excerpt  }}</p>
                                <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    PerŽiūrėti
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </div>
                            </div>
                        </a>

                    @empty
                        <li>Nerasta baldų gamintojų profilių.</li>
                    @endforelse

            </div>

            <div class="mt-[10px]">
                {{ $providers->links() }}
            </div>

        </div>

        <div class="container py-[50px]">
            <h3 class="mb-8 text-center text-3xl font-bold">Pasirinkite pagal kategoriją</h3>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 text-center">
                @forelse ( $categories as $category )
                    <a href="{{ route('category.show', $category)}}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        {{$category->name}}
                    </a>
                @empty
                    Nerasta kategorijų.
                @endforelse
            </div>
        </div>

        <section class="bg-white relative dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Užsiregistruokite arba prisijunkite kaip baldų gamintojas arba užsakovas</h1>
                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Kelių mygtuku paspaudimu suraskite baldų gamintojus arba klientus</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="{{ route('register') }}" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Registruotis
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Prisijungti
                    </a>
                </div>
            </div>
            <div class="bg-gradient-to-b from-blue-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 z-0"></div>
        </section>
@endsection
