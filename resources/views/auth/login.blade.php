@extends('layouts.guest')

@section('title', 'Prisijungti')

@section('content')

<div class="container py-[20px]">

    <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="lg:mt-6 text-center text-3xl font-extrabold text-gray-900">Prisijunkite dabar</h2>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('login_now') }}">
                @csrf
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email" class="">Elektroninis paštas</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Įveskite elektroninį paštą">
                        @if ($errors->has('email'))
                            <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="!mt-[20px]">
                        <label for="password" class="">Slaptažodis</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                               placeholder="Įveskite slaptažodį">
                        @if ($errors->has('password'))
                            <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Likti prisijungus
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Prisijungti
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
