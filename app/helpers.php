<?php

function isOnTesting(): bool
{
    return app()->environment() === 'testing';
}
