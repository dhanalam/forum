<?php

use App\Models\User;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Exceptions;

test('guest cannot create thread', function () {
    $this->expectException(AuthenticationException::class);

    $this->withoutExceptionHandling()
        ->post('/threads', Thread::factory()->make()->toArray());

    $this->get('/threads/create')
        ->assertRedirect('/login');
});

test('an authenticated user can create threads', function () {
    signIn();

    // when we  hit the endpoint to create a new thread
    $thread = Thread::factory()->create();
    $response = $this->post('/threads', $thread->toArray());

    // then we visit newly created thread page
    $this->get($response->headers->get('Location'))
        ->assertSee($thread->title)
        ->assertSee($thread->body);
});

test('an authenticated user can see create thread page', function () {
    signIn();

    $this->get('/threads/create')
        ->assertStatus(200);
});


test('a thread requires a title', function () {
    signIn();
    createThread(['title' => null])
        ->assertSessionHasErrors('title');
});


test('a thread requires a body', function () {
    signIn();
    createThread(['body' => null])
        ->assertSessionHasErrors('body');
});

test('a thread requires a valid channel', function () {
    signIn();
    \App\Models\Channel::factory(2)->create();

    createThread(['channel_id' => null])
        ->assertSessionHasErrors('channel_id');

    createThread(['channel_id' => 999])
        ->assertSessionHasErrors('channel_id');
});

