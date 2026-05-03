<x-app-layout>
    <!-- Main Layout Container -->
    <section class="pt-28 pb-16 px-6 lg:px-20 relative min-h-screen flex flex-col pt-[120px]">
        <div class="absolute inset-0 bg-[#0f1115] z-[-2]"></div>
        <!-- Ambient Glow -->
        <div class="absolute top-[10%] left-1/2 -translate-x-1/2 w-[600px] h-[300px] bg-theme-orange/10 blur-[120px] rounded-[100%] pointer-events-none z-[-1]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] z-[-1]"></div>

        <!-- Hero Header -->
        <div class="text-center mt-10 mb-12 relative z-10">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-theme-orange to-theme-gold tracking-tight">
                Find Us 📍
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Visit us for authentic Bengali flavors in the heart of Gurugram.
            </p>
        </div>

        <!-- Visual Divider -->
        <div class="border-t border-gray-800 my-10 relative z-10"></div>

        <!-- Main Content Grid -->
        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-10 items-stretch">
                
                <!-- Col 1: Location details & Areas -->
                <div class="space-y-10 flex flex-col justify-center order-1 lg:order-1">
                    
                    <!-- Location Card -->
                    <div class="bg-[#13151a] p-8 md:p-10 rounded-[2rem] border border-gray-800/60 shadow-[0_20px_40px_rgba(0,0,0,0.4)] relative group hover:border-gray-700 transition duration-500 h-full flex flex-col justify-between">
                        <!-- Top decorative bar -->
                        <div class="absolute top-0 left-8 right-8 h-px bg-gradient-to-r from-theme-orange/0 via-theme-orange/30 to-theme-orange/0"></div>
                        
                        <div>
                            <div class="flex items-center justify-between mb-10">
                                <h2 class="text-3xl font-extrabold text-white tracking-wide">Bongs Biryani</h2>
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold uppercase tracking-widest">
                                    <span class="relative flex h-2 w-2">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                    </span>
                                    Open Now
                                </span>
                            </div>

                            <div class="space-y-8">
                                <!-- Address -->
                                <div class="flex items-start gap-5">
                                    <div class="p-4 bg-[#1c1e26] rounded-2xl text-theme-gold shrink-0 border border-gray-800/80 shadow-md">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <div class="text-gray-400 leading-relaxed font-medium space-y-1 mt-1">
                                        <p class="text-white text-xl font-bold mb-2">SHOP No. 86</p>
                                        <p>SECTOR 15 PART 2</p>
                                        <p>Huda Market Rd, S-86</p>
                                        <p>Gurugram, Haryana 122001</p>
                                    </div>
                                </div>
                                
                                <!-- Phone -->
                                <div class="flex items-center gap-5 pt-8 border-t border-gray-800/60">
                                    <div class="p-4 bg-[#1c1e26] rounded-2xl text-theme-gold shrink-0 border border-gray-800/80 shadow-md group-hover:scale-110 transition-transform">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1.5">Call for queries</p>
                                        <p class="text-white text-2xl font-bold tracking-wide">+91 98765 43210</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-10">
                            <a href="https://www.google.com/maps?q=Bongs+Biryani+Gurugram" target="_blank" 
                               class="flex items-center justify-center gap-3 w-full py-4 rounded-xl bg-gradient-to-r from-theme-gold to-theme-orange text-gray-900 font-extrabold uppercase tracking-wider shadow-[0_0_20px_rgba(255,107,0,0.3)] hover:shadow-[0_0_30px_rgba(255,107,0,0.5)] transition-all transform hover:-translate-y-1 active:scale-95">
                                Get Directions
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Delivery Areas -->
                    <div class="pt-2">
                        <h3 class="text-lg font-bold text-white mb-5 flex items-center gap-3">
                            <span class="text-2xl">🛵</span> Delivering across Gurugram
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['Sector 14', 'Sector 15', 'Sector 56', 'Cyber Hub', 'DLF Phase 1', 'DLF Phase 3', 'Udyog Vihar'] as $area)
                                <span class="px-5 py-2.5 rounded-xl bg-[#16181f] border border-gray-800 text-sm text-gray-300 font-bold hover:bg-[#1c1e26] hover:border-theme-gold hover:text-theme-gold transition-all cursor-default shadow-sm hover:scale-105 hover:-translate-y-0.5">{{ $area }}</span>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Col 2: Map Visual -->
                <div class="order-2 lg:order-2 h-[450px] lg:h-auto min-h-[500px] rounded-[2rem] border-2 border-gray-800/80 bg-[#11131a] relative overflow-hidden shadow-[0_0_40px_rgba(0,0,0,0.5)] flex flex-col group p-2">
                    <div class="absolute inset-0 bg-theme-orange/5 blur-3xl pointer-events-none"></div>
                    <iframe 
                        src="https://www.google.com/maps?q=Bongs+Biryani+Gurugram&output=embed"
                        class="w-full h-full rounded-2xl border-0 relative z-10 filter contrast-125 saturate-150"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>
    </section>

</x-app-layout>
