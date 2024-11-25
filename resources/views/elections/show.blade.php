<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
            </div>

            <x-candidates.list :showVotes="true" :votesMap="$votesMap" :election="$election"/>
        </div>
    </div>
</x-app-layout>
