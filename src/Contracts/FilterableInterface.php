<?php

namespace RafflesArgentina\FilterableSortable\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface FilterableInterface
{
    /**
     * Apply the filters to the builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder);

    /**
     * Get all request data.
     *
     * @return array
     */
    public function filters();

    /**
     * Get applied filters from request.
     *
     * @return array
     */
    public static function getAppliedFilters();
}
