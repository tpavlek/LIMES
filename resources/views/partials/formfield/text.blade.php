<label for="{{ $name }}" class="tracking-wide font-bold text-sm text-grey-dark">
    {{ (isset($display_name)) ? strtoupper($display_name) : strtoupper($name) }}
</label>
<input type="text" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder or '' }}" class="my-2 bg-grey-light p-2 rounded w-full" value="{{ (isset($value)) ? $value : old($name) }}"/>
