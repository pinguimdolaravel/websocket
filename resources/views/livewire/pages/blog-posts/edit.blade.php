<?php

use function Livewire\Volt\{state, mount, on};
use App\Models\BlogPost;

state(['whoIsHere' => [], 'post' => null]);

mount(function (BlogPost $post = null) {
    $this->post = $post;
});


?>

<div class="">
    <x-header>
        Edit:: {{ $post->title }}
    </x-header>

    <div class="mx-auto max-w-7xl pt-10">
        {{-- // Warning --}}

        <livewire:blog-post.edit :record="$post"/>
    </div>
</div>
