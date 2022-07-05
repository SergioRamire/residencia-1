@props(['disabled' => false, 'ref' => 'myDatePicker',  'config' => false])

<div>
    <input x-data="{
        value: @entangle($attributes->wire('model')),
        instance: undefined,
        init() {
            $watch('value', value => this.instance.setDate(value, false));
            this.instance = flatpickr({!! $ref !!}, {!! $config ? htmlspecialchars(json_encode($config)) : '{}' !!});
        }
    }"
           type="text"
           id="{{ $ref }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-[#1b396a] focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'])->except(['type']) !!}>
</div>
