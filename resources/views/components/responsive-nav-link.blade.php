@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full pl-3 pr-4 no-underline text-decoration-none py-2 border-l-4 border-p_secondary-500 dark:border-indigo-600 text-left text-base font-medium text-p_accent-600 dark:text-indigo-300 bg-p_secondary-300 dark:bg-indigo-900/50 focus:outline-none focus:text-p_accent-500 dark:focus:text-indigo-200 focus:bg-p_secondary-200 dark:focus:bg-indigo-900 focus:border-p_secondary-400 dark:focus:border-indigo-300 transition duration-150 ease-in-out hover:text-p_accent-400'
                : 'block w-full pl-3 pr-4 no-underline text-decoration-none py-2 border-l-4 border-transparent text-left text-base font-medium text-p_support-500 dark:text-gray-400 hover:text-p_support-400 dark:hover:text-gray-200 hover:bg-p_secondary-300 dark:hover:bg-gray-700 hover:border-p_secondary-600 dark:hover:border-gray-600 focus:outline-none focus:text-p_support-500 dark:focus:text-gray-200 focus:bg-p_secondary-200 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
