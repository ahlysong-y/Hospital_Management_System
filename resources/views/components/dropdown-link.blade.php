<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2.5 text-start text-xs font-medium text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800/80 focus:outline-none transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
