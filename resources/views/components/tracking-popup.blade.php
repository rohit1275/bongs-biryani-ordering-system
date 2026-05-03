<div
    x-cloak
    x-show="activeTracking"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-y-12 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-12 scale-90"
    class="fixed bottom-6 right-4 sm:right-6 z-[110]"
>
    <!-- Subtle glow behind pill -->
    <div class="absolute inset-2 rounded-full bg-theme-orange opacity-40 blur-lg pointer-events-none"></div>

    <!-- Pill Button -->
    <button
        type="button"
        @click="window.location.href = activeTracking.track_url"
        class="group relative flex items-center gap-3 overflow-hidden rounded-full bg-gradient-to-r from-theme-orange to-theme-gold p-1.5 pr-6 shadow-[0_8px_30px_rgba(255,107,0,0.4)] hover:shadow-[0_12px_40px_rgba(255,107,0,0.6)] transition-all duration-300 transform hover:-translate-y-1 active:scale-95 border border-white/20"
    >
        <!-- Icon Circle -->
        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-md relative z-20 group-hover:scale-110 transition-transform duration-300">
            <span class="text-xl group-hover:animate-bounce">🚚</span>
        </div>
        
        <!-- Text -->
        <div class="flex flex-col items-start whitespace-nowrap text-gray-900 relative z-20">
            <p class="text-sm font-extrabold uppercase tracking-widest font-poppins">Track Order</p>
            <p class="text-xs font-bold opacity-80" x-show="activeTracking?.eta">Arriving in <span x-text="activeTracking.eta"></span></p>
            <p class="text-xs font-bold opacity-80" x-show="!activeTracking?.eta">Arriving soon...</p>
        </div>
        
        <!-- Shine effect overlay -->
        <div class="absolute top-0 -left-[100%] w-1/2 h-full bg-white/30 skew-x-[45deg] z-10 transition-transform duration-700 ease-in-out group-hover:translate-x-[300%]"></div>
    </button>
</div>
