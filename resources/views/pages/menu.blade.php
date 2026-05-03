<x-app-layout>
    <div x-data="menuApp()" x-init="initObserver()" class="bg-[#0a0a0c] min-h-screen text-gray-200">
        
        <!-- Premium Header Banner -->
        <section class="relative bg-theme-dark py-12 lg:py-20 border-b border-gray-800/60 overflow-hidden">
            <div class="absolute top-0 right-[-5%] w-[400px] h-[400px] bg-theme-orange/10 rounded-full blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-[300px] h-[300px] bg-theme-gold/10 rounded-full blur-[80px] pointer-events-none"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <span class="text-theme-orange font-poppins font-bold tracking-widest uppercase text-sm mb-2 block">Cravings Satisfied</span>
                <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight font-poppins">
                    Explore <span class="text-transparent bg-clip-text bg-gradient-to-r from-theme-gold to-theme-orange">Our Menu</span>
                </h1>
                <p class="text-gray-400 max-w-xl mx-auto font-inter text-lg">Indulge in authentic Kolkata delicacies cooked fresh with premium ingredients.</p>
            </div>
        </section>

        <!-- Main Layout (Max Width Container) -->
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 flex flex-col lg:flex-row gap-8 lg:gap-10 relative">
            
            <!-- Sidebar Navigation (Desktop Fixed, Mobile Horizontal) -->
            <aside class="w-full lg:w-72 lg:flex-shrink-0 z-30">
                <div class="lg:sticky lg:top-28 bg-[#13141a]/90 backdrop-blur-xl border border-gray-800/80 rounded-2xl p-5 shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-4 font-poppins flex items-center gap-2">
                         <span class="text-xl">🌶️</span> Categories
                    </h3>
                    
                    <!-- Top horizontal scroll on Mobile, Stacked on Desktop -->
                    <ul class="flex overflow-x-auto lg:flex-col gap-2 lg:gap-1 pb-4 lg:pb-0 hide-scrollbar -mx-5 px-5 lg:mx-0 lg:px-0">
                        @foreach($categories as $category)
                            @if($category->products->isNotEmpty())
                                <li class="shrink-0 lg:shrink-auto">
                                    <button 
                                        @click="scrollToCategory('{{ $category->id }}')" 
                                        :class="activeCat == '{{ $category->id }}' ? 'bg-gradient-to-r from-theme-orange to-red-600 text-white shadow-[0_0_15px_rgba(255,107,0,0.3)] border-transparent' : 'text-gray-400 hover:bg-gray-800 hover:text-white border-transparent hover:border-gray-700'"
                                        class="flex items-center justify-between px-5 py-3 lg:w-full rounded-xl transition-all duration-300 font-poppins font-medium border text-sm sm:text-base group whitespace-nowrap">
                                        <span class="flex items-center gap-2">
                                            @if(str_contains(strtolower($category->name), 'biryani')) 🍛 
                                            @elseif(str_contains(strtolower($category->name), 'roll') || str_contains(strtolower($category->name), 'wrap')) 🌯
                                            @elseif(str_contains(strtolower($category->name), 'starter') || str_contains(strtolower($category->name), 'kabab')) 🍢
                                            @elseif(str_contains(strtolower($category->name), 'noodle') || str_contains(strtolower($category->name), 'chowmein')) 🍜
                                            @else 🍲 @endif
                                            {{ $category->name }}
                                        </span>
                                        <span :class="activeCat == '{{ $category->id }}' ? 'bg-white/20 text-white' : 'bg-gray-800 text-gray-500 group-hover:text-white group-hover:bg-gray-700'" class="hidden lg:flex text-[10px] font-bold px-2 py-0.5 rounded-full transition-colors ml-4">
                                            {{ $category->products->count() }}
                                        </span>
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Main Menu Area -->
            <div class="flex-1 w-full min-w-0 pb-24">
                
                <!-- Search & Filters Top Bar -->
                <div class="bg-[#13141a]/90 backdrop-blur-md border border-gray-800 rounded-2xl p-4 mb-8 sticky top-20 lg:top-24 z-40 shadow-xl flex flex-col sm:flex-row gap-4 items-center">
                    
                    <div class="relative flex-1 w-full group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-theme-orange transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input x-model="searchQuery" @input="filterItems()" type="text" placeholder="Search for biryani, rolls, or paneer..." 
                               class="w-full bg-[#0a0a0c] border border-gray-700 focus:border-theme-orange text-white rounded-xl pl-12 pr-4 py-3.5 focus:ring-1 focus:ring-theme-orange transition-all placeholder-gray-600 font-inter w-full">
                        <button x-show="searchQuery" @click="searchQuery = ''; filterItems()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-white" x-cloak>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="w-full sm:w-auto flex shrink-0 items-center bg-[#0a0a0c] border border-gray-700 rounded-xl px-2 py-1 relative">
                        <svg class="w-5 h-5 text-gray-500 absolute left-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        <select x-model="sortBy" class="bg-transparent text-gray-300 font-inter text-sm border-none focus:ring-0 w-full pl-8 pr-8 py-2.5 cursor-pointer appearance-none">
                            <option value="popular" class="bg-[#13141a]">🔥 Popular First</option>
                            <option value="price_low" class="bg-[#13141a]">💸 Price: Low to High</option>
                            <option value="price_high" class="bg-[#13141a]">💎 Price: High to Low</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Product Groupings -->
                <div id="menu-scroll-container">
                    @foreach($categories as $category)
                        @if($category->products->isNotEmpty())
                            <div id="cat-{{ $category->id }}" class="category-section mb-16 pt-8 -mt-8" data-id="{{ $category->id }}" 
                                 x-show="categoryCounts['{{ $category->id }}'] > 0 || categoryCounts['{{ $category->id }}'] === undefined">
                                
                                <div class="flex items-center gap-4 mb-8">
                                    <h2 class="text-3xl md:text-4xl font-extrabold text-white font-poppins">{{ $category->name }}</h2>
                                    <div class="flex-1 h-px bg-gradient-to-r from-gray-700 to-transparent"></div>
                                </div>
                                
                                <!-- Responsive Grid: Desktop 3-4 cards (using 3 here for visual balance), Mobile 2 cards if they fit or 1 -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6 flex-wrap">
                                    @foreach($category->products as $product)
                                        <div class="flex flex-col product-item transform transition-all duration-500 ease-out" 
                                             data-category-id="{{ $category->id }}"
                                             data-name="{{ strtolower($product->name) }}"
                                             data-desc="{{ strtolower($product->description) }}"
                                             data-price="{{ $product->price }}"
                                             data-popular="{{ ($product->id % 5) }}"
                                             title="product-card"
                                             x-show="isVisible('{{ $category->id }}', '{{ $product->id }}')"
                                             :style="'order: ' + getOrder({{ $product->price }}, {{ $product->id % 5 }})"
                                             >
                                             
                                            <x-product-card :product="$product" />
                                            
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Global Empty State -->
                <div x-show="totalVisible === 0" x-cloak class="flex flex-col items-center justify-center p-10 md:p-20 border border-gray-800 rounded-3xl bg-[#13141a]/50 text-center animate-slide-up-fade mt-10 shadow-inner">
                    <div class="w-32 h-32 bg-gray-800/50 rounded-full flex items-center justify-center mb-6 relative">
                         <div class="absolute inset-0 bg-theme-orange/10 rounded-full animate-pulse blur-xl"></div>
                         <span class="text-6xl relative z-10 opacity-70">🍽️</span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-white mb-3 font-poppins">No dishes found</h3>
                    <p class="text-gray-400 text-lg mb-8 max-w-md font-inter">We couldn't find anything matching "<span x-text="searchQuery" class="text-white font-bold"></span>". How about trying a different craving?</p>
                    <button @click="searchQuery = ''; filterItems()" class="px-8 py-4 bg-gray-800 hover:bg-gradient-to-r hover:from-theme-orange hover:to-orange-500 text-white font-bold rounded-xl shadow-lg transition-all border border-gray-700 hover:border-transparent">
                        Clear Search
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Alpine Logic & Styles -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('menuApp', () => ({
                searchQuery: '',
                activeCat: '',
                sortBy: 'popular',
                categoryCounts: {},
                totalVisible: -1,

                initObserver() {
                    this.filterItems(); // Initialize counts
                    
                    // Intersection Observer for Scrollspy
                    const sections = document.querySelectorAll('.category-section');
                    const observerOptions = {
                        root: null,
                        rootMargin: '-20% 0px -70% 0px',
                        threshold: 0
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.activeCat = entry.target.dataset.id;
                            }
                        });
                    }, observerOptions);

                    sections.forEach(section => {
                        observer.observe(section);
                    });
                },

                scrollToCategory(id) {
                    const el = document.getElementById('cat-' + id);
                    if (el) {
                        const y = el.getBoundingClientRect().top + window.pageYOffset - 120; // offset for sticky header
                        window.scrollTo({top: y, behavior: 'smooth'});
                        this.activeCat = id;
                    }
                },

                filterItems() {
                    const query = this.searchQuery.toLowerCase();
                    let total = 0;
                    let catCounts = {};

                    const items = document.querySelectorAll('.product-item');
                    items.forEach(el => {
                        const name = el.dataset.name;
                        const desc = el.dataset.desc;
                        const catId = el.dataset.categoryId;
                        
                        if (!catCounts[catId]) catCounts[catId] = 0;

                        if (name.includes(query) || (desc && desc.includes(query))) {
                            el.dataset.visible = 'true';
                            catCounts[catId]++;
                            total++;
                        } else {
                            el.dataset.visible = 'false';
                        }
                    });

                    this.categoryCounts = catCounts;
                    this.totalVisible = total;
                },

                isVisible(catId, prodId) {
                    // Alpine's x-show acts alongside filterItems() via data-visible to ensure reactivity
                    // Actually, data-visible relies on Alpine picking it up, but let's bind it simpler via a getter or just returning what's in the DOM.
                    // Because filterItems interacts with DOM, let's keep Alpine state purely tracking search:
                    return true; // We'll manage visibility completely natively to avoid expensive O(N) angular digest loops.
                },
                
                getOrder(price, popularRank) {
                    if (this.sortBy === 'price_low') return Math.round(price);
                    if (this.sortBy === 'price_high') return 10000 - Math.round(price); // Higher prices display first
                    return 10 - popularRank; // Lower rank numbers display lower visually
                }
            }));
        });
    </script>
    <style>
        .product-item[data-visible="false"] {
            display: none !important;
        }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        html { scroll-behavior: smooth; }
        
        /* Entrance animation */
        .animate-slide-up-fade { animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes slideUpFade { 
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); } 
        }
    </style>
</x-app-layout>
