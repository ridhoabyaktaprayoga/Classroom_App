<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="font-bold text-xl text-indigo-600">LMS SMKN 21 Jakarta</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    @if(auth()->user()->isGuru())
                        <a href="{{ route('guru.dashboard') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard Guru
                        </a>
                    @else
                        <a href="{{ route('siswa.dashboard') }}" class="border-indigo-500 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Dashboard Siswa
                        </a>
                    @endif
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="ml-3 relative">
                    <div class="flex items-center">
                        @livewire('notification-bell')
                        <span class="text-gray-700 ml-4 mr-4">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-3 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
