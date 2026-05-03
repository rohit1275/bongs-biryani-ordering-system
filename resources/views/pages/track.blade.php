<x-app-layout>
    <!-- Header Section -->
    <section class="relative bg-[#0f0f11] py-16 border-b border-gray-800">
        <!-- Ambient Background Lights -->
        <div class="absolute top-0 right-[10%] w-[300px] h-[300px] bg-red-600/10 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 left-[10%] w-[300px] h-[300px] bg-yellow-500/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
                Track & <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-600">Locate</span>
            </h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                Follow your favorite Dum Biryani on its way to your door, or visit us directly to satisfy your cravings.
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-24 bg-[#0a0a0c] min-h-[500px]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#1a1a1f] p-8 md:p-12 rounded-3xl border border-gray-800 shadow-[0_0_50px_rgba(0,0,0,0.6)] relative overflow-hidden group">
                <!-- Subtle hover glow effect -->
                <div class="absolute inset-0 bg-gradient-to-br from-red-600/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <div class="relative z-10">
                    <div class="flex flex-col items-center justify-center text-center space-y-4 mb-10">
                        <div class="w-16 h-16 rounded-full bg-red-600/20 flex items-center justify-center text-red-500 mb-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h2 class="text-3xl font-extrabold text-white tracking-tight">Track Your Order</h2>
                        <p class="text-gray-400 max-w-md mx-auto text-lg leading-relaxed">
                            Enter your Order ID below to get real-time status updates from our kitchen to your doorstep.
                        </p>
                    </div>

                    <form class="space-y-8" x-data="{ tracking: false, orderId: '' }" @submit.prevent="tracking = true">
                        <div class="space-y-6">
                            <div>
                                <label for="order_id" class="block text-sm font-semibold text-gray-400 mb-3 uppercase tracking-wider">Order ID (e.g. ORD-12345)</label>
                                <input type="text" id="order_id" x-model="orderId" required
                                       class="w-full bg-[#0f0f11] border border-gray-700 rounded-xl px-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all shadow-inner"
                                       placeholder="Enter 8-digit Order ID">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-semibold text-gray-400 mb-3 uppercase tracking-wider">Registered Phone Number</label>
                                <input type="tel" id="phone" required
                                       class="w-full bg-[#0f0f11] border border-gray-700 rounded-xl px-5 py-4 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all shadow-inner"
                                       placeholder="+91 99999 xxxxx">
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full mt-4 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-400 hover:to-yellow-500 text-gray-900 font-extrabold text-xl py-5 rounded-xl shadow-[0_0_20px_rgba(234,179,8,0.2)] hover:shadow-[0_0_35px_rgba(234,179,8,0.4)] transition-all transform hover:-translate-y-1">
                            TRACK NOW  →
                        </button>

                        <!-- Simple Mock Result for Demo -->
                        <div x-show="tracking" style="display: none;" class="mt-8 p-6 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-start space-x-5 transform transition-all duration-500">
                            <div class="bg-green-500 rounded-full p-1 mt-1 shadow-[0_0_15px_rgba(34,197,94,0.5)]">
                                <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-green-400 font-bold text-xl mb-2">Order Found!</h4>
                                <p class="text-base text-gray-300 leading-relaxed">Your order <span x-text="orderId" class="font-mono text-yellow-400 font-bold bg-gray-900 px-2 py-1 rounded"></span> is currently being prepared in the kitchen. Expected delivery in <span class="text-white font-bold">25 mins</span>.</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
