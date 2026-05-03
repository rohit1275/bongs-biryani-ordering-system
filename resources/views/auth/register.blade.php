<x-app-layout>
    <div class="min-h-[85vh] bg-[#0b0f14] flex flex-col justify-center items-center px-4 py-12 relative overflow-hidden">
        <!-- Floating shapes -->
        <div class="absolute top-[10%] -right-[10%] w-[500px] h-[500px] bg-theme-gold/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[0%] -left-[10%] w-[500px] h-[500px] bg-theme-orange/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-lg bg-[#13141a]/90 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 sm:p-10 shadow-2xl relative z-10 animate-slide-up-fade">
            <!-- Header -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mb-2">
                    <div class="w-10 h-10 rounded-full bg-theme-orange flex items-center justify-center text-white font-bold text-xl relative glow-orange shadow-[0_0_15px_rgba(255,107,0,0.4)]">
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-theme-gold rounded-full border border-theme-dark"></span>
                        B
                    </div>
                </a>
                <h2 class="text-3xl font-extrabold text-white font-poppins tracking-tight mt-4">Join Bongs Biryani</h2>
                <p class="text-gray-400 font-inter text-sm mt-2">Create an account to start ordering</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div class="group">
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-1.5 font-inter group-focus-within:text-theme-gold transition-colors">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-theme-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                            class="block w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:ring-1 focus:ring-theme-gold focus:border-theme-gold transition-all font-inter" 
                            placeholder="John Doe">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs text-opacity-90" />
                </div>

                <!-- Email Address -->
                <div class="group">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1.5 font-inter group-focus-within:text-theme-gold transition-colors">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-theme-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" /></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                            class="block w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:ring-1 focus:ring-theme-gold focus:border-theme-gold transition-all font-inter" 
                            placeholder="you@example.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs text-opacity-90" />
                </div>
                
                <!-- Phone -->
                <div class="group">
                    <label for="phone" class="block text-sm font-medium text-gray-400 mb-1.5 font-inter group-focus-within:text-theme-gold transition-colors">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-theme-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required autocomplete="tel" 
                            class="block w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:ring-1 focus:ring-theme-gold focus:border-theme-gold transition-all font-inter" 
                            placeholder="98765 43210">
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-1 text-red-400 text-xs text-opacity-90" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password -->
                    <div class="group">
                        <label for="password" class="block text-sm font-medium text-gray-400 mb-1.5 font-inter group-focus-within:text-theme-gold transition-colors">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-theme-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password" 
                                class="block w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:ring-1 focus:ring-theme-gold focus:border-theme-gold transition-all font-inter" 
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs text-opacity-90" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="group">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-400 mb-1.5 font-inter group-focus-within:text-theme-gold transition-colors">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-theme-gold transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                                class="block w-full pl-12 pr-4 py-3 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:ring-1 focus:ring-theme-gold focus:border-theme-gold transition-all font-inter" 
                                placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400 text-xs text-opacity-90" />
                    </div>
                </div>

                <div class="pt-5 flex flex-col gap-4">
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-[0_0_15px_rgba(255,107,0,0.3)] text-sm font-bold text-gray-900 tracking-widest uppercase bg-gradient-to-r from-theme-gold to-theme-orange hover:to-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-theme-gold focus:ring-offset-gray-900 transform hover:-translate-y-0.5 active:scale-95 transition-all duration-300 font-poppins">
                        Sign up
                    </button>
                    
                    <p class="text-center text-sm text-gray-400 mt-4 font-inter">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-bold text-white hover:text-theme-gold hover:underline transition-colors">Log in</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
