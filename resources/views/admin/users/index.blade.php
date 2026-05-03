<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Registered Users</h2>
    </div>

    <!-- Search -->
    <div class="mb-6 flex">
        <form action="{{ route('admin.users.index') }}" method="GET" class="w-full max-w-md flex">
            <input type="text" name="search" placeholder="Search name or email..." value="{{ request('search') }}" class="w-full rounded-l-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring focus:ring-orange-200">
            <button type="submit" class="bg-gray-800 dark:bg-gray-600 text-white px-4 py-2 rounded-r-md font-semibold hover:bg-gray-700 transition">Search</button>
        </form>
        @if(request('search'))
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-500 hover:text-gray-700 flex items-center">Clear</a>
        @endif
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-sm">
                        <th class="px-6 py-3 font-medium">ID</th>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Joined</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($users as $user)
                    <tr class="text-sm text-gray-700 dark:text-gray-300">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($user->is_blocked)
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Blocked</span>
                            @else
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Active</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.users.toggle-block', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Change block status for this user?');">
                                @csrf
                                <button type="submit" class="{{ $user->is_blocked ? 'text-green-600 hover:text-green-900 dark:text-green-400' : 'text-red-600 hover:text-red-900 dark:text-red-400' }} font-semibold border border-current px-3 py-1 rounded">
                                    {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</x-admin-layout>
