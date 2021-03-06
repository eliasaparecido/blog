<?php

namespace App\Http\Filters;

use Mnabialek\LaravelEloquentFilter\Filters\SimpleQueryFilter;


class UserFilter extends SimpleQueryFilter {
    protected $simpleFilters = ['search'];

    protected $simpleSorts = ['id', 'name', 'created_at'];

    protected function applySearch($value)
    {
        $this->query->where('name', 'LIKE', "%$value%");
    }
} 