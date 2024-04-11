<?php

declare(strict_types = 1);

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function (User $user) {
    return $user->only('id', 'username');
});

Broadcast::channel('app', function (User $user) {
    return $user->only('id', 'username');
});

Broadcast::channel('blog.{post}', function (User $user, BlogPost $post) {
    return $user->only('id', 'username');
});
