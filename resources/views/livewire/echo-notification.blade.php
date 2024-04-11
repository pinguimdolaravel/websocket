<?php

use function Livewire\Volt\{state, on};
use \Filament\Notifications\Notification;

$notify = function (array $data) {

    if ($data['by'] == auth()->user()->username) {
        return;
    }

    Notification::make()
        ->title($data['message'])
        ->success()
        ->send();

};

on([
    'echo-private:app,PostCreatedEvent' => 'notify',
    'echo-private:app,PostUpdatedEvent' => 'notify'
]);

?>

<div>

</div>
