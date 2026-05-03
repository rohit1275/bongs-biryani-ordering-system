<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Coupons</h2>
        <a href="{{ route('admin.coupons.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 text-white px-4 py-2 rounded-lg font-semibold shadow hover:shadow-lg transition-all">Add Coupon</a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-sm">
                        <th class="px-6 py-3 font-medium">Code</th>
                        <th class="px-6 py-3 font-medium">Type</th>
                        <th class="px-6 py-3 font-medium">Value</th>
                        <th class="px-6 py-3 font-medium">Usage</th>
                        <th class="px-6 py-3 font-medium">Expiry</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($coupons as $coupon)
                    <tr class="text-sm text-gray-700 dark:text-gray-300">
                        <td class="px-6 py-4 font-bold tracking-wide">{{ $coupon->code }}</td>
                        <td class="px-6 py-4 capitalize">{{ $coupon->type }}</td>
                        <td class="px-6 py-4 font-semibold">
                            {{ $coupon->type === 'percentage' ? $coupon->value . '%' : '₹' . $coupon->value }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $coupon->used_count }} / {{ $coupon->usage_limit ?: '∞' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($coupon->expiry_date)
                                <span class="{{ $coupon->expiry_date < now() ? 'text-red-500' : '' }}">{{ $coupon->expiry_date->format('Y-m-d') }}</span>
                            @else
                                <span class="text-gray-400">Never</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Edit</a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this coupon?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No coupons found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($coupons->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            {{ $coupons->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
