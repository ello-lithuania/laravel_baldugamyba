@extends('layouts.guest')

@section('title', 'Paieška')

@section('content')
    <div class="container bg-gray-100 pt-4">
        <h1 class="font-bold text-[1.3rem]">Pagal paieškos kriterijus rasta {{ $posts->count() }} rezultatų</h1>

        <div class="mt-4">
            <form class="w-full mx-auto" method="GET" action="{{ route('provider.search')}}">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Ieškoti</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="search" value="{{$searchTerm}}" name="paieska" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Įveskite pavadinimą paieškai" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ieškoti</button>
                </div>
            </form>
        </div>

    </div>

    <div class="bg-gray-100 py-8 container">
        @forelse($posts as $provider)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-4">
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-12 lg:col-span-4">
                                        @if($provider->thumbnail)
                                        <div class="min-h-[200px] w-full bg-[url('{{ asset('uploads/thumbnails/'. $provider->thumbnail) }}')] bg-cover bg-center">
                                            </div>
                                        @else
                                            <div class="min-h-[200px] w-full bg-[url('{{ asset('assets/images/default.webp') }}')] bg-cover bg-center">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-span-12 lg:col-span-8">
                                        <div class="px-4 py-5 sm:px-6">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                {{ $provider->title }}
                                            </h3>
                                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                                {{ $provider->description }}
                                            </p>
                                            <a href="{{ route('provider.watch', $provider->slug) }}" class="mt-6 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                PerŽiūrėti
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
            </div>
        @empty
            Nerasta jokių rezultatų
        @endforelse
    </div>

@endsection
