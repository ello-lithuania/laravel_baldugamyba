<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Baldugamyba.lt')</title>

        <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                max-width: 100vw;
                overflow-x: hidden
            }
            .container {
                padding-left: 10%;
                padding-right: 10%;
                max-width: 100% !important;
            }
            @media only screen and (max-width: 960px) {
                .container {
                padding-left: 10px;
                padding-right: 10px;
                }
            }
        </style>
    </head>
    <body>
        <nav
        class="relative flex w-full flex-wrap items-center justify-between bg-zinc-50 py-2 shadow-dark-mild dark:bg-neutral-300 container"
        data-twe-navbar-ref>
        <div class="flex w-full flex-wrap items-center justify-between">
          <div>
              <a
                  class="my-1 flex items-center lg:mb-0 lg:mt-0 text-white/60 uppercase transition duration-200 hover:text-white/80 hover:ease-in-out active:text-white/80 motion-reduce:transition-none"
                  aria-current="page"
                  href="{{ route('welcome')}}"
                  data-twe-nav-link-ref
                  >
                  <img src="{{ asset('assets/images/watermark.png') }}" />
              </a>
          </div>

          <!-- Hamburger button for mobile view -->
          <button
            class="toggle-top-nav block border-0 bg-transparent px-2 text-black/50 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
            type="button"
            data-twe-collapse-init
            data-twe-target="#navbarSupportedContent4"
            aria-controls="navbarSupportedContent4"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <!-- Hamburger icon -->
            <span
              class="[&>svg]:w-7 [&>svg]:stroke-black/50">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor">
                <path
                  fill-rule="evenodd"
                  d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                  clip-rule="evenodd" />
              </svg>
            </span>
          </button>

          <!-- Collapsible navbar container -->
          <div
            class="!visible mt-2 hidden flex-grow basis-[100%] items-center lg:mt-0 lg:!flex lg:basis-auto"
            id="navbarSupportedContent4"
            data-twe-collapse-item>
            <!-- Left links -->
            <ul
              class="hidden list-style-none me-auto lg:flex flex-col ps-0 lg:mt-1 lg:flex-row"
              data-twe-navbar-nav-ref>
              <!-- Home link -->
              <li
                class="my-4 ps-2 lg:my-0 lg:pe-1 lg:ps-2 hidden"
                data-twe-nav-item-ref>
                <a
                  class="text-white/60 uppercase transition duration-200 hover:text-white/80 hover:ease-in-out active:text-white/80 motion-reduce:transition-none lg:px-2"
                  aria-current="page"
                  href="{{ route('welcome') }}"
                  data-twe-nav-link-ref
                  ><img src="{{ asset('assets/images/watermark.png') }}" /></a>
              </li>
            </ul>

            <div class="flex items-center flex-col lg:flex-row sm:justify-end">

                @auth
                    <a
                    href="{{ route('dashboard') }}"
                    class="inline-block rounded bg-neutral-800 px-3 py-2.5 text-xs font-medium uppercase leading-normal text-white shadow-dark-3 transition duration-150 ease-in-out hover:bg-black-700 hover:shadow-dark-2 focus:bg-black-700 focus:shadow-dark-2 focus:outline-none focus:ring-0 active:bg-black-900 active:shadow-dark-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                        Valdymo pultas
                    </a>
                @else
                    <a
                        href="{{ route('register') }}"
                        class="mb-[10px] lg:mb-0 lg:me-3 inline-block rounded bg-primary lg:px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-black-700 shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                        Registruotis
                    </a>
                    <a
                        href="{{ route('login') }}"
                        class="inline-block rounded lg:bg-neutral-800 px-3 py-2.5 text-xs font-medium uppercase leading-normal lg:text-neutral-50 shadow-dark-3 transition duration-150 ease-in-out hover:bg-black-700 hover:shadow-dark-2 focus:bg-black-700 focus:shadow-dark-2 focus:outline-none focus:ring-0 active:bg-black-900 active:shadow-dark-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                        Prisijungti
                    </a>
                @endauth

            </div>
          </div>
        </div>
      </nav>

        <div class="bg-gray-100">
            <div class="w-full bg-white">

                @yield('content')

            </div>
        </div>

        <footer class="bg-neutral-200 container">
            <div class="w-full max-w-screen-xl mx-auto py-4">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a
                    class="text-white/60 flex items-center justify-center uppercase transition duration-200 hover:text-white/80 hover:ease-in-out active:text-white/80 motion-reduce:transition-none lg:px-2"
                    aria-current="page"
                    href="{{ route('welcome')}}"
                    data-twe-nav-link-ref
                    ><img src="{{ asset('assets/images/watermark.png') }}" /></a>
                    <ul class="mt-8 lg:mt-0 flex flex-wrap items-center justify-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                        <li>
                            <a href="{{ route('welcome')}}" class="hover:underline me-4 md:me-6">Pagrindinis</a>
                        </li>
                        <li>
                            <a href="{{ route('privacy')}}" class="hover:underline me-4 md:me-6">Naudojimosi taisyklės</a>
                        </li>
                        <li>
                            <a href="{{ route('contacts')}}" class="hover:underline me-4 md:me-6">Kontaktai</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script>
            $( document ).ready(function() {
                $( ".toggle-top-nav" ).on( "click", function() {
                    $('#navbarSupportedContent4').toggleClass('hidden');
                } );
            });
        </script>


    </body>
</html>
