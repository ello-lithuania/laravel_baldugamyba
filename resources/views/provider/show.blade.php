@extends('layouts.guest')

@section('title', $provider->title)

@section('content')

    <div class="bg-gray-100 py-8 container">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300  mb-4">
                        @if($provider->thumbnail)
                            <img class="w-full h-full" src="{{ asset('uploads/thumbnails/'. $provider->thumbnail) }}" alt="Product Image">
                        @else
                            <img class="w-full h-full" src="{{ asset('assets/images/default.webp') }}" alt="Product Image">
                        @endif
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $provider->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">
                        {{ $provider->description }}
                    </p>
                    <div class="flex mb-4 flex-wrap">
                        <div class="w-full">
                            <span class="font-bold text-gray-700">Miestas:</span>
                            <spap class="text-gray-600">{{ $provider->city }}</span>
                        </div>
                        <div class="w-full">
                            <span class="font-bold text-gray-700">Elektroninis paštas:</span>
                            <a target="_blank" href="mailto:{{ $provider->email }}" class="text-gray-600">{{ $provider->email }}</a>
                        </div>
                        @if($provider->website)
                        <div class="w-full">
                            <span class="font-bold text-gray-700">Internetinis puslapis:</span>
                            <a target="_blank" href="https://{{ $provider->website }}" class="text-gray-600">{{ $provider->website }}</a>
                        </div>
                        @endif
                        <div class="w-full">
                            <span class="font-bold text-gray-700">Telefono numeris:</span>
                            <a target="_blank" href="tel:{{ $provider->phone }}" class="text-gray-600">{{ $provider->phone }}</a>
                        </div>
                    </div>
                    @if($provider->categories)
                        <div>
                            <h3 class="font-bold text-gray-700">Kategorijos:</h3>
                        </div>
                        @foreach ( $provider->categories as $category )
                            <a href="{{ route('category.show', $category)}}">{{ $category->name }}</a>,
                        @endforeach
                    @endif

                    <div class="flex -mx-2 mb-4 mt-6">
                        <div class="w-1/2 px-2">
                            <a href="mailto:{{ $provider->email }}" class="w-full bg-gray-900 flex items-center justify-center text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800">Siųsti žinutę</a>
                        </div>
                        <div class="w-1/2 px-2 hidden">
                            <button class="w-full bg-gray-200  text-gray-800  py-2 px-4 rounded-full font-bold hover:bg-gray-300">Įsiminti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(count($galleries) > 0 )
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center my-8">Darbų/pavyzdžių galerija</h2>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                @foreach($galleries as $gallery)
                    @php
                        $image = null;
                        if($gallery->images) {
                            $image = asset('uploads/gallery/'.$gallery->images[0]->file_path);
                        }
                    @endphp
                    <a href="{{ route('gallery.watch', $gallery)}}" class=" bg-white border border-gray-200 min-h-64 rounded-lg shadow flex flex-col justify-end">
                        @if($image)
                            <img class="max-h-[130px] !w-auto" src="{{$image}}"/>
                        @endif
                        <div class="p-5 bg-white">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$gallery->title}}</h5>
                            <div class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                PerŽiūrėti
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
        @endif

    </div>


    <div class="container py-[50px]">

        <h3 class="mb-8 text-center text-3xl font-bold">Jus gali sudominti</h3>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

                @forelse ($providers as $provider)

                <a href="{{ route('provider.watch', $provider->slug) }}" class=" bg-white @if($provider->upgrade && $provider->upgrade >= $now) relative !bg-blue-100 @endif border border-gray-200 rounded-lg shadow block">
                    @if($provider->upgrade && $provider->upgrade >= $now)
                    <svg class="w-8 h-8 text-yellow-300 absolute" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                    @endif

                        @if($provider->thumbnail)
                            <img class="rounded-t-lg w-full" src="{{ asset('uploads/thumbnails/'. $provider->thumbnail) }}" alt="" />
                        @else
                            <img class="rounded-t-lg w-full" src="{{ asset('assets/images/default.webp') }}" alt="" />
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

@endsection
