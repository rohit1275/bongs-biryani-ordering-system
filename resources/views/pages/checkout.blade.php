<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="checkout()" x-init="init()">
        <h1 class="text-3xl font-extrabold text-white mb-8 border-b border-gray-800 pb-4">Secure Checkout</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Left col: Address-->
            <div class="space-y-8">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-white mb-4" x-text="orderType === 'delivery' ? 'Delivery Information' : (orderType === 'takeaway' ? 'Takeaway Information' : 'Dine-In Information')">Delivery Information</h2>
                    <form id="checkout-form" @submit.prevent="placeOrder" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Full Name</label>
                                <input type="text" x-model="shippingName" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="John Doe" required>
                            </div>
                            <div x-show="orderType !== 'dine_in'">
                                <label class="block text-sm font-medium text-gray-400 mb-2">Phone Number</label>
                                <input type="tel" x-model="shippingPhone" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="+91 98765 43210" :required="orderType !== 'dine_in'">
                            </div>
                            <div x-show="orderType === 'dine_in'" style="display:none;">
                                <label class="block text-sm font-medium text-gray-400 mb-2">Phone Number (Optional)</label>
                                <input type="tel" x-model="shippingPhone" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="+91 98765 43210">
                            </div>
                        </div>

                        <div x-show="orderType === 'dine_in'" style="display:none;">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Table Number <span class="text-red-500">*</span></label>
                            <input type="text" x-model="tableNo" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="e.g. Table 5" :required="orderType === 'dine_in'">
                        </div>

                        <div x-show="orderType === 'delivery'">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Complete Address</label>
                                <textarea x-model="shippingAddress" rows="3" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Flat No, Building, Street Name..." :required="orderType === 'delivery'"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-400 mb-2">City</label>
                                    <input type="text" x-model="shippingCity" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Kolkata" :required="orderType === 'delivery'">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-400 mb-2">Pincode</label>
                                    <input type="text" x-model="shippingPincode" class="w-full bg-gray-900 border border-gray-700 text-gray-300 rounded-lg p-3 focus:ring-yellow-500 focus:border-yellow-500" placeholder="700001" :required="orderType === 'delivery'">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right col: Summary -->
            <div class="space-y-8">
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl font-bold text-white mb-4">Order Summary</h2>
                    
                    <div class="mb-4 bg-gray-900/50 rounded-xl p-3 border border-gray-700 flex flex-col gap-1">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Order Mode</p>
                        <p class="text-yellow-500 font-bold text-sm">
                            <span x-show="orderType === 'delivery'">🚚 Delivery</span>
                            <span x-show="orderType === 'takeaway'">🛍 Takeaway</span>
                            <span x-show="orderType === 'dine_in'">🍽 Dine-In <span x-show="tableNo" class="text-gray-400 ml-1">| Table: <span x-text="tableNo" class="text-white"></span></span></span>
                        </p>
                    </div>
                    
                    <ul class="divide-y divide-gray-700 mb-6">
                        @php $subtotal = 0; @endphp
                        @foreach($cartItems as $item)
                        @php $subtotal += ($item->product->price * $item->quantity); @endphp
                        <li class="py-3 flex justify-between">
                            <div class="flex items-center">
                                <span class="text-gray-400 text-sm w-6">{{ $item->quantity }}x</span>
                                <span class="text-gray-200">{{ $item->product->name }}</span>
                            </div>
                            <span class="text-gray-300 font-medium">₹{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                        </li>
                        @endforeach
                    </ul>

                    <div class="space-y-3 pt-4 border-t border-gray-700 text-sm">
                        <div class="flex justify-between items-center text-gray-400">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <!-- Discount row injected by alpine if coupon applied -->
                        <div x-show="discount > 0" style="display:none;" class="flex justify-between items-center text-green-400 font-medium">
                            <span>Discount (<span x-text="appliedCoupon"></span>)</span>
                            <span x-text="'-₹' + discount.toFixed(2)"></span>
                        </div>

                        <div class="pt-4 border-t border-gray-700 flex justify-between items-center">
                            <span class="text-lg text-white font-bold">Total</span>
                            <span class="text-2xl font-extrabold text-yellow-400" x-text="'₹' + finalTotal.toFixed(2)"></span>
                        </div>
                    </div>
                </div>

                <!-- Coupon -->
                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Apply Promo Code</h2>
                    <div class="flex space-x-3">
                        <input type="text" x-model="couponInput" class="flex-1 bg-gray-900 border border-gray-700 text-gray-300 rounded-lg px-4 py-2 uppercase placeholder-gray-500 focus:ring-yellow-500 focus:border-yellow-500" placeholder="e.g. WELCOME10" :disabled="appliedCoupon !== null">
                        <button type="button" @click="applyCoupon" :disabled="appliedCoupon !== null || !couponInput" class="bg-gray-700 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded-lg transition-colors disabled:opacity-50">Apply</button>
                    </div>
                    <p x-show="couponMessage" x-text="couponMessage" class="mt-2 text-sm" :class="couponError ? 'text-red-400' : 'text-green-400'"></p>
                    <button x-show="appliedCoupon !== null" @click="removeCoupon" class="mt-2 text-sm text-red-500 hover:text-red-400">Remove coupon</button>
                </div>

                <div class="bg-gray-800 border border-gray-700 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-lg font-bold text-white mb-4">Payment Method</h2>
                    <div class="space-y-3 text-sm">
                        <label x-show="orderType === 'delivery'" class="flex items-center gap-3 rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 cursor-pointer">
                            <input type="radio" value="cod" x-model="paymentMethod" class="text-yellow-500 focus:ring-yellow-500">
                            <span class="font-semibold text-gray-200">Cash on Delivery</span>
                        </label>
                        <label x-show="orderType !== 'delivery'" style="display:none;" class="flex items-center gap-3 rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 cursor-pointer">
                            <input type="radio" value="counter" x-model="paymentMethod" class="text-yellow-500 focus:ring-yellow-500">
                            <span class="font-semibold text-gray-200">Pay at Counter</span>
                        </label>
                        <label class="flex items-center gap-3 rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 cursor-pointer">
                            <input type="radio" value="upi" x-model="paymentMethod" class="text-yellow-500 focus:ring-yellow-500">
                            <span class="font-semibold text-gray-200">UPI</span>
                        </label>
                        <label class="flex items-center gap-3 rounded-xl border border-gray-700 bg-gray-900 px-4 py-3 cursor-pointer">
                            <input type="radio" value="card" x-model="paymentMethod" class="text-yellow-500 focus:ring-yellow-500">
                            <span class="font-semibold text-gray-200">Card (Razorpay)</span>
                        </label>
                    </div>
                </div>

                <button @click="placeOrder" :disabled="isPlacing" class="w-full py-4 bg-gradient-to-r from-theme-orange to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-extrabold rounded-xl shadow-[0_0_20px_rgba(255,107,0,0.4)] transition-all text-lg flex justify-center items-center gap-2 disabled:opacity-75">
                    <span x-show="!isPlacing">Confirm & Pay</span>
                    <span x-show="isPlacing">Processing...</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkout', () => ({
                orderType: '{{ $orderType }}',
                tableNo: '{{ $tableNo }}',
                subtotal: {{ $subtotal }},
                shippingName: '',
                shippingPhone: '',
                shippingAddress: '',
                shippingCity: '',
                shippingPincode: '',
                lat: null,
                lng: null,
                couponInput: '',
                appliedCoupon: null,
                discount: 0,
                couponMessage: '',
                couponError: false,
                isPlacing: false,
                paymentMethod: '{{ $orderType === "delivery" ? "cod" : "counter" }}',

                init() {
                    if (!navigator.geolocation) {
                        return;
                    }

                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            this.lat = position.coords.latitude;
                            this.lng = position.coords.longitude;
                        },
                        () => {}
                    );
                },

                get finalTotal() {
                    return Math.max(0, this.subtotal - this.discount);
                },

                async applyCoupon() {
                    this.couponMessage = 'Applying...';
                    this.couponError = false;
                    try {
                        const res = await axios.post('/checkout/coupon', { code: this.couponInput.toUpperCase() });
                        if (res.data.success) {
                            this.appliedCoupon = this.couponInput.toUpperCase();
                            if (res.data.type === 'fixed') {
                                this.discount = parseFloat(res.data.value);
                            } else {
                                this.discount = this.subtotal * (parseFloat(res.data.value) / 100);
                            }
                            this.couponMessage = res.data.message;
                        } else {
                            this.couponError = true;
                            this.couponMessage = res.data.message;
                        }
                    } catch (e) {
                        this.couponError = true;
                        this.couponMessage = "Invalid request.";
                    }
                },

                removeCoupon() {
                    this.appliedCoupon = null;
                    this.discount = 0;
                    this.couponInput = '';
                    this.couponMessage = '';
                },

                    async placeOrder() {
                        if (!this.paymentMethod) {
                            window.dispatchEvent(new CustomEvent('bongs-toast', { detail: { message: 'Please select a payment method', type: 'error' } }));
                            return;
                        }
                        if (!this.shippingName.trim()) {
                            alert("Name is required.");
                            return;
                        }
                        if (this.orderType === 'dine_in' && !this.tableNo.trim()) {
                            alert("Table Number is required for Dine-in orders.");
                            return;
                        }
                        if (this.orderType !== 'dine_in' && !this.shippingPhone.trim()) {
                            alert("Phone number is required.");
                            return;
                        }
                        if (this.orderType === 'delivery') {
                            if (!this.shippingAddress.trim() || !this.shippingCity.trim() || !this.shippingPincode.trim()) {
                                alert("All delivery information fields are required.");
                                return;
                            }
                        }
                        
                        this.isPlacing = true;
                        try {
                            const res = await axios.post('/checkout', {
                                shipping_name: this.shippingName,
                                shipping_phone: this.shippingPhone,
                                shipping_address: this.shippingAddress,
                                shipping_city: this.shippingCity,
                                shipping_pincode: this.shippingPincode,
                                table_no: this.tableNo,
                                coupon_code: this.appliedCoupon,
                                payment_method: this.paymentMethod,
                                lat: this.lat,
                                lng: this.lng,
                            });
                        if (res.data.success) {
                            if (res.data.requires_razorpay) {
                                this.initRazorpay(res.data);
                            } else {
                                window.dispatchEvent(new CustomEvent('cart-cleared')); 
                                window.dispatchEvent(new CustomEvent('bongs-toast', {
                                    detail: { message: 'Order placed successfully', type: 'success' }
                                }));
                                setTimeout(() => {
                                    window.location.href = res.data.redirect;
                                }, 1000);
                            }
                        } else {
                            alert(res.data.message);
                            this.isPlacing = false;
                        }
                    } catch (e) {
                        alert("An error occurred during checkout.");
                        this.isPlacing = false;
                    }
                },

                async initRazorpay(data) {
                    try {
                        const options = {
                            key: data.key,
                            amount: data.amount,
                            currency: "INR",
                            name: "Bongs Biryani",
                            description: "Payment for Order",
                            order_id: data.razorpay_order_id,
                            handler: async (response) => {
                                try {
                                    const verifyReq = await axios.post('/razorpay/verify', {
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_signature: response.razorpay_signature
                                    });
                                    if (verifyReq.data.success) {
                                        window.dispatchEvent(new CustomEvent('cart-cleared')); 
                                        window.dispatchEvent(new CustomEvent('bongs-toast', {
                                            detail: { message: 'Order placed successfully!', type: 'success' }
                                        }));
                                        setTimeout(() => {
                                            window.location.href = verifyReq.data.redirect;
                                        }, 1000);
                                    } else {
                                        alert("Payment verification failed. " + verifyReq.data.message);
                                        this.isPlacing = false;
                                    }
                                } catch (e) {
                                    alert("Error during verification.");
                                    this.isPlacing = false;
                                }
                            },
                            theme: {
                                color: "#f59e0b"
                            },
                            modal: {
                                ondismiss: () => {
                                    this.isPlacing = false;
                                    window.dispatchEvent(new CustomEvent('bongs-toast', {
                                        detail: { message: 'Payment not completed', type: 'error' }
                                    }));
                                }
                            }
                        };
                        const rzp = new window.Razorpay(options);
                        rzp.on('payment.failed', (response) => {
                            this.isPlacing = false;
                            window.dispatchEvent(new CustomEvent('bongs-toast', {
                                detail: { message: 'Payment failed: ' + response.error.description, type: 'error' }
                            }));
                        });
                        rzp.open();
                    } catch (e) {
                        alert("Could not initialize Razorpay.");
                        this.isPlacing = false;
                    }
                }
            }));
        });
    </script>
</x-app-layout>
