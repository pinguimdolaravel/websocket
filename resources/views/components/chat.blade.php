@props([
    'users',
    'messages',
    'form',
    'typing'
])

<div class="flex flex-grow flex-col p-10">
    <div class="bg-transparent rounded-2xl shadow-lg shadow-slate-800 relative flex border-2 border-dashed border-slate-500 flex-grow">
        <div class="bg-slate-950 p-4 w-1/6 rounded-l-2xl border-r-2 border-dashed border-slate-500">
            <ul>
                <li class="text-slate-500 font-bold uppercase text-sm pt-3 mb-3 border-b border-dashed border-slate-500 border-opacity-45 pb-1 ">Super Campeões</li>
                {{ $users }}
            </ul>
        </div>
        <div class="bg-slate-800 w-5/6 rounded-r-2xl flex flex-col">
            <div class="flex-grow overflow-auto h-[100px] py-3">
                {{ $messages }}
            </div>
            {{ $typing }}
            <form class="h-12  flex border-t-2 border-dashed border-slate-500 rounded-br-2xl" wire:submit="save">
                {{ $form }}
            </form>
        </div>
    </div>

</div>
