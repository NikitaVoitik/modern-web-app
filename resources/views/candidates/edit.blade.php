<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Candidate') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        {{ __('Candidate Information') }}
                    </h3>

                    @include('candidates.form', [
                        'action' => route('candidates.update', $candidate->id),
                        'method' => 'PATCH',
                        'candidate' => $candidate,
                        'buttonText' => __('Save Changes')
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
