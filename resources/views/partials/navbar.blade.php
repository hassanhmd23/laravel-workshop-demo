<nav class="bg-white shadow-md p-4 flex justify-between border-b border-red-500">
    <h1 class="text-lg font-bold text-red-600">@yield('title')</h1>
    <div class="flex gap-6 items-center">
        <span class="text-gray-700">Welcome, {{ auth()->user()->name }}</span>

        <!-- Notifications Dropdown -->
        <div class="relative">
            <button id="notification-btn" class="relative text-gray-700 hover:text-red-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V10a6 6 0 10-12 0v4c0 .386-.149.757-.405 1.055L4 17h5m6 0a3 3 0 01-6 0"></path>
                </svg>
                <!-- Badge for unread notifications -->
                <span id="notification-badge"
                      class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full px-1 {{ $unreadCount > 0 ? '' : 'hidden' }}">
                    {{ $unreadCount }}
                </span>
            </button>

            <!-- Dropdown -->
            <div id="notification-dropdown"
                 class="hidden absolute right-0 mt-2 w-72 bg-white shadow-lg rounded-lg overflow-hidden border border-red-500">
                <div id="notification-list" class="p-2 space-y-2">
                    @forelse ($notifications as $notification)
                        <div class="p-2 border-b hover:bg-gray-100 cursor-pointer"
                             data-task-id="{{ $notification->data['task_id'] }}"
                             data-notification-id="{{ $notification->id }}">
                            <p class="text-sm">{{ $notification->data['message'] }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm text-center">No new notifications</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-red-600 hover:text-red-700 cursor-pointer">Logout</button>
        </form>
    </div>
</nav>
