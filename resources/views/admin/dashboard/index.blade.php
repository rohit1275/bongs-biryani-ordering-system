<x-admin-layout>
    <div class="space-y-6">
        <div class="mb-6">
            <h2 class="text-3xl font-extrabold text-white tracking-tight">Dashboard Overview</h2>
        </div>

        <!-- Stats Top Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Revenue Today (Green) -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-green-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Revenue Today</p>
                        <p class="text-3xl font-extrabold text-white mt-2">₹{{ number_format($totalRevenueToday, 2) }}</p>
                    </div>
                    <div class="p-4 bg-green-500/10 rounded-xl text-green-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Orders Today -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-indigo-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Orders Today</p>
                        <p class="text-3xl font-extrabold text-white mt-2">{{ $totalOrdersToday }}</p>
                    </div>
                    <div class="p-4 bg-indigo-500/10 rounded-xl text-indigo-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Pending Orders (Orange) -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-theme-orange"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Pending Orders</p>
                        <p class="text-3xl font-extrabold text-white mt-2">{{ $pendingOrders }}</p>
                    </div>
                    <div class="p-4 bg-theme-orange/10 rounded-xl text-theme-orange group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Completed Orders (Blue) -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 relative overflow-hidden group">
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Completed Orders</p>
                        <p class="text-3xl font-extrabold text-white mt-2">{{ $completedOrders }}</p>
                    </div>
                    <div class="p-4 bg-blue-500/10 rounded-xl text-blue-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Types Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 flex items-center justify-between hover:bg-gray-800/30 transition-colors">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Delivery Orders</p>
                    <p class="text-3xl font-extrabold text-white mt-2">{{ $deliveryOrders }}</p>
                </div>
                <div class="text-5xl opacity-80">🚚</div>
            </div>
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 flex items-center justify-between hover:bg-gray-800/30 transition-colors">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Takeaway Orders</p>
                    <p class="text-3xl font-extrabold text-white mt-2">{{ $takeawayOrders }}</p>
                </div>
                <div class="text-5xl opacity-80">🛍️</div>
            </div>
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 p-6 flex items-center justify-between hover:bg-gray-800/30 transition-colors">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dine-In Orders</p>
                    <p class="text-3xl font-extrabold text-white mt-2">{{ $dineInOrders }}</p>
                </div>
                <div class="text-5xl opacity-80">🍽️</div>
            </div>
        </div>

        <!-- Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Orders -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-800 bg-[#13141a]">
                    <h3 class="text-lg font-bold text-white uppercase tracking-wider">Recent Orders</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#13141a] text-gray-400 text-xs uppercase tracking-wider border-b border-gray-800">
                                <th class="px-6 py-4 font-bold">Order ID</th>
                                <th class="px-6 py-4 font-bold">Customer</th>
                                <th class="px-6 py-4 font-bold">Type</th>
                                <th class="px-6 py-4 font-bold">Current Status</th>
                                <th class="px-6 py-4 font-bold text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800 text-sm">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-800/30 transition-colors text-white">
                                <td class="px-6 py-4 font-bold">#{{ $order->id }}</td>
                                <td class="px-6 py-4">{{ $order->shipping_name ?? $order->user->name ?? 'Guest' }}</td>
                                <td class="px-6 py-4">
                                    @if($order->order_type === 'delivery')
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🚚</span>
                                    @elseif($order->order_type === 'takeaway')
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🛍</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-lg text-xs font-bold bg-gray-800 text-gray-300 border border-gray-700">🍽</span>
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
                                    <span class="px-3 py-1 rounded-full text-[10px] uppercase font-bold border {{ $color }}">
                                        {{ str_replace('_', ' ', $order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-extrabold text-theme-gold text-right">₹{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No recent orders found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-[#1a1c23] rounded-2xl shadow-xl border border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-800 bg-[#13141a]">
                    <h3 class="text-lg font-bold text-white uppercase tracking-wider">Recent Menu Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead>
                            <tr class="bg-[#13141a] text-gray-400 text-xs uppercase tracking-wider border-b border-gray-800">
                                <th class="px-6 py-4 font-bold">Item</th>
                                <th class="px-6 py-4 font-bold">Price</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800 text-sm">
                            @forelse($topProducts as $item)
                            <tr class="hover:bg-gray-800/30 transition-colors text-white">
                                <td class="px-6 py-4 font-bold">{{ $item->name }}</td>
                                <td class="px-6 py-4 font-extrabold text-theme-gold">₹{{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if($item->is_available)
                                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20">Available</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-red-500/10 text-red-400 border border-red-500/20">Unavailable</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500 font-medium">No products found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
