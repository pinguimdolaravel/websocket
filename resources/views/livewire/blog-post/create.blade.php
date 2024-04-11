<div>
    <form wire:submit="create" class="space-y-4">
        {{ $this->form }}

        <div class="flex items-center justify-between">
            <x-link-button :href="route('blog-posts')">Cancel</x-link-button>
            <x-primary-button type="submit">
                Submit
            </x-primary-button>
        </div>
    </form>

    <x-filament-actions::modals/>
</div>
