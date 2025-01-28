<div wire:poll.60000ms>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($trends as $trend)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $trend['name'] }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $trend['description'] }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $trend['context'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
