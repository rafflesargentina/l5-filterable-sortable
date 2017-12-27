<?php

namespace RafflesArgentina\FilterableSortable;

class TestSorters extends QuerySorters
{
    protected static $orderKey = 'orden';

    protected static $orderByKey = 'ordenarPor';

    protected static $defaultOrder = "asc";

    protected static $defaultOrderByKey = "name";

    public function id()
    {
        return $this->builder->orderBy("id", $this->order());
    }

    public function name()
    {
        return $this->builder->orderBy("name", $this->order());
    }
}
