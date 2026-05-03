<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-theme-dark overflow-hidden pt-8 pb-16 lg:pt-16 lg:pb-24">
        <!-- Floating shapes & ambient lights -->
        <div class="absolute top-0 right-[-10%] w-[600px] h-[600px] bg-theme-orange/15 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-theme-gold/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                
                <!-- Left text content -->
                <div class="w-full lg:w-[55%] flex flex-col items-start text-left shrink-0" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
                    <div class="flex items-center space-x-2 glassmorphism rounded-full px-5 py-2 mb-8 shadow-xl transition-all duration-700 transform" :class="show ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        <span class="flex items-center justify-center w-6 h-6 bg-theme-orange rounded-full text-white text-xs glow-orange">🔥</span>
                        <span class="text-sm font-bold text-gray-200 tracking-wider uppercase font-inter">Bongs Biryani - Where Kolkata Lives</span>
                    </div>

                    <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-[1.1] font-poppins transition-all duration-700 delay-100 transform" :class="show ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        Real Bengali <br>
                        Dum Biryani & <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-theme-gold to-theme-orange">Juicy Rolls.</span>
                    </h1>
                    
                    <p class="text-lg text-gray-400 max-w-lg mb-10 leading-relaxed border-l-4 border-theme-gold pl-4 transition-all duration-700 delay-200 transform font-inter" :class="show ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        Experience the authentic taste of Kolkata right here in Gurugram. Confirm your order and enjoy our lightning-fast, deliciously hot delivery to your door!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6 w-full sm:w-auto transition-all duration-700 delay-300 transform" :class="show ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                        <a href="{{ route('menu') }}" class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-theme-orange to-red-600 text-white font-bold rounded-full shadow-[0_0_25px_rgba(255,107,0,0.4)] hover:shadow-[0_0_35px_rgba(255,107,0,0.6)] transform hover:-translate-y-1 active:scale-95 transition-all text-lg flex items-center justify-center gap-3 font-poppins duration-300">
                            <span>Order Now</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                        <a href="{{ route('menu') }}" class="w-full sm:w-auto text-center text-theme-gold font-bold hover:text-yellow-300 transition-colors text-lg flex items-center justify-center font-poppins group duration-300">
                            Explore Menu
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Right image content -->
                <div class="w-full lg:w-1/2 relative mt-16 lg:mt-0 flex justify-center lg:justify-end">
                    <div class="relative w-[320px] h-[320px] sm:w-[450px] sm:h-[450px] md:w-[550px] md:h-[550px] flex items-center justify-center transition-transform hover:scale-105 duration-500">
                        <div class="absolute inset-0 bg-theme-orange/20 rounded-full blur-[100px] animate-pulse"></div>
                        <img src="{{ Storage::url('3d-biryani.png') }}" alt="Tasty 3D Biryani" class="w-full h-full object-contain drop-shadow-[0_35px_35px_rgba(0,0,0,0.8)] scale-110 animate-[float_6s_ease-in-out_infinite]">
                        
                        <!-- Floating Glass Widget -->
                        <div class="absolute top-[10%] -left-[5%] sm:-left-[10%] glassmorphism p-3 sm:p-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-[float_5s_ease-in-out_infinite_reverse]">
                            <div class="flex -space-x-3">
                                <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-theme-dark object-cover" src="https://i.pravatar.cc/100?img=1" alt="Customer">
                                <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-theme-dark object-cover" src="https://i.pravatar.cc/100?img=2" alt="Customer">
                                <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-theme-dark object-cover" src="https://i.pravatar.cc/100?img=3" alt="Customer">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-theme-dark bg-theme-gold flex items-center justify-center text-xs font-bold text-gray-900">2k+</div>
                            </div>
                            <div class="text-white">
                                <p class="text-xs sm:text-sm font-bold font-poppins">Happy Customers</p>
                                <div class="flex text-theme-gold text-xs">
                                    ★★★★★
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <style>
            @keyframes float {
                0% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(2deg); }
                100% { transform: translateY(0px) rotate(0deg); }
            }
        </style>
    </section>

    <!-- Glowing Divider -->
    <div class="w-full z-20 relative h-px bg-gradient-to-r from-transparent via-theme-gold to-transparent opacity-50 shadow-[0_0_15px_rgba(250,204,21,0.5)]"></div>

    <!-- Recently Added (New Premium Horizontal Scroll Section) -->
    <section class="py-[80px] bg-theme-dark relative z-20 overflow-hidden">
        <div class="absolute top-1/2 left-0 w-full h-[300px] bg-theme-orange/5 blur-[100px] -translate-y-1/2 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 reveal-on-scroll">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <span class="text-blue-400 font-bold uppercase tracking-wider text-sm font-poppins flex items-center gap-2">
                        <span class="text-lg">⭐</span> Just Dropped
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mt-1 font-poppins">Recently Added</h2>
                </div>
            </div>
            
            <div class="flex overflow-x-auto pb-8 -mx-4 px-4 sm:mx-0 sm:px-0 snap-x snap-mandatory gap-6 hide-scrollbar lg:grid lg:grid-cols-4 lg:gap-8 lg:overflow-visible lg:pb-0">
                <!-- Fetch latest items (reverse of what was standard logic) -->
                @foreach($featuredProducts->reverse()->take(4) as $product)
                    <div class="min-w-[280px] w-[80vw] sm:w-[350px] lg:w-auto snap-center shrink-0">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Glowing Divider -->
    <div class="w-full z-20 relative h-px bg-gradient-to-r from-transparent via-theme-orange to-transparent opacity-50 shadow-[0_0_15px_rgba(255,107,0,0.5)]"></div>

    <!-- Categories Section -->
    <section class="py-[80px] bg-[#0a0d12] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 reveal-on-scroll">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-theme-gold font-bold uppercase tracking-wider text-sm font-poppins">Explore Menu</span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mt-1 font-poppins">Our Categories</h2>
                    <div class="h-1 w-20 bg-theme-orange mt-4 rounded"></div>
                </div>
                <a href="{{ route('menu') }}" class="text-gray-400 hover:text-theme-orange font-medium uppercase text-sm tracking-wider flex items-center gap-2 transition-colors">View all <span class="text-xl">&rarr;</span></a>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
                @foreach($categories as $category)
                <a href="{{ route('menu', ['category' => $category->id]) }}" class="bg-gray-800/40 backdrop-blur-sm border border-gray-700/50 hover:bg-gray-800 hover:border-theme-orange/50 hover:shadow-[0_0_20px_rgba(255,107,0,0.2)] rounded-2xl p-5 text-center transform hover:-translate-y-2 transition-all duration-300 group shadow-lg">
                    <div class="w-16 h-16 mx-auto bg-gray-900 group-hover:bg-theme-orange/20 rounded-full flex items-center justify-center mb-4 transition-colors border border-gray-800 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-transparent to-white/5 group-hover:to-theme-orange/10 transform -translate-x-full transition-transform group-hover:translate-x-full duration-700"></div>
                        <svg class="w-8 h-8 text-gray-400 group-hover:text-theme-orange transition-colors relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-300 group-hover:text-white text-sm leading-tight font-poppins">{{ $category->name }}</h3>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <div class="w-full z-20 relative h-px bg-gradient-to-r from-transparent via-theme-orange to-transparent opacity-50 shadow-[0_0_15px_rgba(255,107,0,0.5)]"></div>

    <!-- New Launches -->
    <section class="py-[80px] bg-theme-dark relative overflow-hidden">
        <div class="absolute top-1/2 right-0 w-[400px] h-[400px] bg-green-500/5 blur-[100px] -translate-y-1/2 pointer-events-none mb-10"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 reveal-on-scroll" style="animation-delay: 200ms;">
            <div class="text-center mb-16">
                <span class="text-green-400 font-bold uppercase tracking-wider text-sm bg-green-500/10 px-4 py-1.5 rounded-full border border-green-500/20 font-inter box-shadow-glow">New & Fresh</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mt-6 mb-4 font-poppins">Trending Today</h2>
                <p class="text-gray-400 font-inter max-w-2xl mx-auto">Discover our latest delicious additions heavily ordered this week. Be the first to try these new authentic flavors.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($newLaunches as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Glowing Divider -->
    <div class="w-full z-20 relative h-px bg-gradient-to-r from-transparent via-theme-gold to-transparent opacity-50 shadow-[0_0_15px_rgba(250,204,21,0.5)]"></div>

    <!-- Featured Items Grid -->
    <section class="py-[80px] bg-[#0a0d12]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 reveal-on-scroll">
            <div class="text-center mb-16">
                <span class="text-theme-gold font-bold uppercase tracking-wider text-sm font-poppins">Signature Dishes</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mt-2 mb-4 font-poppins">Chef's Recommendations</h2>
                <p class="text-gray-400 font-inter max-w-2xl mx-auto">Our highest rated, authentic signature dishes crafted with traditional recipes.</p>
                <div class="h-1 w-24 bg-theme-gold mt-6 rounded mx-auto glow-gold"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts->skip(4)->take(8) as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
            
            <div class="text-center mt-16">
                 <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-gray-800 hover:bg-gradient-to-r hover:from-theme-orange hover:to-orange-500 text-gray-300 hover:text-white font-bold rounded-full transition-all border border-gray-700 hover:border-transparent transform hover:-translate-y-1 font-poppins shadow-lg active:scale-95 duration-300">
                    Explore Full Menu
                    <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                 </a>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-[100px] bg-gradient-to-br from-[#1a0a0c] to-theme-dark relative overflow-hidden reveal-on-scroll">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1563379091339-03f0d5def2c0?auto=format&w=1920')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>
        
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10 glassmorphism rounded-3xl p-12 lg:p-16 border-white/10 shadow-2xl">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-6 font-poppins leading-tight">Craving Authentic<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-theme-gold to-theme-orange">Bengali Flavors?</span></h2>
            <p class="text-xl text-gray-300 mb-10 font-inter max-w-2xl mx-auto">Register today and use promo code <span class="text-theme-gold font-mono font-bold tracking-widest bg-black/50 px-3 py-1 rounded border border-theme-gold/30">WELCOME10</span> for 10% off your entire first order!</p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 w-full sm:w-auto">
                @guest
                    <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-10 py-4 bg-gradient-to-r from-theme-orange to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-full shadow-[0_0_30px_rgba(255,107,0,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 text-lg tracking-wide uppercase font-poppins duration-300">
                        Create Account
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @else
                    <a href="{{ route('menu') }}" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-10 py-4 bg-gradient-to-r from-theme-orange to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-full shadow-[0_0_30px_rgba(255,107,0,0.4)] transition-all transform hover:-translate-y-1 active:scale-95 text-lg tracking-wide uppercase font-poppins duration-300">
                        Start Ordering
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </a>
                @endguest
            </div>
        </div>
        
        <!-- Decorative elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-theme-gold/20 rounded-full blur-[40px]"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-theme-orange/20 rounded-full blur-[50px]"></div>
    </section>

    <!-- Global Reveal Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up-fade');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
    });
    </script>
    <style>
        .reveal-on-scroll { opacity: 0; transform: translateY(30px); }
        .animate-slide-up-fade { animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes slideUpFade { to { opacity: 1; transform: translateY(0); } }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>
