<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="max-w-md mx-auto">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Edit Class</h2>

                    @if (session()->has('message'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('message') }}</span>
                        </div>
                    @endif

                    <form wire:submit.prevent="update">
                        <div class="mb-4">
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                Class Name
                            </label>
                            <input
                                wire:model.defer="nama_kelas"
                                type="text"
                                id="nama_kelas"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_kelas') border-red-500 @enderror"
                                placeholder="Enter class name"
                            >
                            @error('nama_kelas')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea
                                wire:model.defer="deskripsi"
                                id="deskripsi"
                                rows="4"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror"
                                placeholder="Enter class description (optional)"
                            ></textarea>
                            @error('deskripsi')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Class Information</h3>
                            <div class="text-sm text-gray-600">
                                <p><strong>Class Code:</strong> {{ $kelas->class_code }}</p>
                                <p><strong>Created:</strong> {{ $kelas->created_at->format('d M Y H:i') }}</p>
                                <p><strong>Teachers:</strong> {{ $kelas->teachers->count() }}</p>
                                <p><strong>Students:</strong> {{ $kelas->siswa->count() }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.classes') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                Cancel
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Update Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
