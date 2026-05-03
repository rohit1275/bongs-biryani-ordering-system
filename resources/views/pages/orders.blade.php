<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-extrabold text-white mb-8 border-b border-gray-800 pb-4">My Orders</h1>
        
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-400 p-4 rounded-lg mb-8">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="bg-gray-800 border border-gray-700 rounded-2xl p-12 text-center text-gray-400">
                <svg class="mx-auto h-16 w-16 mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <p class="text-xl">You have no past orders.</p>
                <a href="{{ route('menu') }}" class="mt-4 text-yellow-500 hover:text-yellow-400 font-medium inline-block">Order our Biryani</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-sm">
                    <!-- Header -->
                    <div class="bg-gray-900/50 p-4 sm:p-6 border-b border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex grid grid-cols-2 sm:flex sm:space-x-12 gap-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Order placed</p>
                                <p class="text-gray-300">{{ $order->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Total</p>
                                <p class="text-gray-300 font-bold">₹{{ number_format($order->total_amount, 2) }}</p>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">Order #</p>
                                <p class="text-gray-300 font-mono">{{ $order->id }}</p>
                            </div>
                        </div>
                        <div>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-500/20 text-yellow-400',
                                    'confirmed' => 'bg-blue-500/20 text-blue-400',
                                    'preparing' => 'bg-indigo-500/20 text-indigo-400',
                                    'out_for_delivery' => 'bg-orange-500/20 text-orange-400',
                                    'delivered' => 'bg-green-500/20 text-green-400',
                                ];
                                $color = $statusColors[$order->status] ?? 'bg-gray-500/20 text-gray-400';
                            @endphp
                            <span class="{{ $color }} px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                                {{ str_replace('_', ' ', $order->status) }}
                            </span>
                            <a href="{{ route('track.show', $order->id) }}" class="ml-3 inline-flex items-center rounded-full border border-yellow-500/30 bg-yellow-500/10 px-3 py-1 text-xs font-bold uppercase tracking-wide text-yellow-300 transition hover:bg-yellow-500/20">
                                Track Live
                            </a>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="p-6">
                        <ul class="space-y-4">
                            @foreach($order->orderItems as $item)
                                <li class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-gray-700 rounded-lg overflow-hidden border border-gray-600 flex-shrink-0">
                                        @if($item->product->image)
                                            <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-200 truncate">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} • ₹{{ $item->price }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-yellow-400 border border-gray-700 px-3 py-1 rounded-lg bg-gray-900/30">₹{{ number_format($item->quantity * $item->price, 2) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
