<div class="relative" x-data="{ open: false }">
    <button 
        @click="open = !open"
        class="p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span class="sr-only">View notifications</span>
        <!-- Bell icon -->
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-400"></span>
        @endif
    </button>

    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50"
        style="display: none;">
        <div class="py-1">
            <div class="flex items-center justify-between px-4 py-3 border-b">
                <h3 class="text-lg font-medium text-gray-900">Notifikasi</h3>
                @if($unreadCount > 0)
                    <button 
                        wire:click="markAllAsRead"
                        class="text-sm text-indigo-600 hover:text-indigo-900">
                        Tandai semua sudah dibaca
                    </button>
                @endif
            </div>
            
            @forelse($allNotifications as $notification)
                <a 
                    href="#" 
                    wire:click.prevent="markAsRead({{ $notification->id }})"
                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 
                        {{ is_null($notification->read_at) ? 'bg-blue-50' : '' }}">
                    <div class="font-medium">{{ $notification->data['title'] }}</div>
                    <div class="mt-1 text-gray-600">{{ $notification->data['message'] }}</div>
                    <div class="mt-1 text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                </a>
            @empty
                <div class="px-4 py-3 text-sm text-gray-700">
                    Tidak ada notifikasi
                </div>
            @endforelse
        </div>
    </div>
</div>
