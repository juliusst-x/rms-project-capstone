<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<!-- Desktop sidebar -->
<aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <img src="{{ asset('img/rms2.png')}}" alt="" class="inline-flex ml-3 items-center transform transition hover:scale-125 duration-300 ease-in-out" width="100" height="100" />
		<a class="ml-3 text-lg font-bold text-gray-800 dark:text-gray-200" href="/">
			RMS
		</a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('masyarakat-dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('masyarakat-dashboard') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>

        
        <ul class="mt-6">
			<li class="relative px-6 py-3">
				<span
                    class="{{ request()->routeIs('concern_form') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
				<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{ route('concern_form') }} ">
                    <i class="fa-solid fa-file"></i>
					<span class="ml-4">Concern Form</span>
				</a>
			</li>
		</ul>


        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('user_concern') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('user_concern') }} ">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-4">Reports</span>
                </a>
            </li>
        </ul>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('water.floodWarning') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('water.floodWarning') }} ">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                    <span class="ml-4">Flood Warning</span>
                </a>
            </li>
        </ul>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('trash.waste') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('trash.waste') }} ">
                    <i class="fas fa-trash w-5 h-5"></i>
                    <span class="ml-4">Trash</span>
                </a>
            </li>
        </ul>

    </div>
</aside>

<!-- Mobile sidebar -->
<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('masyarakat-dashboard') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('masyarakat-dashboard') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul class="mt-6">
			<li class="relative px-6 py-3">
				<span
                    class="{{ request()->routeIs('concern_form') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
				<a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                href="{{ route('concern_form') }} ">
                    <i class="fa-solid fa-file"></i>
					<span class="ml-4">Concern Form</span>
				</a>
			</li>
		</ul>

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('user_concern') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('user_concern') }} ">
                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-4">Reports</span>
                </a>
            </li>
        </ul>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('water.floodWarning') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('water.floodWarning') }} ">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                    <span class="ml-4">Flood Warning</span>
                </a>
            </li>
        </ul>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="{{ request()->routeIs('trash.waste') ? 'absolute inset-y-0 left-0 w-1 bg-red-600 rounded-tr-lg rounded-br-lg' : '' }} "
                    aria-hidden="true"></span>
                <a class="inline-flex items-center text-sm mr-5 font-semibold transition-colors duration-150 "
                    href="{{ route('trash.waste') }} ">
                    <i class="fas fa-trash w-5 h-5"></i>
                    <span class="ml-4">Trash</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
