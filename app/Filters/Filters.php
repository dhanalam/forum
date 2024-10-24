<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    protected Builder $builder;
    private Request $request;
    protected array $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply Filters
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter))  {
                $this->$filter($this->request->$filter);
            }
        }

        return $builder;
    }


    public function getFilters(): array
    {
        return $this->request->only($this->filters);
    }



}
