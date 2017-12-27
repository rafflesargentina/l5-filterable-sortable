<?php

namespace RafflesArgentina\FilterableSortable\Models;

use Illuminate\Database\Eloquent\Model;

use RafflesArgentina\FilterableSortable\TestFilters;
use RafflesArgentina\FilterableSortable\TestSorters;
use RafflesArgentina\FilterableSortable\FilterableSortableTrait;

class User extends Model
{
    use FilterableSortableTrait; 

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $filters = TestFilters::class;

    protected $sorters = TestSorters::class;
}
