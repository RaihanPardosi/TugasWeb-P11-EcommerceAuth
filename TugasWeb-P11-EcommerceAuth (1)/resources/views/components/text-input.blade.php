@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg border-gray-300 text-sm shadow-sm focus:border-amber-700 focus:ring-amber-700 disabled:opacity-60 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500 dark:focus:border-amber-600 dark:focus:ring-amber-600']) }}>
