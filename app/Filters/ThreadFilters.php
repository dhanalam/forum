<?php

namespace App\Filters;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    protected array $filters = ['by'];

    /**
     * By Username
     *
     * @param mixed $username
     * @return Builder
     */
    public function by(mixed $username): Builder
    {
        $user = User::where('name', $username)->first();

        return $this->builder->where('user_id', $user->id);
    }

}
