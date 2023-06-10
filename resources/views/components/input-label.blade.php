@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-p_support-50 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
