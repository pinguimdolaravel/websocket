<?php

use function Livewire\Volt\{state, mount, on};
use App\Models\BlogPost;

state(['whoIsHere' => [], 'post' => null]);

mount(function (BlogPost $post = null) {
    $this->post = $post;
});


$here = fn($whoIsHere) => $this->whoIsHere = array_filter($whoIsHere, fn($user) => $user['id'] != auth()->id());
$joining = fn($a) => $this->whoIsHere [] = $a;
$leaving = fn($a) => $this->whoIsHere = array_filter($this->whoIsHere, fn($user) => $user['id'] != $a['id']);

on(fn() => [
    "echo-presence:blog.{$this->post?->id},here" => 'here',
    "echo-presence:blog.{$this->post?->id},joining" => 'joining',
    "echo-presence:blog.{$this->post?->id},leaving" => 'leaving',
]);

?>

<div class="">
    <x-header>
        Edit:: {{ $post->title }}
    </x-header>

    <div class="mx-auto max-w-7xl pt-10">
        @if($whoIsHere)
            <x-warning>
                @foreach($whoIsHere as $user)
                    <div>
                        {{ $user['username'] }} tá aqui contigo.. cuidado heim jetete!!!
                    </div>
                @endforeach

            </x-warning>

        @endif

        <livewire:blog-post.edit :record="$post"/>
    </div>
</div>
