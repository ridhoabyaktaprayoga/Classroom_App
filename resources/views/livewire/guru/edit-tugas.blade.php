<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">Edit Tugas</h1>
                    </div>
                    <a href="{{ route('guru.kelas.show', $kelasId) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali
                    </a>
                </div>

                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateTugas">
                    <div class="space-y-6">
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" id="judul" wire:model="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" rows="4" wire:model="deskripsi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                            @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="datetime-local" id="deadline" wire:model="deadline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('deadline') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Tugas
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
