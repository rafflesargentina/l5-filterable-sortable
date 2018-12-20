<?php

namespace RafflesArgentina\FilterableSortable;

use Carbon\Carbon;

class BaseFilters extends QueryFilters
{
    /**
     * Created After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('created_at', '>=', $date->toDateString());
    }

    /**
     * Created Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function created_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('created_at', '<=', $date->toDateString());
    }

    /**
     * Deleted After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('deleted_at', '>=', $date->toDateString());
    }

    /**
     * Deleted Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function deleted_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('deleted_at', '<=', $date->toDateString());
    }

    /**
     * Updated After
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_after($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('updated_at', '>=', $date->toDateString());
    }

    /**
     * Updated Before
     *
     * @param mixed $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function updated_before($query)
    {
        $date = Carbon::createFromFormat('d/m/Y', $query);
        return $this->builder->where('updated_at', '<=', $date->toDateString());
    }
}
