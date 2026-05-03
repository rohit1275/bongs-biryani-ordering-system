<!-- resources/views/components/toast-container.blade.php -->
<div class="fixed top-6 right-6 z-[120] flex flex-col space-y-4 pointer-events-none w-80 max-w-full">
    <template x-for="toast in toasts" :key="toast.id">
        <div class="relative bg-theme-dark/95 backdrop-blur-xl border-l-4 rounded-lg shadow-[0_15px_40px_rgba(0,0,0,0.6)] flex items-start p-4 transform transition-all duration-300 pointer-events-auto overflow-hidden group"
             :class="{
                 'border-green-500': toast.type === 'success',
                 'border-red-500': toast.type === 'error'
             }"
             x-transition:enter="translate-x-full opacity-0"
             x-transition:enter-start="translate-x-full opacity-0"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="translate-x-20 opacity-0 relative"
             @mouseover="toast.hovered = true"
             @mouseleave="toast.hovered = false">
            
            <div class="h-8 w-8 rounded-full flex items-center justify-center shrink-0 mt-0.5"
                 :class="{
                     'bg-green-500/10 text-green-500': toast.type === 'success',
                     'bg-red-500/10 text-red-500': toast.type === 'error'
                 }">
                <svg x-show="toast.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <svg x-show="toast.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            
            <div class="ml-3 flex-1 pt-1">
                <p x-show="toast.type === 'success'" class="text-sm font-bold text-gray-100 font-poppins mb-1">Success</p>
                <p x-show="toast.type === 'error'" class="text-sm font-bold text-gray-100 font-poppins mb-1">Error</p>
                <p x-text="toast.message" class="text-sm text-gray-400 font-inter leading-tight"></p>
            </div>

            <!-- Auto-dismiss progress bar illusion -->
             <div class="absolute bottom-0 left-0 h-0.5 bg-gray-700 w-full">
                 <div class="h-full origin-left animate-[shrink_3s_linear_forwards]"
                      :class="{
                          'bg-green-500': toast.type === 'success',
                          'bg-red-500': toast.type === 'error'
                      }"
                      :style="toast.hovered ? 'animation-play-state: paused;' : 'animation-play-state: running;'">
                 </div>
             </div>
             
             <!-- Close button -->
             <button @click="removeToast(toast.id)" class="absolute top-2 right-2 text-gray-500 hover:text-white transition-colors">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
             </button>
        </div>
    </template>
</div>
<style>
    @keyframes shrink {
        from { transform: scaleX(1); }
        to { transform: scaleX(0); }
    }
</style>
