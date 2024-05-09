<div x-data="{open: $wire.entangle('modal').live }">
    @if($modal)
        <div> Modal Aberto</div>
    @else
        <div> Modal Fechado</div>
    @endif

    <button @click="$wire.modal = !$wire.modal">
        Toggle Modal
    </button>
</div>
