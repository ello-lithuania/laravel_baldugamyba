@extends('layouts.guest')

@section('title', 'Iškelti skelbimą')

@section('content')

    <div class="bg-gray-100 py-8 container">

        <h2 class="text-[1.3rem] font-bold mb-4">Iškelkite profilį į sąrašo pradžią, sulaukite daugiau užklausų</h2>

        <div class="w-full lg:max-w-lg bg-white border border-gray-200 rounded-lg shadow">
            @if(auth()->user()->provider_profile->thumbnail)
                <img src="{{ asset('uploads/thumbnails/'. auth()->user()->provider_profile->thumbnail) }}" class="p-8 rounded-t-lg"/>
            @else
                <img src="{{ asset('assets/images/default.webp') }}" class="p-8 rounded-t-lg"/>
            @endif
            <div class="px-5 pb-5">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ auth()->user()->provider_profile->title }}</h5>
                <div class="flex items-center justify-between gap-4 mt-4">
                    <a href="{{ route('provider.upgrade2', 1) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iškelti dienai<br/>(100 kreditų)</a>
                    <a href="{{ route('provider.upgrade2', 3) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iškelti 3 dienoms<br/>(260 kreditų)</a>
                    <a href="{{ route('provider.upgrade2', 7) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iškelti savaitei<br/>(600 kreditų)</a>
                    <a href="{{ route('provider.upgrade2', 30) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Iškelti mėnesiui<br/>(2000 kreditų)</a>
                </div>
            </div>
        </div>


    </div>

@endsection
