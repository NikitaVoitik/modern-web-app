<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PATCH')
        @method('PATCH')
    @endif

    <!-- Election Date -->
    <div class="mb-6">
        <x-form.label for="election_date" :value="__('Election Date')" class="text-lg font-medium text-gray-800 dark:text-gray-200" />
        <x-form.input id="election_date" class="block mt-2 w-full" type="date" name="election_date" :value="old('election_date', $election->election_date ?? '')" required autofocus />
    </div>

    <div class="flex justify-end mt-6">
        <x-form.button class="ml-4">
            {{ $buttonText }}
        </x-form.button>
    </div>
</form>
