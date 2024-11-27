<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Create Election') }}
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
                        'action' => route('elections.store'),
                        'method' => 'POST',
                        'election' => null,
                        'buttonText' => __('Save')
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
