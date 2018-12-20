<?php

namespace RafflesArgentina\FilterableSortable;

use RafflesArgentina\FilterableSortable\Exceptions\FilterableSortableException;

trait FilterableSortableTrait
{
    /**
     * Filter a result set.
     *
     * @param Bulder $query The builder instance.
     *
     * @return Builder
     *
     * @throws FilterableSortableException
     */
    public function scopeFilter($query)
    {
        if (!$this->filters) {

            $message = 'Please set the $filters property.';
            throw new FilterableSortableException($message);
        }

        $this->filters = app()->make($this->filters);

        if (!$this->filters instanceof QueryFilters) {

            $message = '$filters property must be a class instance of QueryFilter.';
            throw new FilterableSortableException($message);
        }

        return $this->filters->apply($query);
    }

    /**
     * Sort a result set.
     *
     * @param Builder $query The builder instance.
     *
     * @return Builder
     *
     * @throws FilterableSortableException
     */
    public function scopeSort($query)
    {
        if (!$this->sorters) {

            $message = 'Please set the $sorters property.';
            throw new FilterableSortableException($message);
        }

        $this->sorters = app()->make($this->sorters);

        if (!$this->sorters instanceof QuerySorters) {

            $message = '$sorters property must be a class instance of QuerySorter.';
            throw new FilterableSortableException($message);
        }

        return $this->sorters->apply($query);
    }
}
