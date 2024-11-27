<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Election Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Election Card -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg shadow-lg">
                <div class="p-8">
                    <h3 class="text-2xl font-bold">
                        Election: {{ $election->id }}
                    </h3>
                    <p class="mt-4">
                        Type: Presidential Election
                    </p>
                    <p class="mt-4">
                        <span class="font-medium">Date:</span> {{ $election->election_date }}
                    </p>
                    <x-form.edit-delete :editRoute="route('elections.edit', $election->id)"
                                        :deleteRoute="route('elections.destroy', $election->id)"/>
                </div>
                <div class="alert alert-danger text-red-600 p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Candidates Section -->
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-2 overflow-visible">
                @foreach($election->candidates as $candidate)
                    <a href="{{ route('candidates.show', $candidate->id) }}"
                       class="rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300
                  {{ $candidate->id === $votedFor ? 'bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg shadow-lg text-white' : 'bg-white text-gray-600' }}">
                        <div class="p-4">
                            <h4 class="text-xl font-semibold {{ $candidate->id === $votedFor ? 'text-white' : 'text-gray-800' }} text-nowrap overflow-ellipsis overflow-hidden">
                                {{ $candidate->name }}
                            </h4>
                            <p class="mt-2">
                                <span class="font-medium">Party:</span> {{ $candidate->party }}

                            <br>
                                <span class="font-medium">Votes:</span>  {{ $votesMap[$candidate->id] ?? 0 }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
