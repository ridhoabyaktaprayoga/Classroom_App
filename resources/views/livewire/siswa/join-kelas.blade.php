<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Bergabung ke Kelas</h1>

                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit="joinKelas">
                    <div class="mb-4">
                        <label for="kode_kelas" class="block text-sm font-medium text-gray-700">Kode Kelas</label>
                        <input
                            type="text"
                            id="kode_kelas"
                            wire:model="kode_kelas"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm {{ $errors->has('kode_kelas') ? 'border-red-500' : 'border-gray-300' }}"
                            placeholder="Masukkan kode kelas (6 digit)">
                        @error('kode_kelas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('siswa.dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Gabung Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
