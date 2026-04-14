<nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-white">PropBook</a>
                <div class="hidden sm:flex gap-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition text-sm {{ request()->routeIs('dashboard') ? 'text-white border-b-2 border-blue-600' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-white transition text-sm {{ request()->routeIs('properties.*') ? 'text-white border-b-2 border-blue-600' : '' }}">
                        Properties
                    </a>
                    <a href="{{ route('calendar') }}" class="text-gray-400 hover:text-white transition text-sm {{ request()->routeIs('calendar') ? 'text-white border-b-2 border-blue-600' : '' }}">
                        Calendar
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-gray-400 text-sm">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition text-sm font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
