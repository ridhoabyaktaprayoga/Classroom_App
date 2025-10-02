<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Forum Diskusi</h1>
                
                <div class="space-y-6">
                    @forelse($discussions as $discussion)
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-indigo-500 text-white rounded-full w-10 h-10 flex items-center justify-center">
                                        {{ strtoupper(substr($discussion->user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $discussion->title }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Oleh {{ $discussion->user->name }} • {{ $discussion->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="text-gray-700 mb-4">
                                {{ $discussion->content }}
                            </div>
                            
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div>
                                    {{ $discussion->replies->count() }} balasan
                                </div>
                                <div>
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                        Balas
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500">Belum ada diskusi.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
