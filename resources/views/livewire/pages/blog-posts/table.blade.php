<?php

use function Livewire\Volt\{state};

state();

?>

<div class="">
    <x-header>
        Blog Posts
    </x-header>
    <div class="mx-auto max-w-7xl pt-10">
        <div class="w-full flex justify-end mb-5">
            <x-link-button :href="route('blog-posts.create')">
                New BlogPost
            </x-link-button>
        </div>
        <livewire:blog-post.table/>
    </div>
</div>
