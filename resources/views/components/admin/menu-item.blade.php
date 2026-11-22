@props([
    'href' => '#',
    'label' => '',
    'icon' => '',
])

@php
    $isActive = request()->is(trim($href, '/'));
@endphp

<li>
    <a href="{{ url($href) }}"
        @class([
            'flex items-center rounded-lg p-2 text-base font-medium group',
            'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' => $isActive,
            'text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white' => ! $isActive,
        ])>
        <svg @class([
            'h-6 w-6 shrink-0 transition duration-75',
            'text-gray-900 dark:text-white' => $isActive,
            'text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white' => ! $isActive,
        ]) aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
            {!! $icon !!}
        </svg>
        <span class="ml-3 whitespace-nowrap">{{ $label }}</span>
    </a>
</li>
