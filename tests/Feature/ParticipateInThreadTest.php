<?php

use App\Models\Reply;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;

test('unauthenticate user may not add thread replies', function () {
    $thread = Thread::factory()->create();
    $this->post("{$thread->path}/replies", [])
        ->assertRedirect('/login');
});


test('an authenticate user may participate in forum threads', function () {
    signIn();

    $thread = Thread::factory()->create();

    $reply = Reply::factory()->make();
    $this->post("{$thread->path}/replies", $reply->toArray());

    $this->get($thread->path)
        ->assertSee($reply->body);
});


test('a reply requires a body', function () {

    signIn();

    $thread = Thread::factory()->create();

    $reply = Reply::factory()->make(['body' => null]);
    $this->post("{$thread->path}/replies", $reply->toArray())
        ->assertSessionHasErrors('body');
});
