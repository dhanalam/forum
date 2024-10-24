<?php

beforeEach(function () {
    $this->thread = \App\Models\Thread::factory()->create();
});

test('a thread has its url string', function () {
    $this->assertEquals("/threads/{$this->thread->channel->slug}/{$this->thread->id}", $this->thread->path);
});


test('a thread has a creator', function () {
    $this->assertInstanceOf(\App\Models\User::class, $this->thread->creator);
});

test('a thread can have replies', function () {
    $this->assertInstanceOf(\Illuminate\Support\Collection::class, $this->thread->replies);
});

test('a thread can add a reply', function () {
    $this->thread->addReply([
        'body' => 'FooBar',
        'user_id' => 1
    ]);

    $this->assertCount(1, $this->thread->replies);
});

test('a thread belongs to a channel', function () {
    $this->assertInstanceOf(\App\Models\Channel::class, $this->thread->channel);
});
