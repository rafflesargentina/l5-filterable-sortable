<?php

namespace RafflesArgentina\FilterableSortable;

class TestFilters extends QueryFilters
{
    public function name($query)
    {
        return $this->builder->where('name', 'LIKE', '%'.$query.'%');
    }
}
