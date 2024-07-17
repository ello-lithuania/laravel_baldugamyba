@extends('layouts.guest')

@section('title', 'Registruotis')

@section('content')

<div class="container py-[10px]">

    <div class="font-[sans-serif] text-gray-800 bg-white max-w-4xl flex items-center mx-auto md:h-screen p-4">
        <div class="grid md:grid-cols-3 items-center shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-xl overflow-hidden">
          <div class="max-md:order-1 flex flex-col justify-center space-y-16 max-md:mt-16 min-h-full bg-gradient-to-r from-gray-900 to-gray-700 lg:px-8 px-4 py-4">
            <div>
              <h4 class="text-white text-lg font-semibold">Susikurkite baldų gamintojo arba užsakovo paskyrą</h4>
              <p class="text-[13px] text-white mt-2">Užsiregistravę galėsite gauti arba siųsti pasiūlymus.</p>
            </div>
            <div>
              <h4 class="text-white text-lg font-semibold">Paprasta ir lengva registracija </h4>
              <p class="text-[13px] text-white mt-2">Naudojame tik būtinus duomenis registracijai.</p>
            </div>
          </div>
          <form class="md:col-span-2 w-full py-6 px-6 sm:px-16" method="POST" action="{{ route('register2') }}">
            @csrf
            <div class="mb-6">
              <h3 class="text-2xl font-bold">Susikurkite naują paskyrą</h3>
            </div>
            <div class="mb-[20px]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="flex bg-gray-100 p-4 rounded-[10px]">
                        <div class="flex items-center h-5">
                            <input name="role" id="helper-checkbox" aria-describedby="helper-checkbox-text" type="radio" value="user" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                        </div>
                        <div class="ms-2 text-sm">
                            <label for="helper-checkbox" class="text-gray-900 dark:text-gray-900 text-[1.3em] font-bold">Baldų užsakovas</label>
                            <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-800">Gaukite kainos pasiūlymus Jūsų baldų projektms</p>
                        </div>
                    </div>
                    <div class="flex bg-gray-100 p-4 rounded-[10px]">
                        <div class="flex items-center h-5">
                            <input name="role" id="helper-checkbox2" aria-describedby="helper-checkbox-text" type="radio" value="provider" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="ms-2 text-sm">
                            <label for="helper-checkbox2" class="text-gray-900 dark:text-gray-900 text-[1.3em] font-bold">Baldų gamintojas</label>
                            <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-800">Siūlykite baldų gaminimo pasiūlymus klientams</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-5">
              <div>
                <label class="text-sm mb-2 block">Vardas</label>
                <div class="relative flex items-center">
                  <input name="name" type="text" required class="bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Įveskite vardą" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                    <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                    <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                  </svg>
                </div>
                @if ($errors->has('name'))
                    <span class="text-red-500 text-sm">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div>
                <label class="text-sm mb-2 block">Elektroninis paštas</label>
                <div class="relative flex items-center">
                  <input name="email" type="email" required class="bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Įveskite elektroninį paštą" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 682.667 682.667">
                    <defs>
                      <clipPath id="a" clipPathUnits="userSpaceOnUse">
                        <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                      </clipPath>
                    </defs>
                    <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                      <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                      <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                    </g>
                  </svg>
                </div>
                @if ($errors->has('email'))
                    <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                @endif
              </div>
              <div>
                <label class="text-sm mb-2 block">Slaptažodis</label>
                <div class="relative flex items-center">
                  <input name="password" type="password" required class="bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Įveskite slaptažodį" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg>
                </div>
                @if ($errors->has('password'))
                    <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                @endif
              </div>
              <div>
                <label class="text-sm mb-2 block">Pakartokite slaptažodį</label>
                <div class="relative flex items-center">
                  <input name="password_confirmation" type="password" required class="bg-white border border-gray-300 w-full text-sm px-4 py-2.5 rounded-md outline-blue-500" placeholder="Įveskite antrą kartą slaptažodį" />
                  <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4 cursor-pointer" viewBox="0 0 128 128">
                    <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
                  </svg>
                </div>
              </div>
            </div>
            <div class="!mt-10">
              <button type="submit" class="w-full py-3 px-4 text-sm font-semibold rounded text-white bg-gray-700 hover:bg-gray-800 focus:outline-none">
                Registruotis dabar
              </button>
            </div>
            <p class="text-sm mt-6 text-center">Esate užsiregistravęs? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline ml-1">Prisijungti</a></p>
          </form>
        </div>
      </div>

@endsection
