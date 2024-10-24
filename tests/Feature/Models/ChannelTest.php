<?php

beforeEach(function () {
    $this->channel = \App\Models\Channel::factory()->create();
});

test('a channel has threads', function () {
    $thread = \App\Models\Thread::factory()->create(['channel_id' => $this->channel->id]);

    $this->assertTrue($this->channel->threads->contains($thread));
});
