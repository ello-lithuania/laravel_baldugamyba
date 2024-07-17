@extends('layouts.guest')

@section('title',  $category->name )

@section('content')

<div class="bg-gray-100 container pt-4">
    <h1 class="font-bold text-[1.3rem]">Kategorija: <span class="lowercase">{{ $category->name }}</span></h1>
</div>


<div class="bg-gray-100 py-8 container">
    @forelse($category->providers as $provider)
        <div class="bg-white @if($provider->upgrade && $provider->upgrade >= $now) relative !bg-blue-100 @endif shadow overflow-hidden sm:rounded-lg mb-4">

            @if($provider->upgrade && $provider->upgrade >= $now)
            <svg class="w-8 h-8 text-yellow-300 absolute" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
            </svg>
            @endif
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
        Nerasta jokių kategorijos siūlytojų
    @endforelse
</div>

@endsection
