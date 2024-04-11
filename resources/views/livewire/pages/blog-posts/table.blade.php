<?php

use function Livewire\Volt\{state, on};
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use App\Jobs\ExportBlogPostsJob;

$notifyUser = function ($args) {
    if ($args['by'] === auth()->user()->username) {
        return;
    }

    Notification::make()
        ->title($args['message'])
        ->actions([
            Action::make('Reload Table')
                ->button()
                ->dispatch('reloadTable')
        ])
        ->success()
        ->send();
};

$reloadTable = fn() => $this->redirectRoute('blog-posts');

$download = function () {
    $user = auth()->user();

    ExportBlogPostsJob::dispatch($user->id, $user->username);

    Notification::make()
        ->title('Downloading CSV file... we will notify you when it is ready.')
        ->info()
        ->send();
};

on([
    'reloadTable' => 'reloadTable',
    'echo-private:blog,PostCreatedEvent' => 'notifyUser',
    'echo-private:blog,PostUpdatedEvent' => 'notifyUser',
    'echo-private:app,DownloadCreatedEvent' => 'notifyUser',
]);

?>

<div class="">
    <x-header>
        Blog Posts
    </x-header>
    <div class="mx-auto max-w-7xl pt-10">
        <div class="w-full flex justify-end mb-5">
            <x-secondary-button wire:click="download">
                Download CSV
            </x-secondary-button>
            <x-link-button :href="route('blog-posts.create')">
                New BlogPost
            </x-link-button>
        </div>
        <livewire:blog-post.table/>
    </div>
</div>
