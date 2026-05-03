<nav x-data="{ mobileMenuOpen: false }" class="bg-theme-dark border-b border-gray-800/80 sticky top-0 z-50 glassmorphism">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-4 sm:gap-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-theme-orange flex items-center justify-center text-white font-bold text-xl relative glow-orange">
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-theme-gold rounded-full"></span>
                        B
                    </div>
                    <span class="text-2xl font-extrabold text-white tracking-tight font-poppins hidden lg:block">
                        Bongs<span class="text-theme-orange">Biryani</span>
                    </span>
                </a>

                @php
                    $orderMode = session('order_type', 'delivery');
                    $tableNo = session('table_no');
                @endphp
                <div class="flex flex-col items-start justify-center mt-1">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-500/20 to-orange-500/20 border border-yellow-500/30 text-yellow-500 whitespace-nowrap shadow-[0_0_10px_rgba(234,179,8,0.1)]">
                        @if($orderMode === 'takeaway')
                            🛍 Takeaway Mode
                        @elseif($orderMode === 'dine_in')
                            🍽 Dine-In Mode @if($tableNo) | Table: {{ $tableNo }} @endif
                        @else
                            🚚 Delivery Mode
                        @endif
                    </span>
                    <a href="{{ route('order-mode') }}" class="text-[10px] text-gray-400 hover:text-white underline underline-offset-2 mt-1 ml-1 transition-colors">Change Order Mode</a>
                </div>
            </div>

            <!-- Center Links -->
            <div class="hidden md:flex space-x-10 items-center">
                <a href="{{ route('home') }}" class="relative text-white font-semibold text-sm group">
                    Home
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-theme-orange rounded-full transition-all {{ request()->routeIs('home') ? 'opacity-100' : 'opacity-0' }}"></span>
                </a>
                <a href="{{ route('menu') }}" class="relative text-gray-300 hover:text-white font-semibold text-sm transition-colors group">
                    Menu
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-theme-orange rounded-full opacity-0 group-hover:opacity-100 transition-all {{ request()->routeIs('menu') ? 'opacity-100' : '' }}"></span>
                </a>
                <a href="{{ route('track') }}" class="relative text-gray-300 hover:text-white font-semibold text-sm transition-colors group">
                    Tracking
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-theme-orange rounded-full opacity-0 group-hover:opacity-100 transition-all {{ request()->routeIs('track') ? 'opacity-100' : '' }}"></span>
                </a>
                <a href="{{ route('location') }}" class="relative text-gray-300 hover:text-white font-semibold text-sm transition-colors group">
                    Location
                    <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-1.5 h-1.5 bg-theme-orange rounded-full opacity-0 group-hover:opacity-100 transition-all {{ request()->routeIs('location') ? 'opacity-100' : '' }}"></span>
                </a>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-3 sm:space-x-8">
                <!-- Cart Icon -->
                <button @click.prevent="isCartOpen = true" class="relative text-white hover:text-theme-gold transition-colors p-2 bg-gray-800/80 rounded-xl hover:bg-gray-700/80">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <span x-show="totalItems > 0" x-text="totalItems" x-cloak class="absolute -top-2 -right-2 bg-theme-orange text-white text-[10px] font-bold rounded-full h-5 w-5 flex items-center justify-center ring-2 ring-theme-dark glow-orange"></span>
                </button>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-300 hover:text-white bg-gray-800/80 rounded-xl transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <!-- Auth Links -->
                <div class="hidden sm:flex items-center space-x-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white font-medium text-sm transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-theme-orange to-red-500 hover:from-red-500 hover:to-red-600 text-white font-bold px-6 py-2.5 rounded-xl shadow-[0_0_20px_rgba(255,107,0,0.4)] transition-all text-sm tracking-wide transform hover:-translate-y-0.5">
                            Sign Up
                        </a>
                    @else
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center text-white hover:text-theme-gold font-medium transition-colors gap-2 bg-gray-800/50 px-4 py-2 rounded-xl">
                                {{ Auth::user()->name }}
                                <svg class="flex-shrink-0 h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 translate-y-2"
                                 class="absolute right-0 mt-3 w-56 bg-theme-dark/95 backdrop-blur-xl rounded-xl shadow-[0_10px_40px_rgba(0,0,0,0.5)] py-2 z-50 border border-gray-800/50" x-cloak>
                                
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-5 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-theme-orange transition-colors flex items-center gap-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Admin Dashboard
                                    </a>
                                @endif
                                <a href="{{ route('orders.index') }}" class="block px-5 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    My Orders
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-5 py-3 text-sm text-gray-300 hover:bg-gray-800 hover:text-white transition-colors flex items-center gap-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profile
                                </a>
                                <div class="border-t border-gray-800 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-5 py-3 text-sm text-red-500 hover:bg-red-500/10 transition-colors flex items-center gap-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="mobileMenuOpen" x-collapse x-cloak class="md:hidden bg-theme-dark border-t border-gray-800">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-white hover:bg-gray-800 transition-colors {{ request()->routeIs('home') ? 'bg-gray-800 text-theme-orange' : '' }}">Home</a>
            <a href="{{ route('menu') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-colors {{ request()->routeIs('menu') ? 'bg-gray-800 text-theme-orange' : '' }}">Menu</a>
            <a href="{{ route('track') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-colors {{ request()->routeIs('track') ? 'bg-gray-800 text-theme-orange' : '' }}">Tracking</a>
            <a href="{{ route('location') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800 transition-colors {{ request()->routeIs('location') ? 'bg-gray-800 text-theme-orange' : '' }}">Location</a>
            
            <div class="border-t border-gray-800 pt-4 mt-4">
                @guest
                    <a href="{{ route('login') }}" class="block px-3 py-3 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-3 py-3 text-base font-medium text-theme-orange hover:text-orange-400 hover:bg-gray-800 rounded-lg mt-1">Sign Up</a>
                @else
                    <div class="px-3 py-2 text-xs text-gray-500 uppercase tracking-wider font-bold">Account</div>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800">Admin Dashboard</a>
                    @endif
                    <a href="{{ route('orders.index') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800">My Orders</a>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-3 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:bg-gray-800">Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-3 text-base font-medium rounded-lg text-red-500 hover:bg-red-500/10">Log Out</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
