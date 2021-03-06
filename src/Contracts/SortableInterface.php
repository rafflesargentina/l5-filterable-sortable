<?php

namespace RafflesArgentina\FilterableSortable\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface SortableInterface
{
    /**
     * Get order from request or fallback to default.
     *
     * @return string
     */
    public function order();

    /**
     * Apply the sorter to the builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function apply(Builder $builder);

    /**
     * Get orderBy key from request or fallback to default.
     *
     * @return string
     */
    public function orderBy();

    /**
     * Get order key.
     *
     * @return string
     */
    public static function getOrderKey();

    /**
     * Get orderBy key.
     *
     * @return string
     */
    public static function getOrderByKey();

    /**
     * Get default order value.
     *
     * @return string
     */
    public static function getDefaultOrder();

    /**
     * Pluck all sorters from class methods.
     *
     * @return array
     */
    public static function listOrderByKeys();

    /**
     * Get applied sorters from request or fallback to default.
     *
     * @return array
     */
    public static function getAppliedSorters();

    /**
     * Get default orderBy value.
     *
     * @return string
     */
    public static function getDefaultOrderBy();
}
