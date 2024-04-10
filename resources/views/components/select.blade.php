@props([
    'options'
])
<select {{ $attributes->class(['w-full items-center text-left space-x-3 px-4 h-12 bg-white ring-1 ring-slate-900/10 hover:ring-slate-300 focus:outline-none focus:ring-2 focus:ring-sky-500 shadow-sm rounded-lg text-slate-400 dark:bg-slate-800 dark:ring-0 dark:text-slate-300 dark:highlight-white/5 dark:hover:bg-slate-700']) }}>
    @foreach($options as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
</select>
