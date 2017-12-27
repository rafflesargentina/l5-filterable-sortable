<?php

namespace RafflesArgentina\FilterableSortable;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use RafflesArgentina\FilterableSortable\Models\Test;

class TestController extends Controller
{
    public function __invoke(Request $request, Test $test)
    {
        $items = $test->filter()->sorter()->paginate();
        return $items;
    }
}
