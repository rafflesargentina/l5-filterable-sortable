# l5-filterable-sortable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

A trait for filtering and sorting Query Builder strings, based on Laracasts/Dedicated-Query-String-Filtering.

## Install

Via Composer

``` bash
$ composer require rafflesargentina/l5-filterable-sortable
```

## Usage

Add FilterableSortableTrait to your Eloquent model so you can make use of filter() and sorter() scopes. Both apply clauses to the Builder intance, that you must define as functions in separate classes. So, add $filters and $sorters protected properties to your model to define those classes location.

Example:

``` php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use RafflesArgentina\FilterableSortable\FilterableSortableTrait;

use App\Filters\ArticleFilters;
use App\Sorters\ArticleSorters;

class Article extends Model
{
    use FilterableSortableTrait;

    protected $filters = ArticleFilters::class;

    protected $sorters = ArticleSorters::class;

    // ...
}
```

### QueryFilters

Create a class that extends QueryFilters, and define public methods named after each request input data you want to use as a chained query filter. You can employ or even chain any where or conditional clause inside functions, as long as they return a Builder instance.

Example:


``` php
<?php

namespace App\Filters;

use RafflesArgentina\FilterableSortable\QueryFilters;

class ArticleFilters extends QueryFilters
{
    public function title($query)
    {
        return $this->builder->where('title', 'LIKE', '%'.$query.'%');
    }

    public function author($query)
    {
        return $this->builder->where('user_id', $query);
    }

    public function category_id($query)
    {
        return $this->builder->where('category_id', $query);
    }
}
```

You can also access the class method getAppliedFilters() statically, to get an array of the filters applied from request.

### QuerySorters

Create a class that extends QuerySorters, and define public methods named after each request input data you want to use as a chained query sorter. You can employ or even chain any where or conditional clause you wish inside functions, as long as they return a Builder instance. Default order direction and default order by key name must be set bhrough $defaultOrder and $defaultOrderByKey protected static properties. Optionally you can define order and order by key name, through $order and $orderBy protected static properties.

Example:

``` php
<?php

namespace App\Sorters;

use RafflesArgentina\FilterableSortable\QuerySorters;

class ArticleSorters extends QuerySorters
{
    // These protected properties are optional:

    protected static $order = 'orden'; // Fallback value is 'order'

    protected static $orderBy = 'ordenarPor'; // Fallback value is 'orderBy'

    // And there are NOT:

    protected static $defaultOrder = 'asc';

    protected static $defaultOrderByKey = 'title';

    public function title()
    {
        return $this->builder->orderBy('title', $this->order());
    }

    public function published_at()
    {
        return $this->builder->orderBy('updated_at', $this->order())
                             ->orderBy('title', $this->order());
    }

}
```

Additionally you access these static class methods to get sorter class protected data: getDefaultOrder(), getDefaultOrderByKey(). Access getAppliedSorters() to get applied sorters from request. Or listOrderByKeys() to populate a dropdown selector.

You can get filtered and sortered records for your model, from controller or anywhere you want like this:

``` php
// ...

$items = Article::filter()->sorter()->paginate();

// ...
```

That's it :)

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mario@raffles.com.ar instead of using the issue tracker.

## Credits

- [Mario Patronelli][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/rafflesargentina/l5-filterable-sortable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/rafflesargentina/l5-filterable-sortable/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rafflesargentina/l5-filterable-sortable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/rafflesargentina/l5-filterable-sortable
[link-travis]: https://travis-ci.org/rafflesargentina/l5-filterable-sortable
[link-downloads]: https://packagist.org/packages/rafflesargentina/l5-filterable-sortable
[link-author]: https://github.com/patronelli87
[link-contributors]: ../../contributors
