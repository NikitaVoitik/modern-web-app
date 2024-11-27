<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Edit Election') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800  mb-4">
                        {{ __('Election Information') }}
                    </h3>

                    @include('elections.form', [
                        'action' => route('elections.update', $election->id),
                        'method' => 'PATCH',
                        'election' => $election,
                        'buttonText' => __('Save Changes')
                    ])
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-2 overflow-visible">
                @foreach($election->candidates as $candidate)
                    <a href="{{ route('candidates.show', $candidate->id) }}" class="bg-white  rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <h4 class="text-xl font-semibold text-gray-800 ">
                                {{ $candidate->name }}
                            </h4>
                            <p class="mt-2 text-gray-600 ">
                                <span class="font-medium">Party:</span> {{ $candidate->party }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
