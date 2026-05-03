<!-- Cart Drawer Overlay & Panel -->
<div class="relative z-[100]" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-cloak>
    
    <!-- Background backdrop -->
    <div x-show="isCartOpen" 
         x-transition:enter="ease-in-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in-out duration-300" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-theme-dark/80 backdrop-blur-sm transition-opacity" 
         @click="isCartOpen = false"></div>

    <div class="fixed inset-0 overflow-hidden pointer-events-none" 
         x-data="{ 
            checkoutState: 'cart', 
         }">
         
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10"
                 x-show="isCartOpen"
                 x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 @click.away="isCartOpen = false">
                
                <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex h-full flex-col bg-theme-dark border-l border-gray-800 shadow-2xl relative">
                        
                        <!-- Header -->
                        <div class="flex items-start justify-between px-6 py-5 border-b border-gray-800 bg-gray-900/50 backdrop-blur-md sticky top-0 z-10 shrink-0">
                            <h2 class="text-xl font-bold text-white font-poppins" id="slide-over-title">Your Order</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" class="relative -m-2 p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-full transition-all focus:outline-none" @click="isCartOpen = false">
                                    <span class="absolute -inset-0.5"></span>
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- STATE 1: CAART ITEMS -->
                        <div x-show="checkoutState === 'cart'" class="flex-1 overflow-y-auto hide-scrollbar relative">
                            
                            <!-- Loading State -->
                            <div x-show="loadingCart" class="absolute inset-0 z-20 bg-theme-dark/80 backdrop-blur-sm flex flex-col items-center justify-center">
                                <svg class="animate-spin h-10 w-10 text-theme-orange mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-gray-400 font-medium animate-pulse font-poppins">Loading your feast...</p>
                            </div>

                            <!-- Empty State -->
                            <div x-show="!loadingCart && items.length === 0" class="flex flex-col items-center justify-center h-full text-center space-y-4 px-6 py-12">
                                <div class="w-40 h-40 bg-gray-800/30 rounded-full flex items-center justify-center mb-4 border border-dashed border-gray-700 relative">
                                    <div class="absolute inset-0 bg-theme-orange/5 rounded-full animate-pulse"></div>
                                    <img src="https://cdni.iconscout.com/illustration/premium/thumb/empty-cart-3613108-3020773.png" alt="Empty Cart" class="w-32 h-32 object-contain opacity-80 mix-blend-screen drop-shadow-2xl">
                                </div>
                                <h3 class="text-2xl font-bold text-white font-poppins mt-2">Belly is empty!</h3>
                                <p class="text-gray-400 max-w-xs font-inter leading-relaxed">Good food is always cooking! Go ahead, order some yummy items from the menu.</p>
                                <button type="button" @click="isCartOpen = false" class="mt-8 px-10 py-3.5 bg-gradient-to-r from-theme-orange to-red-600 text-white font-bold rounded-full shadow-[0_0_20px_rgba(255,107,0,0.4)] hover:shadow-[0_0_30px_rgba(255,107,0,0.6)] transition-all transform hover:-translate-y-1 w-full sm:w-auto font-poppins text-lg active:scale-95">Explore Menu</button>
                            </div>

                            <!-- Items List -->
                            <div x-show="!loadingCart && items.length > 0" class="px-6 py-6 pb-24">
                                <ul role="list" class="-my-6 divide-y divide-gray-800/50">
                                    <template x-for="item in items" :key="item.product_id || item.product.id">
                                        <li class="flex py-6 group transform transition-all duration-300"
                                            x-transition:leave="transition ease-in duration-300"
                                            x-transition:leave-start="opacity-100 translate-x-0"
                                            x-transition:leave-end="opacity-0 translate-x-full">
                                            
                                            <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-700 relative shadow-lg">
                                                <img :src="item.product.image ? '/storage/' + item.product.image : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=200&q=80'" :alt="item.product.name" class="h-full w-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                                <div class="absolute top-1 left-1 bg-white p-0.5 rounded shadow flex items-center justify-center">
                                                   <div class="w-2 h-2 rounded-full" :class="(item.product.id % 2 === 0) ? 'bg-green-600' : 'bg-red-600'"></div>
                                                </div>
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-bold text-white mb-1">
                                                        <h3 class="font-poppins text-sm leading-tight text-gray-200 group-hover:text-theme-orange transition-colors"><a href="#" x-text="item.product.name"></a></h3>
                                                        <p class="ml-4 text-theme-gold shrink-0 drop-shadow" x-text="'₹' + item.product.price"></p>
                                                    </div>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm mt-3">
                                                    <!-- Minimal Qty Controls -->
                                                    <div class="flex items-center bg-gray-800/80 rounded-lg p-0.5 border border-gray-700">
                                                        <button @click="updateQuantity(item, parseInt(item.quantity) - 1)" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-theme-orange hover:bg-gray-700 rounded-md transition-colors focus:outline-none" :disabled="item.quantity <= 1">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                                        </button>
                                                        <span class="w-6 text-center text-white font-bold" x-text="item.quantity"></span>
                                                        <button @click="updateQuantity(item, parseInt(item.quantity) + 1)" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-green-500 hover:bg-gray-700 rounded-md transition-colors focus:outline-none">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                        </button>
                                                    </div>

                                                    <button type="button" @click="removeItem(item)" class="p-2 text-gray-500 hover:text-red-500 hover:bg-red-500/10 rounded-lg transition-colors focus:outline-none" title="Remove Item">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>

                        <!-- Footer w/ Total & Checkout Button -->
                        <div x-show="checkoutState === 'cart' && !loadingCart && items.length > 0" class="absolute bottom-0 w-full border-t border-gray-800 bg-theme-dark/95 backdrop-blur-xl px-6 py-6 sm:px-6 shadow-[0_-10px_40px_rgba(0,0,0,0.5)] z-20 pb-8 rounded-t-3xl border-t border-white/5">
                            
                            <!-- You Saved Badge -->
                            <div class="mb-4 bg-green-500/10 border border-green-500/20 px-3 py-2 rounded-lg flex items-center justify-between shadow-inner">
                                <div class="flex items-center gap-2">
                                    <div class="p-1 bg-green-500/20 rounded text-green-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <p class="text-xs text-green-400 font-bold tracking-wide font-inter">PROMO APPLIED</p>
                                </div>
                                <p class="text-sm font-bold text-green-400 font-poppins">You save <span x-text="'₹' + Math.round(subtotal * 0.1)"></span>!</p>
                            </div>

                            <div class="flex justify-between text-base font-poppins font-bold text-gray-300 mb-2">
                                <p>Taxes & Delivery</p>
                                <p class="text-gray-400 font-normal">Calculated below</p>
                            </div>
                            
                            <div class="flex justify-between text-xl font-poppins font-extrabold text-white mb-6 border-b border-gray-800/50 pb-4">
                                <p>Grand Total</p>
                                <p class="text-theme-gold drop-shadow-md text-2xl" x-text="'₹' + Math.round(subtotal * 0.9)"></p>
                            </div>
                            
                            @php
                                $btnOrderMode = session('order_type', 'delivery');
                                $btnText = 'Proceed to Delivery Checkout';
                                if($btnOrderMode === 'takeaway') $btnText = 'Proceed to Pickup Checkout';
                                if($btnOrderMode === 'dine_in') $btnText = 'Proceed to Table Checkout';
                            @endphp
                            <!-- Checkout Button -->
                            <button @click="proceedToCheckout()" class="w-full relative group overflow-hidden rounded-xl border border-transparent bg-gradient-to-r from-theme-orange to-red-600 px-6 py-4 font-bold text-white shadow-xl transition-all hover:scale-[1.02] active:scale-95 focus:outline-none text-center">
                                {{ $btnText }}
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); scale: 1.05; }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }
</style>
