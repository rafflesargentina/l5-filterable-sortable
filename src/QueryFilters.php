<?php

namespace RafflesArgentina\FilterableSortable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use RafflesArgentina\FilterableSortable\Contracts\FilterableInterface;

abstract class QueryFilters implements FilterableInterface
{
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request The request object.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters to the builder.
     *
     * @param Builder $builder The builder instance.
     *
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach (array_filter($this->filters()) as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], [$value]);
            }
        }

        return $this->builder;
    }

    /**
     * Get all request data.
     *
     * @return array
     */
    public function filters()
    {
        return $this->request->all();
    }

    /**
     * Get applied filters from request.
     *
     * @return array
     */
    public static function getAppliedFilters()
    {
        $classMethods = get_class_methods(get_class());
        $calledClassMethods = get_class_methods(get_called_class());

        $filteredMethods = array_filter(
            $calledClassMethods, function ($calledClassMethod) use ($classMethods) {
                return !in_array($calledClassMethod, $classMethods, true);
            }
        );

        return \Illuminate\Support\Facades\Request::only($filteredMethods);
    }
}
