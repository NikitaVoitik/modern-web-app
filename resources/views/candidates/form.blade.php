<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PATCH')
        @method('PATCH')
    @endif

    <!-- Candidate Name -->
    <div class="mb-6">
        <x-form.label for="name" :value="__('Name')" class="text-lg font-medium text-gray-800 dark:text-gray-200" />
        <x-form.input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name', $candidate->name ?? '')" required autofocus />
    </div>

    <!-- Candidate Party -->
    <div class="mb-6">
        <x-form.label for="party" :value="__('Party')" class="text-lg font-medium text-gray-800 dark:text-gray-200" />
        <x-form.input id="party" class="block mt-2 w-full" type="text" name="party" :value="old('party', $candidate->party ?? '')" required :autofocus="false"/>
    </div>

    <!-- Elections -->
    <div class="mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
            {{ __('Associated Elections') }}
        </h4>
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($elections as $election)
                <label class="block bg-gray-100 dark:bg-gray-700 rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            name="elections[]"
                            value="{{ $election->id }}"
                            {{ isset($candidate) && $candidate->elections->contains($election->id) ? 'checked' : '' }}
                            class="mr-2 rounded-md"
                        >
                        <span class="text-gray-800 dark:text-gray-200 p-2">
                            <b>{{ $election->election_date }} </b> <br>
                            Presidential Elections
                        </span>
                    </div>
                </label>
            @endforeach
        </div>
    </div>

    <div class="flex justify-end mt-6">
        <x-form.button class="ml-4">
            {{ $buttonText }}
        </x-form.button>
    </div>
</form>
