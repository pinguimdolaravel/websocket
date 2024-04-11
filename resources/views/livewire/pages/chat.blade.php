<?php

use function Livewire\Volt\{state, computed, rules};
use App\Models\ChatMessage;
use App\Models\User;
use App\Events\ChatMessageCreatedEvent;

$users = computed(fn() => User::all());
$messages = computed(fn() => ChatMessage::query()->oldest()->get());

// --
state(['message']);

$save = function () {
    if (empty($this->message)) {
        return;
    }

    auth()->user()->messages()->create(['message' => $this->message]);

    ChatMessageCreatedEvent::dispatch();
}

?>

<x-chat>
    <x-slot:users>
        @foreach($this->users as $user)
            <x-chat.user :$user/>
        @endforeach
    </x-slot:users>

    <x-slot:messages>
        @foreach($this->messages as $message)
            <x-chat.message :$message/>
        @endforeach

    </x-slot:messages>

    <x-slot:form>
        <x-chat-textarea
            placeholder="Quer falar algo jetete?!"
            wire:model="message"
            wire:keydown.enter.prevent="save"
        />
        <x-chat-btn>Manda</x-chat-btn>
    </x-slot:form>
</x-chat>

