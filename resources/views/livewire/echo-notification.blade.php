<?php

use function Livewire\Volt\{state, on};
use \Filament\Notifications\Notification;

$notifyOthers = function (array $data) {

    if ($data['by'] == auth()->user()->username) {
        return;
    }

    Notification::make()
        ->title($data['message'])
        ->success()
        ->send();

};

$notifyMyself = function (array $data) {

    if ($data['by'] != auth()->user()->username) {
        return;
    }

    Notification::make()
        ->title($data['message'])
        ->success()
        ->send();

};

on([
    'echo-private:app,PostCreatedEvent' => 'notifyOthers',
    'echo-private:app,PostUpdatedEvent' => 'notifyOthers',
    'echo-private:app,DownloadCreatedEvent' => 'notifyMyself',
    'echo-private:app,ChatMessageCreatedEvent' => 'notifyOthers',
]);

?>

<div>

</div>
