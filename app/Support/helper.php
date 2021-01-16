<?php

if (! function_exists('add_error_class')) {
    /**
     * Adds error class if has error
     *
     * @param bool $has_error
     * @param string $classes
     * @param string $error_class
     * @return string
     */
    function add_error_class(bool $has_error, string $classes = 'form-control', string $error_class = 'is-invalid'): string
    {
        return $has_error ? $classes . ' ' . $error_class : $classes;
    }
}

if (! function_exists('add_sort_class')) {
    /**
     * Adds sorting class
     *
     * @param string $field
     * @param string $classes
     * @return string
     */
    function add_sort_class(string $field, $classes = ''): string
    {
        $sorting_class = 'chevron-';
        if (Request::get('orderby') == $field) {
            $sorting_class .= Request::get('order', 'ASC') == 'ASC' ? 'up' : 'down';
        }

        if ($classes) {
            $sorting_class .= ' ' . $classes;
        }

        return $sorting_class;
    }
}

if (! function_exists('pluralize')) {
    /**
     * Get plural form of the given word based on count provided
     * The point is the hide away the $count > 1 logic.
     *
     * @param string $word
     * @param int $count
     * @return string
     */
    function pluralize(string $word, int $count): string
    {
        return Str::plural($word, $count > 1 ? 2 : 1);
    }
}

if (! function_exists('pascal_to_snake')) {
    /**
     * Get plural form of the given word based on count provided
     * The point is the hide away the $count > 1 logic.
     *
     * @param string $string
     * @return string
     * @throws \Jawira\CaseConverter\CaseConverterException
     */
    function pascal_to_snake(string $string): string
    {
        return (new \Jawira\CaseConverter\Convert($string))->fromPascal()->toSnake();
    }
}

if (! function_exists('timeOfDay')) {
    /**
     * Get plural form of the given word based on count provided
     * The point is the hide away the $count > 1 logic.
     *
     * @param string $string
     * @return string
     * @throws \Jawira\CaseConverter\CaseConverterException
     */
    function timeOfDay(): string
    {
        $date = now();

        $hour = $date->format('H');

        if ($hour < 12 && $hour >= 4) {
            return 'morning';
        }

        if ($hour > 12 && $hour < 17) {
            return 'afternoon';
        }

        return 'evening';
    }
}
