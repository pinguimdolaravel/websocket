<?php

use Filament\Notifications\Notification;
use function Livewire\Volt\{state, computed, rules, on, mount};
use App\Models\ChatMessage;
use App\Models\User;
use App\Events\ChatMessageCreatedEvent;


state(['whoIsHere' => [], 'message']);

$messages = computed(fn() => ChatMessage::query()->oldest()->get());
$users = computed(function () {
    return User::query()->select('id', 'username')->get()->map(fn($u) => (object)[
        'id' => $u->id,
        'username' => $u->username,
        'here' => count(array_filter($this->whoIsHere, fn($i) => $i['id'] == $u->id))
    ]);
});
// --
$save = function () {
    if (empty($this->message)) {
        return;
    }
    auth()->user()->messages()->create(['message' => $this->message]);

    ChatMessageCreatedEvent::dispatch();
    $this->reset('message');

};

$here = fn($whoIsHere) => $this->whoIsHere = $whoIsHere;
$joining = fn($a) => $this->whoIsHere [] = $a;
$leaving = fn($a) => $this->whoIsHere = array_filter($this->whoIsHere, fn($user) => $user['id'] != $a['id']);

on([
    'echo-private:chat,ChatMessageCreatedEvent' => '$refresh',
    "echo-presence:chat,here" => 'here',
    "echo-presence:chat,joining" => 'joining',
    "echo-presence:chat,leaving" => 'leaving',
]);

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

    <x-slot:typing>
        <div x-data="{whoIsTyping: ''}"
             x-cloak
             x-init="
                Echo
                    .private('chat')
                    .listenForWhisper(
                        'typing',
                        (e) => {
                            whoIsTyping = e.username;
                            setTimeout(() => whoIsTyping = '', 3000);
                        }
                    );
             ">
            <div class="px-2 text-slate-400 text-sm italic " x-show="whoIsTyping.length >0">
                <span x-text="whoIsTyping"></span> is typing...
            </div>
        </div>
    </x-slot:typing>

    <x-slot:form>
        <x-chat-textarea
            placeholder="Quer falar algo jetete?!"
            wire:model="message"
            wire:keydown.enter.prevent="save"
            @keydown="Echo.private('chat').whisper('typing', {username: '{{ auth()->user()->username }}'})"
        />
        <x-chat-btn>Manda</x-chat-btn>
    </x-slot:form>
</x-chat>

