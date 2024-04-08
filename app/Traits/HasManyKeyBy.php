<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyKeyBy
{
    /**
     * @param $keyBy
     * @param $related
     * @param null $foreignKey
     * @param null $localKey
     * @return HasMany
     */
    protected function hasManyKeyBy($keyBy, $related, $foreignKey = null, $localKey = null)
    {
        // copied from \Illuminate\Database\Eloquent\Concerns\HasRelationships::hasMany

        $instance = $this->newRelatedInstance($related);
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey = $localKey ?: $this->getKeyName();

        return new \App\Helpers\Classes\HasManyKeyBy($keyBy, $instance->newQuery(),
            $this, $instance->getTable().'.'.$foreignKey, $localKey);
    }
}