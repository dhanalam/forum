<?php

beforeEach(function () {

});

test('it has an owner', function () {
    $reply = \App\Models\Reply::factory()->create();
    $this->assertInstanceOf(\App\Models\User::class, $reply->owner);
});
