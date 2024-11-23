<input id="{{ $id }}"
       class="rounded-md block w-full mt-1 p-2 text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50{{ $class }}"
       type="{{ $type }}"
       name="{{ $name }}"
       value="{{ $value }}"
    {{ $required ? 'required' : '' }}
    {{ $autofocus ? 'autofocus' : '' }} />
