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
