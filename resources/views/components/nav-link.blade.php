@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-b-2 border-p_accent-400 dark:border-p_support-600 text-sm font-medium leading-5 text-p_accent-400 dark:text-p_support-100 focus:outline-none focus:border-p_accent-700 hover:text-p_accent-300 hover:bg-p_primary-400 transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-p_support-100 dark:text-p_support-400 hover:text-p_accent-600 dark:hover:text-p_primary-300 hover:border-white hover:bg-p_secondary-300 dark:hover:border-p_primary-700 focus:outline-none focus:text-p_accent-600 dark:focus:text-p_primary-300 focus:border-p_primary-300 dark:focus:border-p_primary-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

