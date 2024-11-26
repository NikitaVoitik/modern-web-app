<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidate Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {!! $candidate->name !!}
                        </h3>
                        <p class="mt-2 text-lg text-gray-600">
                            Party: {{ $candidate->party }}
                        </p>
                    </div>
                    <x-form.edit-delete :editRoute="route('candidates.edit', $candidate->id)"
                                        :deleteRoute="route('candidates.destroy', $candidate->id)"/>
                </div>
            </div>

            <div class="mt-6">
                <h4 class="text-xl font-semibold text-gray-800">
                    Associated Elections
                </h4>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($candidate->elections as $election)
                        <a href="{{ route('elections.show', $election->id) }}" class="bg-gray-100 rounded-lg shadow p-4">
                            <h5 class="font-medium text-gray-800">
                                Election: {{ $election->id }} - Presidential
                            </h5>
                            <p class="text-sm text-gray-500">
                                Date: {{ $election->election_date }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
