<?php
/**
 * Simple trait to set controller orderbys
 *
 * User: Arushad
 * Date: 06/10/2016
 * Time: 16:28
 */

namespace App\Support\Traits;

use Illuminate\Http\Request;

trait HasOrderBys
{

    protected static $orderbys = [];
    protected static $orders = [];

    /**
     * Get order bys
     */
    public static function getOrderbys(): array
    {
        //first initialize
        if ( empty(static::$orderbys) ) {
            static::initOrderbys();
        }

        return array_values(static::$orderbys);
    }

    /**
     * Initialize orderbys
     */
    protected static function initOrderbys()
    {
        static::$orderbys = ['id', 'name', 'created_at'];
    }

    /**
     * Get orders
     */
    public static function getOrders(): array
    {
        //first initialize
        if ( empty(static::$orders) ) {
            static::initOrders();
        }

        return static::$orders;
    }

    /**
     * Initialize orders
     */
    protected static function initOrders()
    {
        static::$orders = ['ASC', 'DESC'];
    }

    /**
     * Get the order by field
     *
     * @param Request $request
     * @param string $default
     * @return string
     */
    protected function getOrderBy(Request $request, $default): string
    {
        return in_array($request->orderby, self::getOrderbys()) ? $request->orderby : $default;
    }

    /**
     * Get the default sorting order
     *
     * @param Request $request
     * @param string $default
     * @param array|string $override
     * @param null $orderby
     * @return string
     */
    protected function getOrder(Request $request, $override = [], $orderby = null, $default = 'ASC'): string
    {
        if ($override && ! is_array($override)) {
            $override = [$override];
        }

        // get the requested order
        $order = strtoupper($request->order);

        if (empty($order)) {
            // if no order is specified and the order by is an override field
            // then use the inverse of the default order
            if (in_array($orderby, $override)) {
                return $default == 'ASC' ? 'DESC' : 'ASC';
            }

            return $default;
        }

        // return the specified order
        return $order == 'ASC' ? 'ASC' : 'DESC';
    }
}
