<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-extrabold text-white mb-8 border-b border-gray-800 pb-4">Your Cart</h1>
        
        <!-- Cart Alpine Component -->
        <div x-show="items.length === 0" style="display: none;" class="bg-gray-800 border border-gray-700 rounded-2xl p-12 text-center">
            <svg class="w-20 h-20 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <h3 class="text-2xl font-bold text-gray-300 mb-2">Your cart is empty</h3>
            <p class="text-gray-500 mb-6">Looks like you haven't added any delicious food yet.</p>
            <a href="{{ route('menu') }}" class="px-8 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-lg hover:shadow-lg transition-all">Browse Menu</a>
        </div>

        <div x-show="items.length > 0" style="display: none;">
            <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-xl mb-6">
                <ul class="divide-y divide-gray-700">
                    <template x-for="item in items" :key="item.product.id">
                        <li class="p-6 flex items-center">
                            <!-- Image -->
                            <div class="w-24 h-24 flex-shrink-0 bg-gray-700 rounded-lg overflow-hidden border border-gray-600">
                                <template x-if="item.product.image">
                                    <img :src="'/storage/' + item.product.image" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!item.product.image">
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-500">No Img</div>
                                </template>
                            </div>
                            
                            <!-- Details -->
                            <div class="ml-6 flex-1">
                                <h3 class="text-lg font-bold text-white" x-text="item.product.name"></h3>
                                <p class="text-gray-400 text-sm mt-1" x-text="'₹' + item.product.price"></p>
                            </div>

                            <!-- Quantity -->
                            <div class="flex items-center space-x-3 mr-8">
                                <button @click="updateQuantity(item, parseInt(item.quantity) - 1)" class="w-8 h-8 rounded-full bg-gray-700 text-gray-300 flex items-center justify-center hover:bg-gray-600 hover:text-white transition-colors">-</button>
                                <span class="font-bold w-4 text-center" x-text="item.quantity"></span>
                                <button @click="updateQuantity(item, parseInt(item.quantity) + 1)" class="w-8 h-8 rounded-full bg-gray-700 text-gray-300 flex items-center justify-center hover:bg-gray-600 hover:text-white transition-colors">+</button>
                            </div>

                            <!-- Line Total & Delete -->
                            <div class="flex flex-col items-end w-24">
                                <div class="text-lg font-bold text-yellow-400 mb-2" x-text="'₹' + (item.product.price * item.quantity).toFixed(2)"></div>
                                <button @click="removeItem(item)" class="text-sm text-red-500 hover:text-red-400 flex items-center group">
                                    Remove
                                </button>
                            </div>
                        </li>
                    </template>
                </ul>
                <div class="bg-gray-900/50 p-6 border-t border-gray-700 flex justify-between items-center">
                    <span class="text-gray-400 font-medium">Subtotal</span>
                    <span class="text-2xl font-extrabold text-white" x-text="'₹' + subtotal.toFixed(2)"></span>
                </div>
                <div class="px-6 pb-6">
                    <div class="mt-4 rounded-xl border border-gray-700 bg-gray-900 p-4">
                        <p class="mb-3 text-sm font-bold uppercase tracking-[0.12em] text-gray-400">Apply Coupon</p>
                        <div class="flex gap-3">
                            <input type="text" x-model="couponInput" placeholder="WELCOME10" class="flex-1 rounded-lg border border-gray-700 bg-[#111216] px-3 py-2 text-sm text-white uppercase">
                            <button type="button" @click="applyCouponOnCart" class="rounded-lg bg-yellow-500 px-4 py-2 text-sm font-bold text-gray-900">Apply</button>
                        </div>
                        <p x-show="couponMessage" class="mt-2 text-xs" :class="couponError ? 'text-red-400' : 'text-green-400'" x-text="couponMessage"></p>
                        <div class="mt-3 flex items-center justify-between text-sm text-gray-300">
                            <span>Discount</span>
                            <span class="font-bold text-green-400" x-text="'-₹' + discount.toFixed(2)"></span>
                        </div>
                        <div class="mt-1 flex items-center justify-between text-base text-white">
                            <span>Total</span>
                            <span class="font-extrabold text-yellow-400" x-text="'₹' + totalAfterDiscount.toFixed(2)"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('menu') }}" class="text-yellow-500 hover:text-yellow-400 font-medium">← Continue Shopping</a>
                <button @click="proceedToCheckout" class="px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-gray-900 font-bold rounded-lg shadow-lg shadow-yellow-500/20 hover:shadow-yellow-500/40 transform hover:-translate-y-0.5 transition-all shadow-glow">
                    Proceed to Checkout &rarr;
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
