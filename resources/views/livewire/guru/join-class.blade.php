<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Join a Class</h2>
            </div>

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(!$joinedClass)
            <div class="mt-8">
                <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Enter Class Code</h3>
                    <form wire:submit.prevent="joinClass">
                        <div class="mb-4">
                            <label for="class_code" class="block text-sm font-medium text-gray-700">Class Code</label>
                            <input wire:model.defer="class_code" type="text" id="class_code" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="ABC123" maxlength="6" style="text-transform: uppercase;">
                            @error('class_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Join Class
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="mt-8">
                <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Class Found</h3>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Class Name:</p>
                        <p class="font-medium">{{ $joinedClass->nama_kelas }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600">Class Code:</p>
                        <p class="font-medium">{{ $joinedClass->class_code }}</p>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('guru.select-subjects', $joinedClass->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Select Subjects
                        </a>
                        <button wire:click="$set('joinedClass', null)" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Try Another Code
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.getElementById('class_code').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});
</script>
