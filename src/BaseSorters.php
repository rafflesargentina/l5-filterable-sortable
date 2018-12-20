<?php

namespace RafflesArgentina\FilterableSortable;

use RafflesArgentina\FilterableSortable\QuerySorters;

class BaseSorters extends QuerySorters
{
    protected static $defaultOrder = "desc";

    protected static $defaultOrderBy = "updated_at";

    /**
     * Created_at
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_at()
    {
        return $this->builder->orderBy('created_at', $this->order());
    }

    /**
     * Deleted_at
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_at()
    {
        return $this->builder->orderBy('deleted_at', $this->order());
    }

    /**
     * Updated_at
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_at()
    {
        return $this->builder->orderBy('updated_at', $this->order());
    }
}
