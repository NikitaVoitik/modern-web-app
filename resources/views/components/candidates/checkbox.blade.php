@props(['id'])

<input
    type="checkbox"
    name="candidate_checkbox"
    value="{{ $id }}"
    class="mr-2 rounded-md"
    onclick="handleCheckboxClick(this)"
>
