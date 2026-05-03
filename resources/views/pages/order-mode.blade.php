<x-app-layout>
<div class="min-h-screen bg-[#0a0a0c] pt-24 pb-12 flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-[#13141a]/90 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-gray-800">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-white font-poppins mb-2">Welcome</h1>
            <p class="text-gray-400 font-inter">How would you like to order today?</p>
        </div>

        <form action="{{ route('order-mode.select') }}" method="POST" class="space-y-4">
            @csrf
            
            @if(isset($tableNo))
                <input type="hidden" name="table_no" value="{{ $tableNo }}">
            @endif

            <button type="submit" name="order_type" value="delivery" class="w-full group relative overflow-hidden rounded-2xl bg-gray-800/50 hover:bg-gray-800 p-6 transition-all duration-300 border border-gray-700 hover:border-theme-orange/50 focus:outline-none focus:ring-2 focus:ring-theme-orange shadow-lg hover:shadow-[0_0_20px_rgba(255,107,0,0.2)] text-left">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-theme-gold/20 to-theme-orange/20 border border-theme-gold/30 rounded-full flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                        🚚
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-poppins mb-1 group-hover:text-theme-orange transition-colors">Delivery</h3>
                        <p class="text-sm text-gray-400 font-inter">Delivered right to your doorstep</p>
                    </div>
                </div>
            </button>

            <button type="submit" name="order_type" value="takeaway" class="w-full group relative overflow-hidden rounded-2xl bg-gray-800/50 hover:bg-gray-800 p-6 transition-all duration-300 border border-gray-700 hover:border-theme-orange/50 focus:outline-none focus:ring-2 focus:ring-theme-orange shadow-lg hover:shadow-[0_0_20px_rgba(255,107,0,0.2)] text-left">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-theme-gold/20 to-theme-orange/20 border border-theme-gold/30 rounded-full flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                        🛍
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-poppins mb-1 group-hover:text-theme-orange transition-colors">Takeaway</h3>
                        <p class="text-sm text-gray-400 font-inter">Pick up your food at our counter</p>
                    </div>
                </div>
            </button>

            <button type="submit" name="order_type" value="dine_in" class="w-full group relative overflow-hidden rounded-2xl bg-gray-800/50 hover:bg-gray-800 p-6 transition-all duration-300 border border-gray-700 hover:border-theme-orange/50 focus:outline-none focus:ring-2 focus:ring-theme-orange shadow-lg hover:shadow-[0_0_20px_rgba(255,107,0,0.2)] text-left">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 bg-gradient-to-br from-theme-gold/20 to-theme-orange/20 border border-theme-gold/30 rounded-full flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                        🍽
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white font-poppins mb-1 group-hover:text-theme-orange transition-colors">Dine-In</h3>
                        <p class="text-sm text-gray-400 font-inter">Enjoy your meal at our restaurant</p>
                    </div>
                </div>
            </button>
        </form>

    </div>
</div>
</x-app-layout>
