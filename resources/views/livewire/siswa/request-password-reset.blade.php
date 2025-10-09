<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Request Password Reset</h2>
            </div>

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="mt-8">
                <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                    @if($currentRequest)
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Current Request Status</h3>
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">Status:</p>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($currentRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($currentRequest->status === 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($currentRequest->status) }}
                            </span>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">Requested on:</p>
                            <p class="font-medium">{{ $currentRequest->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        @if($currentRequest->status === 'pending')
                            <p class="text-sm text-gray-600">Your request is being reviewed by the admin. Please wait for approval.</p>
                        @elseif($currentRequest->status === 'approved')
                            <p class="text-sm text-green-600">Your password reset has been approved. Check your email for the new password.</p>
                        @else
                            <p class="text-sm text-red-600">Your request was rejected. You can submit a new request below.</p>
                            <button wire:click="requestReset" class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit New Request
                            </button>
                        @endif
                    @else
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Request Password Reset</h3>
                        <p class="text-sm text-gray-600 mb-4">If you've forgotten your password, you can request a reset from the admin. The admin will review and approve your request.</p>
                        <button wire:click="requestReset" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Request Password Reset
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
