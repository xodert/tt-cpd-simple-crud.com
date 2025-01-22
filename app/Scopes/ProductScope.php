<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait ProductScope
{
    public function scopeAvailable(Builder $q, string $statusAlias = 'available'): Builder
    {
        return $q->where('status', $statusAlias);
    }
}