<x-app-layout>
    <div
        x-data="trackingPage({
            searchUrl: '{{ route('track') }}',
            statusUrlTemplate: '{{ url('/order-status/__ORDER_ID__') }}',
            restaurant: @js($restaurant),
            order: @js($initialOrderData),
            searchedOrderId: @js($searchedOrderId),
            orderNotFound: @js($orderNotFound),
            hasGoogleMapsKey: @js(filled(config('services.google_maps.key'))),
        })"
        x-init="init()"
        class="bg-[#0b0f14] min-h-screen font-inter relative pt-[100px] lg:pt-[120px] pb-16"
    >
        <!-- Not Found / Need Login State -->
        @if(!empty($requiresLogin))
            <section class="flex flex-col items-center min-h-[70vh] px-6 lg:px-20 text-center space-y-8 mt-10">
                <div class="w-full max-w-md bg-[#13141a]/90 backdrop-blur-xl border border-gray-800 rounded-3xl p-8 shadow-2xl">
                    <h2 class="text-3xl font-extrabold text-white font-poppins mb-2">Track Your Order</h2>
                    <p class="mt-3 text-gray-400 mb-6">Sign in to view your live tracking dashboard securely.</p>
                    <a href="{{ route('login') }}" class="mt-6 inline-flex w-full justify-center rounded-xl bg-gradient-to-r from-theme-gold to-theme-orange px-8 py-3.5 text-sm font-extrabold uppercase tracking-widest text-gray-900 transition hover:scale-[1.02]">
                        Sign In
                    </a>
                </div>
            </section>
        @else
        
        <template x-if="orderNotFound || (!hasOrder && searchOrderId === '')">
            <section class="flex flex-col items-center min-h-[70vh] px-6 lg:px-20 mt-10">
                <div class="w-full max-w-lg">
                    <template x-if="orderNotFound">
                        <div class="mb-12 rounded-2xl border border-red-500/20 bg-red-500/10 p-5 shadow-lg text-center">
                            <p class="text-red-400 text-sm font-bold">Order Not Found</p>
                            <p class="text-gray-300 text-xs mt-1 border-t border-red-500/10 pt-2">We couldn't locate order <span class="text-theme-orange" x-text="searchOrderId"></span>.</p>
                        </div>
                    </template>
                    
                    <div class="text-center mt-10 mb-12">
                        <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 text-white font-poppins">Track Order</h1>
                        <p class="text-gray-400 text-lg">Enter your Order ID below to track it live.</p>
                    </div>
                    
                    <form :action="searchUrl" method="GET" class="relative mt-8 group">
                        <input id="order_id" name="order_id" type="text" :value="searchOrderId" required
                            class="w-full rounded-2xl border border-gray-700 bg-[#13141a] px-6 py-5 text-white placeholder-gray-600 focus:border-theme-gold focus:ring-1 focus:ring-theme-gold transition-all shadow-[0_0_20px_rgba(0,0,0,0.3)]"
                            placeholder="e.g. 1045"
                        >
                        <button type="submit" class="absolute right-2 top-2 bottom-2 rounded-xl bg-theme-orange px-8 text-sm font-bold text-white transition-all transform hover:scale-105 active:scale-95 shadow-md">
                            Search
                        </button>
                    </form>
                </div>
            </section>
        </template>

        <!-- Fake Map Segment -->
        <template x-if="hasOrder && order?.order_type === 'delivery'">
            <div class="relative w-full h-[30vh] sm:h-[40vh] bg-[#111318] flex items-center justify-center overflow-hidden">
                <!-- Map Background -->
                <div class="absolute inset-0 bg-gradient-to-tr from-[#161a23] to-[#0b0d12] opacity-90"></div>
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>

                <!-- Path Container (covers 70% of map) -->
                <div class="absolute top-1/2 left-[15%] right-[15%] -translate-y-1/2 h-1.5 z-0">
                    <!-- Background Track -->
                    <div class="absolute w-full h-full bg-gray-800 rounded-full border-t border-b border-dashed border-gray-600/50"></div>
                    
                    <!-- Progress Line (orange) -->
                    <div class="absolute h-full bg-gradient-to-r from-theme-gold to-theme-orange rounded-full transition-all ease-in-out shadow-[0_0_10px_rgba(255,107,0,0.5)] z-0"
                         :style="`width: ${bikePositionPercent}%; transition-duration: ${mapTransitionDuration}ms;`"></div>

                    <!-- Restaurant Marker -->
                    <div class="absolute top-1/2 left-0 -translate-x-1/2 -translate-y-1/2 z-10">
                        <div class="relative w-12 h-12 bg-[#13141a] rounded-full border-2 border-theme-gold shadow-[0_0_15px_rgba(255,107,0,0.2)] flex items-center justify-center text-xl transition hover:scale-110">
                            🍗
                            <span class="absolute -bottom-7 text-[0.6rem] font-extrabold text-gray-500 uppercase tracking-widest whitespace-nowrap bg-[#0b0d12] px-2 py-0.5 rounded-md border border-gray-800">Restaurant</span>
                        </div>
                    </div>

                    <!-- Customer Marker -->
                    <div class="absolute top-1/2 right-0 translate-x-1/2 -translate-y-1/2 z-10">
                        <div class="relative w-12 h-12 bg-[#13141a] rounded-full border-2 border-green-500 shadow-[0_0_15px_rgba(34,197,94,0.2)] flex items-center justify-center text-xl transition hover:scale-110">
                            🏠
                            <span class="absolute -bottom-7 text-[0.6rem] font-extrabold text-gray-500 uppercase tracking-widest whitespace-nowrap bg-[#0b0d12] px-2 py-0.5 rounded-md border border-gray-800">Destination</span>
                            <!-- Confetti Pop on Deliver -->
                            <span class="absolute -top-3 -right-2 text-xl scale-0 transition-transform duration-500" :class="{'scale-100 bounce': order.status === 'delivered'}">🎉</span>
                        </div>
                    </div>

                    <!-- Bike Marker (Absolute to Path Line) -->
                    <div class="absolute top-1/2 -translate-y-1/2 z-20 transition-all ease-in-out flex flex-col items-center ml-[-28px] drop-shadow-2xl"
                         :style="`left: ${bikePositionPercent}%; transition-duration: ${mapTransitionDuration}ms;`">
                        
                        <!-- Tooltip Area -->
                        <div class="absolute -top-10 mb-2 whitespace-nowrap bg-theme-orange text-gray-900 text-[0.65rem] font-bold px-3 py-1 rounded-full shadow-lg border border-white/20 transition-opacity duration-500"
                             :class="order.status === 'out_for_delivery' || order.status === 'delivered' ? 'opacity-100' : 'opacity-0'"
                             x-text="mapTooltipText">
                        </div>

                        <!-- Bike Emoji Block -->
                        <div class="relative w-14 h-14 bg-gradient-to-br from-theme-orange to-theme-gold rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(255,107,0,0.5)] border-2 border-white transition-all duration-300"
                             :class="order.status === 'out_for_delivery' ? 'animate-[bounce_2s_infinite]' : ''">
                             <span class="text-3xl relative z-10 drop-shadow-md transform -scale-x-100" style="display:inline-block">🛵</span>
                        </div>
                        <div class="absolute bottom-[-6px] left-1/2 -translate-x-1/2 w-8 h-1.5 bg-black/60 rounded-[100%] blur-[2px]"></div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Main Tracking Details UI -->
        <template x-if="hasOrder">
            <div class="max-w-4xl mx-auto -mt-10 sm:-mt-16 relative z-20 px-4 lg:px-0 pb-20">
                <div class="bg-[#13141a] sm:border border-gray-800/50 rounded-3xl shadow-2xl overflow-hidden relative">
                    
                    <!-- Order ID Header -->
                    <div class="p-4 sm:p-6 bg-gradient-to-b from-[#1c1a17] to-transparent border-b border-gray-800/50 flex justify-between items-center">
                        <p class="text-[0.7rem] sm:text-xs font-bold text-gray-400 uppercase tracking-widest font-poppins">Order #<span x-text="order.id"></span></p>
                        <p class="text-gray-500 text-[0.7rem] sm:text-xs font-bold uppercase tracking-wider" x-show="order.status === 'delivered'">Delivered at <span class="text-gray-300" x-text="lastUpdatedLabel"></span></p>
                    </div>

                    <!-- Layout Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-[1.2fr_1fr] divide-y md:divide-y-0 md:divide-x divide-gray-800/80">
                        
                        <!-- Col 1: Timeline -->
                        <div class="p-6 sm:p-8 flex flex-col justify-center">
                            
                            <!-- LIVE Status Badge & Text -->
                            <div class="mb-8">
                                <div class="flex items-center gap-2 mb-2" x-show="order.status !== 'delivered'">
                                    <span class="relative flex h-2.5 w-2.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.8)]"></span>
                                    </span>
                                    <span class="text-green-500 font-bold tracking-widest uppercase text-[0.7rem]">Live</span>
                                </div>
                                <h3 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight leading-tight" x-text="heroStatusText"></h3>
                                <p class="text-theme-orange font-bold text-sm mt-2 flex items-center gap-1.5" x-show="order.status !== 'delivered' && order.order_type === 'delivery'">
                                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Arriving in: <span class="text-base" x-text="order.estimated_delivery_time"></span>
                                </p>
                            </div>

                            <!-- Connected Dots Timeline -->
                            <div class="relative flex justify-between items-center w-full mt-4 pb-6">
                                <!-- Background Line (Grey) -->
                                <div class="absolute top-3 left-[12.5%] right-[12.5%] h-1 bg-gray-800 rounded-full z-0"></div>
                                
                                <!-- Active Progress Line (Orange) -->
                                <div class="absolute top-3 left-[12.5%] h-1 bg-gradient-to-r from-theme-gold to-theme-orange rounded-full z-0 transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(255,107,0,0.5)]"
                                     :style="`width: calc(${(activeStepIndex / (steps.length - 1)) * 75}%);`"></div>
                                
                                <template x-for="(step, index) in steps" :key="step.key">
                                    <div class="relative flex flex-col items-center w-1/4 z-10 group">
                                        <!-- Node -->
                                        <div class="w-6 h-6 rounded-full flex items-center justify-center transition-all duration-500 mb-3 border-4 border-[#13141a] box-content relative z-10" :class="stepCircleClass(index)">
                                            <!-- Inner blip for active -->
                                            <div x-show="index === activeStepIndex" class="w-2.5 h-2.5 rounded-full bg-white animate-pulse"></div>
                                        </div>

                                        <!-- Text -->
                                        <div class="text-center absolute top-10 w-24">
                                            <h3 class="font-extrabold text-[0.65rem] sm:text-[0.7rem] uppercase tracking-wider transition-colors" :class="stepTextClass(index)" x-text="step.title"></h3>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="h-16"></div> <!-- spacer for abs positioned text -->
                        </div>

                        <!-- Col 2: Summary & Delivery -->
                        <div class="flex flex-col bg-[#101217]">
                            
                            <!-- Delivery Partner Card -->
                            <div class="p-6 sm:p-8" x-show="(order.status === 'out_for_delivery' || order.status === 'delivered') && order.order_type === 'delivery'">
                                <div class="bg-[#16181f] border border-gray-800/50 rounded-2xl p-4 sm:p-5 flex items-center justify-between shadow-lg hover:shadow-xl transition-shadow duration-300">
                                    <div class="flex items-center gap-4">
                                        <div class="relative w-14 h-14 rounded-full bg-gray-800 overflow-hidden flex-shrink-0 shadow-inner">
                                            <img src="https://ui-avatars.com/api/?name=Deliver+Partner&background=1c1a17&color=facc15&size=128" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="text-lg font-bold text-white leading-tight mb-1" x-text="order.delivery_partner || 'Assigning...'"></p>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider">Delivery Partner</span>
                                                <div class="w-1 h-1 rounded-full bg-gray-600"></div>
                                                <span class="bg-[#101217] text-white text-[0.65rem] px-2 py-0.5 rounded-full flex items-center gap-1 font-bold shadow-sm border border-gray-800"><span class="text-theme-gold">⭐</span> 4.8</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div x-show="order.delivery_partner_phone">
                                        <a :href="'tel:' + order.delivery_partner_phone" class="w-12 h-12 rounded-full bg-green-500/10 border border-green-500/30 flex items-center justify-center text-green-500 transition-all hover:bg-green-500 hover:text-white active:scale-90 shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Summary -->
                            <div class="p-6 sm:p-8 flex-1" :class="order.status === 'out_for_delivery' || order.status === 'delivered' ? 'pt-0' : '' ">
                                <div class="bg-[#16181f] border border-gray-800/50 rounded-2xl p-5 shadow-lg relative overflow-hidden">
                                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 font-poppins">Order Summary Items</h3>
                                    <div class="space-y-4">
                                        <template x-for="item in order.items" :key="item.name + item.quantity">
                                            <div class="flex items-start justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-4 h-4 rounded border border-green-500/50 flex flex-shrink-0 items-center justify-center bg-green-500/10 mt-1">
                                                        <span class="w-2 h-2 rounded-sm bg-green-400"></span>
                                                    </div>
                                                    <div>
                                                        <p class="text-gray-200 font-bold text-sm" x-text="item.name"></p>
                                                        <p class="text-gray-500 text-xs mt-0.5"><span x-text="item.quantity"></span> &times; ₹<span x-text="item.formatted_price"></span></p>
                                                    </div>
                                                </div>
                                                <p class="font-bold text-white whitespace-nowrap text-sm">₹<span x-text="item.line_total"></span></p>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="border-t border-dashed border-gray-700/80 mt-6 pt-5 flex justify-between items-center relative z-10">
                                        <p class="text-gray-400 font-bold text-sm uppercase tracking-wider">Total Paid</p>
                                        <p class="text-2xl font-extrabold text-[#facc15] font-poppins drop-shadow-md">₹<span x-text="order.formatted_total_amount"></span></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </template>
        @endif
    </div>

    <!-- Tracking Mechanics JS -->
    <script>
        function trackingPage(config) {
            return {
                searchUrl: config.searchUrl,
                statusUrlTemplate: config.statusUrlTemplate,
                restaurant: config.restaurant,
                order: config.order,
                searchOrderId: config.searchedOrderId ?? '',
                orderNotFound: Boolean(config.orderNotFound),
                poller: null,
                get steps() {
                    if (this.order?.order_type === 'takeaway') {
                        return [
                            { key: 'placed', title: 'Order Placed', caption: 'We received your order', icon: '📝' },
                            { key: 'preparing', title: 'Preparing', caption: 'Fresh biryani in progress', icon: '🍳' },
                            { key: 'out_for_delivery', title: 'Ready', caption: 'Ready for pickup', icon: '🛍️' },
                            { key: 'delivered', title: 'Completed', caption: 'Enjoy your meal', icon: '🎉' },
                        ];
                    }
                    if (this.order?.order_type === 'dine_in') {
                        return [
                            { key: 'placed', title: 'Order Placed', caption: 'We received your order', icon: '📝' },
                            { key: 'preparing', title: 'Preparing', caption: 'Fresh biryani in progress', icon: '🍳' },
                            { key: 'out_for_delivery', title: 'Ready', caption: 'Food is ready', icon: '🍽️' },
                            { key: 'delivered', title: 'Completed', caption: 'Enjoy your meal', icon: '🎉' },
                        ];
                    }
                    return [
                        { key: 'placed', title: 'Order Placed', caption: 'We received your order', icon: '📝' },
                        { key: 'preparing', title: 'Preparing', caption: 'Fresh biryani in progress', icon: '🍳' },
                        { key: 'out_for_delivery', title: 'On the Way', caption: 'Rider is carrying your food', icon: '🚚' },
                        { key: 'delivered', title: 'Delivered', caption: 'Enjoy your meal', icon: '🎉' },
                    ];
                },

                get heroStatusText() {
                    if (this.order?.order_type === 'takeaway') {
                        const statusMap = {
                            'placed': 'Your takeaway order has been placed 📝',
                            'preparing': 'Your takeaway order is being prepared 🍳',
                            'out_for_delivery': 'Your takeaway order is ready for pickup 🛍️',
                            'delivered': 'Takeaway completed 🎉'
                        };
                        return statusMap[this.order?.status] || 'Processing order...';
                    }
                    if (this.order?.order_type === 'dine_in') {
                        const statusMap = {
                            'placed': 'Your table order has been placed 📝',
                            'preparing': 'Your table order is being prepared 🍳',
                            'out_for_delivery': 'Your food is ready to be served 🍽️',
                            'delivered': 'Order completed 🎉'
                        };
                        return statusMap[this.order?.status] || 'Processing order...';
                    }
                    const statusMap = {
                        'placed': 'Your order has been placed 📝',
                        'preparing': 'Restaurant is preparing your food 🍳',
                        'out_for_delivery': 'Your order is on the way 🚚',
                        'delivered': 'Delivered successfully 🎉'
                    };
                    return statusMap[this.order?.status] || 'Processing order...';
                },

                get bikePositionPercent() {
                    if (!this.order) return 0;
                    if (this.order.status === 'placed') return 0;
                    if (this.order.status === 'preparing') return 10;
                    if (this.order.status === 'out_for_delivery') return 60; // Approaching customer
                    if (this.order.status === 'delivered') return 100;
                    return 0;
                },

                get mapTransitionDuration() {
                    // Control how incredibly slow the transition happens when it updates
                    if (this.order?.status === 'out_for_delivery') return 15000; // 15 seconds
                    return 2000; // 2 sec for others
                },

                get mapTooltipText() {
                    if (this.order?.status === 'out_for_delivery') return 'Arriving soon';
                    if (this.order?.status === 'delivered') return 'Delivered!';
                    return '';
                },

                init() {
                    window.bongsTrackingPage = this;

                    if (this.hasOrder) {
                        if (this.order?.status !== 'delivered') {
                            this.startPolling();
                        } else {
                            if (!localStorage.getItem(`rated_order_${this.order.id}`)) {
                                 setTimeout(() => {
                                     window.dispatchEvent(new CustomEvent('open-rating-modal', { detail: { orderId: this.order.id } }));
                                 }, 1500);
                            }
                        }
                    }

                    window.addEventListener('beforeunload', () => this.stopPolling(), { once: true });
                },

                get hasOrder() {
                    return !!this.order;
                },

                get activeStepIndex() {
                    let currentIndex = this.steps.findIndex((step) => step.key === this.order?.status);
                    if(this.order?.status === 'ready') currentIndex = 1; // Maps 'ready' partially to 'preparing' step
                    return currentIndex === -1 ? 0 : currentIndex;
                },

                get lastUpdatedLabel() {
                    if (!this.order?.updated_at) return 'just now';
                    return new Date(this.order.updated_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                },

                stepCircleClass(index) {
                    const isDelivered = this.order?.status === 'delivered';
                    if (isDelivered) {
                        if (index === this.activeStepIndex) return 'border-theme-gold bg-gradient-to-br from-theme-gold to-theme-orange text-gray-900 shadow-[0_0_20px_rgba(34,197,94,0.6)] scale-110';
                        return 'border-theme-gold bg-gradient-to-br from-theme-gold to-theme-orange text-gray-900 shadow-[0_0_15px_rgba(255,107,0,0.5)]';
                    }
                    
                    if (index < this.activeStepIndex) return 'border-theme-gold bg-gradient-to-br from-theme-gold to-theme-orange text-gray-900 shadow-[0_0_15px_rgba(255,107,0,0.5)]';
                    if (index === this.activeStepIndex) return 'border-theme-orange bg-theme-orange/20 text-theme-orange shadow-[0_0_20px_rgba(255,107,0,0.4)] scale-110';
                    return 'border-gray-800 bg-[#0d0d11] text-gray-600';
                },

                stepTextClass(index) {
                    return index <= this.activeStepIndex || this.order?.status === 'delivered' ? 'text-white' : 'text-gray-500';
                },

                startPolling() {
                    this.stopPolling();
                    this.poller = window.setInterval(() => this.fetchLatestStatus(), 5000);
                },

                stopPolling() {
                    if (this.poller) {
                        window.clearInterval(this.poller);
                        this.poller = null;
                    }
                    if (this.animationInterval) {
                        window.clearInterval(this.animationInterval);
                        this.animationInterval = null;
                    }
                },

                async fetchLatestStatus() {
                    try {
                        const response = await axios.get(this.statusUrlTemplate.replace('__ORDER_ID__', this.order.id));
                        const previousLat = this.order?.lat;
                        const previousLng = this.order?.lng;
                        const previousStatus = this.order?.status;
                        
                        this.order = response.data;

                        // Alpine seamlessly handles reactivity on this.order

                        if (this.order?.status === 'delivered' && !localStorage.getItem(`rated_order_${this.order.id}`)) {
                             setTimeout(() => {
                                 window.dispatchEvent(new CustomEvent('open-rating-modal', { detail: { orderId: this.order.id } }));
                             }, 1000);
                        }

                    } catch (error) {
                        if (error.response?.status === 404) {
                            this.stopPolling();
                            this.order = null;
                            this.orderNotFound = true;
                            this.mapReady = false;
                        }
                    }
                },

                // Removed syncRiderToStatus and map initialization methods
            };
        }
    </script>
</x-app-layout>
