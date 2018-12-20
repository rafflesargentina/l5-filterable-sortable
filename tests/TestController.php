<?php

namespace RafflesArgentina\FilterableSortable;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use RafflesArgentina\FilterableSortable\Models\User;

class TestController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $items = $user->filter()->sort()->get();
        return response()->json($items->toArray());
    }
}
