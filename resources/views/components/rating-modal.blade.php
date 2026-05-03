<div
    x-data="{ 
        isOpen: false, 
        ratingValue: 0, 
        ratingReview: '', 
        ratingSubmitting: false, 
        orderId: null,
        openModal(e) { 
            this.orderId = e.detail.orderId;
            if(!localStorage.getItem('rated_order_' + this.orderId)) {
                this.isOpen = true; 
                document.body.style.overflow = 'hidden';
            }
        },
        closeModal() {
            this.isOpen = false;
            document.body.style.overflow = '';
            if(this.orderId) localStorage.setItem('rated_order_' + this.orderId, 'later');
        },
        submitRating() {
            this.ratingSubmitting = true;
            // Simulate API Request
            setTimeout(() => {
                localStorage.setItem('rated_order_' + this.orderId, 'true');
                this.isOpen = false;
                document.body.style.overflow = '';
                this.ratingSubmitting = false;
                window.dispatchEvent(new CustomEvent('bongs-toast', { detail: { message: 'Thank you for your feedback! 🎉', type: 'success' } }));
            }, 800);
        }
    }"
    @open-rating-modal.window="openModal"
    x-show="isOpen"
    x-cloak
    class="fixed inset-0 flex items-center justify-center bg-black/70 backdrop-blur-md p-4 transition-opacity duration-300"
    style="z-index: 9999;"
>
    <!-- Modal Box -->
    <div 
        x-show="isOpen" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
        class="w-full max-w-md rounded-2xl border border-gray-700 bg-[#121317] p-6 sm:p-8 shadow-2xl relative" 
        @click.outside="closeModal"
    >
        <h3 class="text-2xl font-extrabold text-white">Rate your order</h3>
        <p class="mt-2 text-sm text-gray-400">How was your Bongs Biryani experience?</p>

        <div class="mt-6 flex items-center gap-3">
            <template x-for="star in [1,2,3,4,5]" :key="star">
                <button type="button" @click="ratingValue = star" class="text-4xl transition-transform hover:scale-110 active:scale-90 focus:outline-none"
                    :class="ratingValue >= star ? 'text-theme-gold drop-shadow-[0_0_8px_rgba(255,204,0,0.5)]' : 'text-gray-600'">★</button>
            </template>
        </div>

        <textarea
            x-model="ratingReview"
            rows="3"
            class="mt-6 w-full rounded-xl border border-gray-700 bg-[#1a1c23] px-4 py-3 text-sm text-gray-200 focus:border-theme-gold focus:ring-1 focus:ring-theme-gold focus:outline-none transition-colors"
            placeholder="Tell us what you liked (optional)..."
        ></textarea>

        <div class="mt-6 flex gap-4">
            <button type="button" @click="closeModal" class="flex-1 rounded-xl border border-gray-600 bg-transparent px-4 py-3 text-sm font-semibold text-gray-300 hover:bg-gray-800 transition-colors focus:outline-none">
                Later
            </button>
            <button type="button" @click="submitRating" :disabled="ratingSubmitting || ratingValue < 1"
                class="flex-1 rounded-xl bg-gradient-to-r from-theme-orange to-theme-gold px-4 py-3 text-sm font-extrabold uppercase tracking-wider text-gray-900 disabled:opacity-50 transition-transform active:scale-95 focus:outline-none flex justify-center items-center">
                <span x-show="!ratingSubmitting">Submit</span>
                <span x-show="ratingSubmitting" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                    Wait
                </span>
            </button>
        </div>
    </div>
</div>

