<?php

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;

beforeEach(function () {
    $this->thread = Thread::factory()->create();
});

test('a user can view all threads', function () {
    $this->get('/threads')
        ->assertSee($this->thread->title);
});

test('a user can read a single thread', function () {
    $this->get($this->thread->path)
        ->assertSee($this->thread->title);
});

test('a user can read replies associated with a thread', function () {
    $reply = \App\Models\Reply::factory()->create(['thread_id' => $this->thread->id]);

    $this->get($this->thread->path)
        ->assertSee($reply->body);
});


test('a user can see threads by a channel', function () {
    $channel = Channel::factory()->create();
    $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
    $threadNotInChannel = Thread::factory()->create();

    $this->get('/threads/'.$channel->slug)
        ->assertSee($threadInChannel->title)
        ->assertDontSee($threadNotInChannel->title);
});

test('a user can filter threads by username', function () {
    signIn(User::factory()->create(['name' => 'JohnDoe']));
    $threadByJohn = Thread::factory()->create(['user_id' => auth()->id()]);
    $threadNotByJohn = Thread::factory()->create();

    $this->get('/threads/?by=JohnDoe')
        ->assertSee($threadByJohn->title)
        ->assertDontSee($threadNotByJohn->title);
});


