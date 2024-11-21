<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CartActiveProductScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereHas('product.productable', function (Builder $query) {
            $query->where('is_active', true);
        });
    }
}