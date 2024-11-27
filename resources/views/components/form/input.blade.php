<input id="{{ $id }}"
       class="rounded-md block w-full mt-1 p-2 text-gray-800  bg-gray-100  border border-gray-300  shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50{{ $class }}"
       type="{{ $type }}"
       name="{{ $name }}"
       value="{{ $value }}"
    {{ $required ? 'required' : '' }}
    {{ $autofocus ? 'autofocus' : '' }} />
