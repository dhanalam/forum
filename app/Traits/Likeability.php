<?php

namespace App\Traits;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Likeability
{

    public function likesCount(): int
    {
        return $this->likes()->count();
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like(): bool
    {
        $like = new Like(['user_id' => auth()->id()]);

        return (bool) $this->likes()->save($like);
    }

    public function unlike(): bool
    {
        return (bool) $this->likes()->where('user_id', auth()->id())->delete();
    }

    public function toggle(): bool
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }


    public function isLiked(): bool
    {
        return !! $this->likes()
            ->where('user_id', auth()->id())
            ->count();
    }

}
