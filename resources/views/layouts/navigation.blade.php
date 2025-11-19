<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-4">
                <!-- Logo -->
             <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt=" Logo" class="h-10 w-auto"></a>


                <!-- Categories / Search placeholder -->
                <select onchange="window.location.href=this.value"
                        class="border border-gray-300 p-2 rounded-lg dark:bg-gray-800 dark:text-white">
                    <option value="{{ route('home') }}">All Categories</option>
                    @foreach (\App\Models\Category::all() as $cat)
                        <option value="{{ route('category.products', $cat->id) }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <!-- Dashboard Link -->
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium 
                       {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-gray-700 dark:hover:text-white' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('services') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium 
                       {{ request()->routeIs('services') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-gray-700 dark:hover:text-white' }}">
                        Services
                    </a>
                    <a href="/about"
                       class="px-3 py-2 rounded-md text-sm font-medium 
                       {{ request()->routeIs('about') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-gray-700 dark:hover:text-white' }}">
                        About Us
                    </a>
                     <a href="/blog"
                       class="px-3 py-2 rounded-md text-sm font-medium 
                       {{ request()->routeIs('blog') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-gray-700 dark:hover:text-white' }}">
                        Blog
                    </a>
                @endauth
            </div>

            <!-- Right side (cart + auth links) -->
            <div class="flex items-center gap-4">
                <!-- Cart Icon -->
               <a href="{{ route('cart.index') }}" class="relative inline-flex items-center p-2 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">
    <svg class="w-6 h-6 text-gray-800 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path d="M3 3h2l.4 2M7 13h10l4-8H5.4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="9" cy="21" r="1" fill="currentColor"/>
        <circle cx="20" cy="21" r="1" fill="currentColor"/>
    </svg>

    @php $cart = session()->get('cart', []); @endphp
    @if(count($cart) > 0)
        <span class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full text-xs font-bold px-1.5">
            {{ count($cart) }}
        </span>
    @endif
</a>


                <!-- Auth Links -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300">
                                {{ Auth::user()->name }}
                                <svg class="fill-current h-4 w-4 ms-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-gray-500 dark:text-gray-300 px-3 py-2">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-500 dark:text-gray-300 px-3 py-2">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
