<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <a href="{{ route('guru.kelas.show', $discussion->kelas->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">
                    ← Kembali ke kelas
                </a>

                <!-- Main Discussion -->
                <div class="border-b border-gray-200 pb-6 mb-6">
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

                    <div class="text-gray-700">
                        {{ $discussion->content }}
                    </div>
                </div>

                <!-- Replies -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">{{ $discussion->replies->count() }} Balasan</h4>

                    <div class="space-y-4">
                        @forelse($discussion->replies as $reply)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0">
                                        <div class="bg-indigo-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm">
                                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $reply->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-700 ml-11">{{ $reply->content }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada balasan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Reply Form -->
                <div class="mt-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Tulis Balasan</h4>

                    <form wire:submit="addReply">
                        <div class="mb-4">
                            <textarea
                                wire:model="replyContent"
                                rows="4"
                                class="block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('replyContent') ? 'border-red-500' : 'border-gray-300' }}"
                                placeholder="Tulis balasan Anda di sini...">
                            </textarea>
                            @error('replyContent')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kirim Balasan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
