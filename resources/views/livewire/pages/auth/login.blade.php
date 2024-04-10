<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\{state, computed};
use App\Models\User;

layout('layouts.guest');

state(['user' => 1]);

$users = computed(fn() => User::all());

$login = function () {
    auth()->loginUsingId($this->user);

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
};

?>

<div class="space-y-4">
    <x-select wire:model="user" :options="$this->users"/>

    <x-btn wire:click="login">Login</x-btn>
</div>
