<?php


namespace App\Support\ActivityLog\Enums;


class CauserTypes
{
    /**
     * Type Classes
     */
    protected static $types = [
        \App\Models\User::class,
    ];

    /**
     * Initialize labels
     */
    protected static function initLabels()
    {
        static::$labels = [];

        foreach (static::$types as $type) {
            $slug = with(new $type)->getMorphClass();

            static::$labels[$slug] = slug_to_title($slug);
        }
    }

    /**
     * Get label for key
     *
     * @param $key
     * @return string
     */
    public static function getSlug($key)
    {
        return $key;
    }

    /**
     * Get the types
     *
     * @return array
     */
    public static function getTypes()
    {
        return static::$types;
    }
}
