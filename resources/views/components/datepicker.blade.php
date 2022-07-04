@props(['disabled' => false, 'ref' => 'myDatePicker',  'config' => false])

<div>
    <input type="text" id="{{ $ref }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-sky-800 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'])->except(['type']) !!}>
</div>

<script>
    flatpickr({!! $ref !!}, {!! $config ? json_encode($config) : "{}" !!});
</script>
