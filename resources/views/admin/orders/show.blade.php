<x-admin-layout>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Order Details <span class="text-gray-400 font-normal">#{{ $order->id }}</span></h2>
            <p class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('1 M Y, h:i A') }}</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.slip', $order) }}" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold shadow transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print Slip
            </a>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-medium whitespace-nowrap">← Back to Orders</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">Items Summary</h3>
                
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between pb-4 {{ !$loop->last ? 'border-b border-gray-50 dark:border-gray-700/50' : '' }}">
                        <div class="flex items-center space-x-4">
                            @if($item->product && $item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" alt="product" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                            @else
                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200 dark:border-gray-600 text-xs text-center">No Img</div>
                            @endif
                            <div>
                                <h4 class="font-semibold text-gray-800 dark:text-gray-200">{{ $item->product->name ?? 'Unknown Item' }}</h4>
                                <p class="text-sm text-gray-500">{{ $item->quantity }} x ₹{{ $item->price }}</p>
                            </div>
                        </div>
                        <div class="font-bold text-gray-800 dark:text-white">
                            ₹{{ number_format($item->quantity * $item->price, 2) }}
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-center text-lg">
                    <span class="font-semibold text-gray-600 dark:text-gray-400">Total Amount</span>
                    <span class="font-bold text-xl text-gray-900 dark:text-white">₹{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Sidebar Details -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">Customer Info</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Name</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $order->shipping_name ?? $order->user->name ?? 'Guest' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Phone</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $order->shipping_phone ?? 'N/A' }}</p>
                    </div>
                    @if($order->order_type === 'dine_in')
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Table Number</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ $order->table_no ?? 'N/A' }}</p>
                    </div>
                    @endif
                    <div class="pt-2 mt-2 border-t border-gray-100 dark:border-gray-700">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold">Payment</p>
                        <p class="font-medium text-gray-800 dark:text-gray-200">{{ strtoupper($order->payment_method) }} - 
                            <span class="{{ $order->payment_status === 'paid' ? 'text-green-500' : 'text-yellow-500' }} font-bold">{{ ucfirst($order->payment_status) }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white border-b border-gray-100 dark:border-gray-700 pb-3 mb-4">Order Status</h3>
                
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required {{ $order->status === 'delivered' ? 'disabled' : '' }}>
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                            @if($order->order_type === 'delivery')
                            <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                            @endif
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered / Completed</option>
                        </select>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    
                    @if($order->status === 'delivered')
                        <div class="p-3 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-lg text-sm mb-4">
                            This order is completed and its status is locked.
                        </div>
                    @else
                        <button type="submit" class="w-full bg-gray-900 dark:bg-gray-700 hover:bg-gray-800 dark:hover:bg-gray-600 text-white py-2 rounded-lg font-semibold transition-colors">
                            Update Status
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
