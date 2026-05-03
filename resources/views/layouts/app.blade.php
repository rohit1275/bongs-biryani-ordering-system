<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bongs Biryani Gurgaon | Kolkata Style Biryani & Rolls</title>
    <meta name="description" content="Order authentic Kolkata-style biryani, rolls, and Chinese food from Bongs Biryani in Gurgaon. Available on Swiggy & Zomato.">
    <meta name="keywords" content="biryani gurgaon, kolkata biryani gurgaon, rolls gurgaon, swiggy biryani gurgaon">
    
    <!-- Open Graph Tags -->
    <meta property="og:title" content="Bongs Biryani Gurgaon | Kolkata Style Biryani & Rolls">
    <meta property="og:description" content="Order authentic Kolkata-style biryani, rolls, and Chinese food from Bongs Biryani in Gurgaon. Available on Swiggy & Zomato.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=1200&q=80">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Outfit:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 text-gray-200 antialiased font-sans" x-data="cart()" x-init="initCart()">
    <div class="min-h-screen flex flex-col font-inter">
        
        <!-- Navigation Component -->
        <x-navbar />

        <!-- Cart Drawer Component -->
        <x-cart-drawer />


        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <x-footer />

        <!-- Toast Notifications overlay -->
        <x-toast-container />
        <x-tracking-popup />
        <x-rating-modal />
    </div>

    <!-- Global Reveal Script -->
    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('bongs-toast', { detail: { message: "{{ session('success') }}", type: 'success' } }));
            }, 100);
        });
    </script>
    @endif
    
    @if($errors->any())
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.dispatchEvent(new CustomEvent('bongs-toast', { detail: { message: "{{ $errors->first() }}", type: 'error' } }));
            }, 100);
        });
    </script>
    @endif
    
    <!-- Centralized Cart Logic via Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cart', () => ({
                items: [],
                isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
                toasts: [],
                toastId: 0,
                isCartOpen: false,
                loadingCart: false,
                couponInput: '',
                couponMessage: '',
                couponError: false,
                discount: 0,
                appliedCoupon: null,
                activeTracking: null,
                trackingPoller: null,
                ratingModalOpen: false,
                ratingOrder: null,
                ratingValue: 0,
                ratingReview: '',
                ratingSubmitting: false,
                submittedRatingOrderIds: [],
                
                get totalItems() {
                    return this.items.reduce((sum, item) => sum + parseInt(item.quantity), 0);
                },

                get subtotal() {
                    return this.items.reduce((sum, item) => sum + (item.product.price * item.quantity), 0);
                },

                get totalAfterDiscount() {
                    return Math.max(0, this.subtotal - this.discount);
                },

                initCart() {
                    if (this.isLoggedIn) {
                        this.syncGuestCart();
                        this.loadSubmittedRatings();
                        this.startTrackingPoller();
                    } else {
                        this.items = this.normalizeGuestItems(JSON.parse(localStorage.getItem('cart')) || []);
                    }

                    window.addEventListener('bongs-toast', (event) => {
                        const detail = event?.detail ?? {};
                        this.addToast(detail.message || 'Notification', detail.type || 'success');
                    });
                    window.addEventListener('cart-cleared', () => {
                        this.items = [];
                        localStorage.removeItem('cart');
                    });
                },

                async syncGuestCart() {
                    let localCart = JSON.parse(localStorage.getItem('cart')) || [];
                    
                    if (localCart.length > 0) {
                        try {
                            await axios.post('/api/cart/sync', { cart: localCart });
                            localStorage.removeItem('cart');
                            this.fetchDBCart();
                            this.addToast('Welcome back! Cart synced.', 'success');
                        } catch (e) {
                            console.error('Cart sync error:', e);
                            this.fetchDBCart();
                        }
                    } else {
                        this.fetchDBCart();
                    }
                },

                async fetchDBCart() {
                    this.loadingCart = true;
                    try {
                        const response = await axios.get('/api/cart');
                        this.items = response.data.items;
                    } catch (e) {
                        console.error('Fetch cart error', e);
                    } finally {
                        this.loadingCart = false;
                    }
                },

                async addToCart(product) {
                    if (this.isLoggedIn) {
                        try {
                            await axios.post('/api/cart/add', { product_id: product.id });
                            this.fetchDBCart();
                            this.addToast(product.name + ' added to cart', 'success');
                            this.isCartOpen = true; // Open drawer
                        } catch (e) {
                            this.addToast('Error adding to cart', 'error');
                        }
                    } else {
                        let existing = this.items.find(i => i.product_id === product.id);
                        if (existing) {
                            existing.quantity++;
                        } else {
                            this.items.push({
                                product_id: product.id,
                                name: product.name,
                                price: Number(product.price),
                                image: product.image ?? null,
                                quantity: 1,
                            });
                        }
                        this.items = this.normalizeGuestItems(this.items);
                        this.saveLocalCart();
                        this.addToast(product.name + ' added to cart', 'success');
                        this.isCartOpen = true; // Open drawer
                    }
                },

                async updateQuantity(cartItem, newQty) {
                    if (newQty < 1) return;
                    
                    if (this.isLoggedIn) {
                        try {
                            await axios.post('/api/cart/update', { item_id: cartItem.id, quantity: newQty });
                            this.fetchDBCart();
                        } catch (e) {
                           console.error(e);
                        }
                    } else {
                        let target = this.items.find(i => i.product_id === cartItem.product.id);
                        if (target) {
                            target.quantity = newQty;
                            this.items = this.normalizeGuestItems(this.items);
                            this.saveLocalCart();
                        }
                    }
                },

                async removeItem(cartItem) {
                    if (this.isLoggedIn) {
                        try {
                            await axios.post('/api/cart/remove', { item_id: cartItem.id });
                            this.fetchDBCart();
                            this.addToast('Item removed', 'success');
                        } catch (e) {
                           console.error(e);
                        }
                    } else {
                        this.items = this.items.filter(i => i.product_id !== cartItem.product.id);
                        this.saveLocalCart();
                        this.addToast('Item removed', 'success');
                    }
                },

                saveLocalCart() {
                    const flat = this.items.map((item) => ({
                        product_id: item.product_id ?? item.product.id,
                        name: item.name ?? item.product.name,
                        price: Number(item.price ?? item.product.price),
                        quantity: Number(item.quantity),
                        image: item.image ?? item.product.image ?? null,
                    }));
                    localStorage.setItem('cart', JSON.stringify(flat));
                },

                normalizeGuestItems(items) {
                    return (items || []).map((item) => {
                        const product = item.product ?? {
                            id: item.product_id,
                            name: item.name,
                            price: Number(item.price),
                            image: item.image ?? null,
                        };
                        return {
                            product_id: item.product_id ?? product.id,
                            name: item.name ?? product.name,
                            price: Number(item.price ?? product.price),
                            image: item.image ?? product.image ?? null,
                            quantity: Number(item.quantity ?? 1),
                            product,
                        };
                    });
                },

                async applyCouponOnCart() {
                    if (!this.couponInput) return;
                    this.couponMessage = 'Applying...';
                    this.couponError = false;
                    try {
                        const res = await axios.post('/checkout/coupon', { code: this.couponInput.toUpperCase() });
                        if (res.data.success) {
                            this.appliedCoupon = this.couponInput.toUpperCase();
                            this.discount = res.data.type === 'fixed'
                                ? Number(res.data.value)
                                : this.subtotal * (Number(res.data.value) / 100);
                            this.couponMessage = res.data.message;
                            this.addToast('Coupon applied', 'success');
                        } else {
                            this.couponError = true;
                            this.couponMessage = res.data.message;
                        }
                    } catch (e) {
                        this.couponError = true;
                        this.couponMessage = 'Could not apply coupon';
                    }
                },

                proceedToCheckout() {
                    if (!this.isLoggedIn) {
                        this.addToast('Please login to continue', 'error');
                        window.location.href = "{{ route('login') }}";
                        return;
                    }
                    window.location.href = "{{ route('checkout.index') }}";
                },

                startTrackingPoller() {
                    this.fetchActiveTracking();
                    this.trackingPoller = window.setInterval(() => this.fetchActiveTracking(), 5000);
                },

                async fetchActiveTracking() {
                    if (!this.isLoggedIn) return;
                    try {
                        const response = await axios.get("{{ route('orders.active-tracking') }}");
                        if (response.data?.active) {
                            this.activeTracking = response.data;
                        } else {
                            if (this.activeTracking?.status === 'out_for_delivery') {
                                this.addToast('Delivered! Please rate your order.', 'success');
                            }
                            this.activeTracking = null;
                        }

                        await this.checkDeliveredOrderForRating();
                    } catch (error) {
                        // silent
                    }
                },

                async checkDeliveredOrderForRating() {
                    try {
                        const res = await axios.get("{{ route('orders.delivered-pending-rating') }}");
                        if (!res.data?.pending) return;
                        const orderId = Number(res.data.order_id);
                        if (this.submittedRatingOrderIds.includes(orderId)) return;
                        if (!this.ratingModalOpen) {
                            this.ratingOrder = { id: orderId };
                            this.ratingModalOpen = true;
                        }
                    } catch (error) {
                        // ignore
                    }
                },

                loadSubmittedRatings() {
                    this.submittedRatingOrderIds = JSON.parse(localStorage.getItem('submitted_order_ratings') || '[]');
                },

                saveSubmittedRatings() {
                    localStorage.setItem('submitted_order_ratings', JSON.stringify(this.submittedRatingOrderIds));
                },

                openRating(orderId) {
                    this.ratingOrder = { id: orderId };
                    this.ratingValue = 0;
                    this.ratingReview = '';
                    this.ratingModalOpen = true;
                },

                async submitRating() {
                    if (!this.ratingOrder?.id || this.ratingValue < 1) return;
                    this.ratingSubmitting = true;
                    try {
                        await axios.post(`/orders/${this.ratingOrder.id}/rating`, {
                            rating: this.ratingValue,
                            review: this.ratingReview,
                        });
                        this.ratingSubmitting = false;
                        this.ratingModalOpen = false;
                        this.submittedRatingOrderIds.push(this.ratingOrder.id);
                        this.saveSubmittedRatings();
                        this.addToast('Rating submitted', 'success');
                    } catch (error) {
                        this.ratingSubmitting = false;
                        this.addToast('Could not submit rating', 'error');
                    }
                },

                addToast(message, type = 'success') {
                    const id = this.toastId++;
                    this.toasts.push({ id, message, type, hovered: false });
                    
                    const dismiss = () => {
                        let t = this.toasts.find(t => t.id === id);
                        if (t && t.hovered) {
                            setTimeout(dismiss, 1000); // Check again if hovered
                        } else {
                            this.removeToast(id);
                        }
                    };
                    setTimeout(dismiss, 3000);
                },
                removeToast(id) {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }
            }));
        });
    </script>
</body>
</html>
