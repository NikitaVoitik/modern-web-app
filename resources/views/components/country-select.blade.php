<div>
    <x-input-label for="country" :value="__('Country')" />
    <select id="country" name="country" class="block mt-1 w-full pt-1 pb-1 rounded-md border" required>
        <option value="">{{ __('Select a country') }}</option>
        @foreach($countries as $country)
            <option value="{{ $country->id }}"
                {{ (isset($user) && $user->country == $country->id) || old('country') == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('country')" class="mt-2" />
</div>
