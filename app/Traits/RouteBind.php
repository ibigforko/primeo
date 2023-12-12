<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait RouteBind
{
    /**
     * Model route binding parameters.
     *
     * @param $value
     * @param $field
     * 
     * @return Model
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->bindKey ?? $field ?? 'id', $value)
                    ->when($this->forceDeleting === false, fn($q) => $q->withTrashed())
                    ->firstOrFail();
    }
}