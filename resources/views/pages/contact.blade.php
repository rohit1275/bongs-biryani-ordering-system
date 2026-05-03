<x-app-layout>
    <!-- Hero Header -->
    <section class="relative pt-24 pb-16 overflow-hidden">
        <div class="absolute inset-0 bg-[#0f1115]"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[300px] bg-theme-gold/10 blur-[150px] rounded-[100%] pointer-events-none"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10 space-y-4">
            <h1 class="text-4xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-theme-gold to-white tracking-tight">
                Contact Us ☎️
            </h1>
            <p class="text-lg md:text-xl text-gray-400 font-medium max-w-2xl mx-auto">
                We’re here to help you. Reach out for any questions, catering orders, or just to say hi!
            </p>
        </div>
    </section>

    <!-- Main Content Divider -->
    <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent"></div>

    <!-- Contact Details & Form Section -->
    <section class="py-16 md:py-24 bg-[#0a0c10] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
                
                <!-- Col 1: Details -->
                <div class="flex flex-col space-y-10">
                    <div>
                        <h2 class="text-3xl font-extrabold text-white mb-8 border-l-4 border-theme-gold pl-4">Get In Touch</h2>
                        
                        <div class="space-y-6">
                            <!-- Detail Items -->
                            <div class="flex items-start gap-5 p-4 rounded-2xl bg-[#13151a] border border-gray-800/80 hover:border-theme-gold/50 transition-colors group">
                                <div class="w-12 h-12 rounded-full bg-theme-orange/10 flex items-center justify-center text-theme-orange mt-1 group-hover:scale-110 group-hover:bg-theme-orange/20 transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Phone</h4>
                                    <p class="text-xl font-bold text-gray-200">+91 98765 43210</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 p-4 rounded-2xl bg-[#13151a] border border-gray-800/80 hover:border-theme-gold/50 transition-colors group">
                                <div class="w-12 h-12 rounded-full bg-theme-orange/10 flex items-center justify-center text-theme-orange mt-1 group-hover:scale-110 group-hover:bg-theme-orange/20 transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Email</h4>
                                    <p class="text-xl font-bold text-gray-200">hello@bongsbiryani.com</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-5 p-4 rounded-2xl bg-[#13151a] border border-gray-800/80 hover:border-theme-gold/50 transition-colors group">
                                <div class="w-12 h-12 rounded-full bg-theme-orange/10 flex items-center justify-center text-theme-orange mt-1 group-hover:scale-110 group-hover:bg-theme-orange/20 transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="text-gray-200 font-medium">
                                    <h4 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Address</h4>
                                    <p class="text-lg font-bold mb-1">BONGS BIRYANI</p>
                                    <p class="text-gray-400">SHOP No. 86, SECTOR 15 PART 2</p>
                                    <p class="text-gray-400">Huda Market Rd, S-86</p>
                                    <p class="text-gray-400">Gurugram, Haryana 122001</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div>
                        <h3 class="text-lg font-bold text-white mb-4">Connect With Us</h3>
                        <div class="flex gap-4">
                            <a href="#" class="w-12 h-12 rounded-full bg-gradient-to-tr from-purple-600 via-pink-500 to-yellow-500 flex items-center justify-center text-white hover:scale-110 transition-transform shadow-lg">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.344 3.608 1.319.975.975 1.257 2.242 1.319 3.608.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.062 1.366-.344 2.633-1.319 3.608-.975.975-2.242 1.257-3.608 1.319-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-1.366-.062-2.633-.344-3.608-1.319-.975-.975-1.257-2.242-1.319-3.608-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.584.07-4.849.062-1.366.344-2.633 1.319-3.608.975-.975 2.242-1.257 3.608-1.319 1.266-.058 1.645-.07 4.849-.07M12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-full bg-theme-orange flex items-center justify-center text-white font-bold tracking-widest text-[0.65rem] uppercase hover:scale-110 transition-transform shadow-[0_5px_15px_rgba(255,107,0,0.4)]">
                                Swiggy
                            </a>
                            <a href="#" class="w-12 h-12 rounded-full bg-red-600 flex items-center justify-center text-white font-bold tracking-widest text-[0.65rem] uppercase hover:scale-110 transition-transform shadow-lg">
                                Magicpin
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Col 2: The Form -->
                <div>
                    <div class="bg-[#13151a] border border-gray-800/80 p-8 sm:p-10 rounded-3xl shadow-2xl relative overflow-hidden group">
                        
                        <div class="absolute top-0 right-0 w-32 h-32 bg-theme-orange/5 rounded-full blur-[40px] pointer-events-none"></div>

                        <form action="{{ route('contact.submit') }}" method="POST" x-data="{ submitting: false }" @submit="submitting = true" class="space-y-6 relative z-10">
                            @csrf
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wider">Your Name</label>
                                <input type="text" name="name" id="name" required class="w-full bg-[#0b0c10] border border-gray-700/80 focus:border-theme-orange/80 focus:ring-1 focus:ring-theme-orange/50 rounded-xl px-5 py-4 text-white placeholder-gray-600 transition-all duration-300" placeholder="John Doe">
                            </div>

                            <!-- Two Columns: Email & Phone -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wider">Email Address</label>
                                    <input type="email" name="email" id="email" required class="w-full bg-[#0b0c10] border border-gray-700/80 focus:border-theme-orange/80 focus:ring-1 focus:ring-theme-orange/50 rounded-xl px-5 py-4 text-white placeholder-gray-600 transition-all duration-300" placeholder="john@example.com">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wider">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" required class="w-full bg-[#0b0c10] border border-gray-700/80 focus:border-theme-orange/80 focus:ring-1 focus:ring-theme-orange/50 rounded-xl px-5 py-4 text-white placeholder-gray-600 transition-all duration-300" placeholder="98765 43210">
                                </div>
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-400 mb-2 uppercase tracking-wider">Your Message</label>
                                <textarea name="message" id="message" rows="4" required class="w-full bg-[#0b0c10] border border-gray-700/80 focus:border-theme-orange/80 focus:ring-1 focus:ring-theme-orange/50 rounded-xl px-5 py-4 text-white placeholder-gray-600 transition-all duration-300 resize-none" placeholder="How can we help you?"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" :disabled="submitting" class="w-full relative flex justify-center items-center py-4 rounded-xl font-extrabold uppercase tracking-[0.15em] text-gray-900 bg-gradient-to-r from-theme-gold to-theme-orange shadow-[0_0_20px_rgba(255,107,0,0.3)] hover:shadow-[0_0_30px_rgba(255,107,0,0.5)] transition-all transform hover:-translate-y-1 active:scale-95 text-sm">
                                <span x-show="!submitting">Send Message</span>
                                <span x-show="submitting" class="flex items-center gap-2" x-cloak>
                                    <svg class="animate-spin h-5 w-5 text-gray-900" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                    Sending...
                                </span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Floating Circular Action (WhatsApp/Call Optional block wrapper) -->
    <a href="tel:+919876543210" class="fixed bottom-24 right-4 sm:right-6 z-[100] group flex items-center justify-center w-14 h-14 bg-green-500 rounded-full shadow-lg hover:shadow-[0_10px_30px_rgba(34,197,94,0.4)] transition-transform hover:-translate-y-1 active:scale-95 text-white">
        <!-- Pulse ring -->
        <span class="absolute inset-0 rounded-full border border-green-400 animate-ping opacity-75"></span>
        <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
        <span class="absolute right-[calc(100%+15px)] px-3 py-1.5 bg-gray-900 border border-gray-700 text-xs font-bold text-gray-200 rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Call Now</span>
    </a>

</x-app-layout>
