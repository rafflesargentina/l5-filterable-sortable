<?php

namespace RafflesArgentina\FilterableSortable;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use RafflesArgentina\FilterableSortable\Contracts\SortableInterface;

abstract class QuerySorters implements SortableInterface
{
    /**
     * The builder instance.
     *
     * @var Builder $builder
     */
    protected $builder;

    /**
     * The request object.
     *
     * @var Request $request
     */
    protected $request;

    /**
     * Set order key.
     *
     * @var string
     */
    protected static $orderKey;

    /**
     * Set orderBy key.
     *
     * @var string
     */
    protected static $orderByKey;

    /**
     * Set default order value.
     *
     * @var string
     */
    protected static $defaultOrder;

    /**
     * Set default orderBy value.
     *
     * @var string
     */
    protected static $defaultOrderBy;

    /**
     * Create a new QuerySorter instance.
     *
     * @param Request $request The request object.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get order from request or fallback to default.
     *
     * @return string
     */
    public function order()
    {
        $order = static::getOrderKey();
        return $this->request->{$order} ?: static::getDefaultOrder();
    }

    /**
     * Apply the sorter to the builder.
     *
     * @param Builder $builder The builder instance.
     *
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        if (method_exists($this, $this->orderBy())) {
            call_user_func([$this, $this->orderBy()]);
        }

        return $this->builder;
    }

    /**
     * Get orderBy from request or fallback to default.
     *
     * @return string
     */
    public function orderBy()
    {
        $orderBy = static::getOrderByKey();
        return $this->request->{$orderBy} ?: static::getDefaultOrderBy();
    }

    /**
     * Get order key.
     *
     * @return string
     */
    public static function getOrderKey()
    {
        return static::$order ?: 'order';
    }

    /**
     * Get orderBy key.
     *
     * @return string
     */
    public static function getOrderByKey()
    {
        return static::$orderBy ?: 'orderBy';
    }

    /**
     * Get default order value.
     *
     * @return string
     */
    public static function getDefaultOrder()
    {
        return static::$defaultOrder ?: 'asc';
    }

    /**
     * Pluck all sorters from class methods.
     *
     * @return array
     */
    public static function listOrderByKeys()
    {
        $classMethods = get_class_methods(get_class());
        $calledClassMethods = get_class_methods(get_called_class());

        $filteredMethods = array_filter(
            $calledClassMethods, function ($calledClassMethod) use ($classMethods) {
                return !in_array($calledClassMethod, $classMethods, true);
            }
        );

        $list = [];
        foreach ($filteredMethods as $k => $v) {
            $list[$v] = $v;
        }

        return $list;
    }

    /**
     * Get applied sorters from request or fallback to default.
     *
     * @return array
     */
    public static function getAppliedSorters()
    {
        $order = static::getOrderKey();
        $orderBy = static::getOrderByKey();

        $applied = \Illuminate\Support\Facades\Request::only($order, $orderBy);

        $applied = array_filter($applied);

        $default = [
            $orderBy => static::getDefaultOrderBy(),
            $order => static::getDefaultOrder()
        ];

        return $applied ?: $default;
    }

    /**
     * Get default orderBy value.
     *
     * @return string
     */
    public static function getDefaultOrderBy()
    {
        return static::$defaultOrderBy  ?: 'id';
    }
}
