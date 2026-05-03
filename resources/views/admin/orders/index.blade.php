<x-admin-layout>
    <div class="space-y-6">
        <!-- Header & Export -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Orders Management</h2>
            <a href="{{ route('admin.orders.export') }}" class="bg-gradient-to-r from-theme-orange to-theme-gold hover:from-orange-500 hover:to-yellow-500 text-white px-5 py-2.5 rounded-xl font-bold shadow-[0_0_15px_rgba(255,107,0,0.3)] transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export CSV
            </a>
        </div>

        <!-- Order Type Tabs (Premium Pills) -->
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.orders.index', ['order_type' => 'delivery']) }}" class="px-5 py-2.5 rounded-full font-bold transition-all border {{ request('order_type', 'delivery') === 'delivery' ? 'bg-theme-orange/10 border-theme-orange text-theme-orange shadow-[0_0_10px_rgba(255,107,0,0.2)]' : 'bg-[#1a1c23] border-gray-700 text-gray-400 hover:text-white hover:border-gray-500' }}">
                🚚 Delivery Orders
            </a>
            <a href="{{ route('admin.orders.index', ['order_type' => 'takeaway']) }}" class="px-5 py-2.5 rounded-full font-bold transition-all border {{ request('order_type') === 'takeaway' ? 'bg-theme-orange/10 border-theme-orange text-theme-orange shadow-[0_0_10px_rgba(255,107,0,0.2)]' : 'bg-[#1a1c23] border-gray-700 text-gray-400 hover:text-white hover:border-gray-500' }}">
                🛍 Takeaway Orders
            </a>
            <a href="{{ route('admin.orders.index', ['order_type' => 'dine_in']) }}" class="px-5 py-2.5 rounded-full font-bold transition-all border {{ request('order_type') === 'dine_in' ? 'bg-theme-orange/10 border-theme-orange text-theme-orange shadow-[0_0_10px_rgba(255,107,0,0.2)]' : 'bg-[#1a1c23] border-gray-700 text-gray-400 hover:text-white hover:border-gray-500' }}">
                🍽 Dine-In Orders
            </a>
        </div>

        <!-- Status Filter Row -->
        <div class="flex flex-wrap gap-2 items-center bg-[#13141a] p-1 rounded-xl border border-gray-800/50 w-max">
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type')]) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ !request('status') ? 'bg-gray-800 text-white shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">All</a>
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type'), 'status' => 'pending']) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'pending' ? 'bg-yellow-500/20 text-yellow-400 shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">Pending</a>
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type'), 'status' => 'confirmed']) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'confirmed' ? 'bg-blue-500/20 text-blue-400 shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">Confirmed</a>
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type'), 'status' => 'preparing']) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'preparing' ? 'bg-indigo-500/20 text-indigo-400 shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">Preparing</a>
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type'), 'status' => 'out_for_delivery']) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'out_for_delivery' ? 'bg-orange-500/20 text-orange-400 shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">Out for Delivery</a>
            <a href="{{ route('admin.orders.index', ['order_type' => request('order_type'), 'status' => 'delivered']) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold transition-colors {{ request('status') == 'delivered' ? 'bg-green-500/20 text-green-400 shadow-sm' : 'text-gray-400 hover:text-white hover:bg-gray-800/50' }}">Delivered</a>
        </div>

        <!-- Full Width Order Table Card -->
        <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead>
                        <tr class="bg-[#13141a] text-gray-400 text-xs uppercase tracking-wider border-b border-gray-800">
                            <th class="px-6 py-4 font-bold">Order ID</th>
                            <th class="px-6 py-4 font-bold">Date</th>
                            <th class="px-6 py-4 font-bold">Customer</th>
                            <th class="px-6 py-4 font-bold">Order Type</th>
                            <th class="px-6 py-4 font-bold">Total</th>
                            <th class="px-6 py-4 font-bold">Payment Method</th>
                            <th class="px-6 py-4 font-bold">Payment Status</th>
                            <th class="px-6 py-4 font-bold">Current Status</th>
                            <th class="px-6 py-4 font-bold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800 text-sm">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-800/30 transition-colors">
                            <td class="px-6 py-4 font-bold text-white">#{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-400">{{ $order->created_at->format('M d, Y') }}<br><span class="text-xs">{{ $order->created_at->format('h:i A') }}</span></td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-200">{{ $order->shipping_name ?? $order->user->name ?? 'Guest' }}</span><br>
                                <span class="text-xs text-gray-500">{{ $order->shipping_phone ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->order_type === 'delivery')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🚚 Delivery</span>
                                @elseif($order->order_type === 'takeaway')
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🛍 Takeaway</span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🍽 Dine-In <span class="text-gray-500 font-normal">| {{ $order->table_no }}</span></span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-extrabold text-theme-gold">₹{{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 text-gray-300 uppercase text-xs font-bold">{{ $order->payment_method }}</td>
                            <td class="px-6 py-4">
                                @if($order->payment_status === 'paid')
                                    <span class="inline-flex items-center gap-1 text-green-400 text-xs font-bold"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg> Paid</span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-yellow-500 text-xs font-bold"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg> Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                                        'confirmed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                        'preparing' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                                        'out_for_delivery' => 'bg-orange-500/10 text-orange-400 border-orange-500/20',
                                        'delivered' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'bg-gray-800 text-gray-400 border-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $color }}">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="p-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white rounded-lg transition-colors group relative" title="View Order">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.orders.slip', $order) }}" target="_blank" class="p-2 bg-gray-800 hover:bg-gray-700 text-gray-300 hover:text-white rounded-lg transition-colors" title="Print Slip">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-1.5 bg-theme-orange/10 hover:bg-theme-orange/20 text-theme-orange border border-theme-orange/30 rounded-lg text-xs font-bold transition-colors">
                                        Update
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500 font-medium">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                    <p>No orders found matching your criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
            <div class="p-4 border-t border-gray-800 bg-[#13141a]">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
