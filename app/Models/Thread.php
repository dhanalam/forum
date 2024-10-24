<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Thread extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get Thread URL Path
     *
     * @return Attribute
     */
    public function path(): Attribute
    {
        return Attribute::make(
            get: fn() => "/threads/{$this->channel->slug}/{$this->id}"
        );
    }

    /**
     * Relations to Reply
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'thread_id');
    }


    /**
     * Relations to Channel
     *
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }


    /**
     * Relations to Creator
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * A Reply to Thread
     *
     * @param array $attributes
     * @return Reply
     */
    public function addReply(array $attributes): Reply
    {
        return $this->replies()->create($attributes);
    }


    public function scopeFilter(Builder $query, $filters)
    {
        return $filters->apply($query);
    }
}
