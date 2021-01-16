<?php

namespace App\Console\Commands;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Foundation\Console\RequestMakeCommand as BaseRequestMakeCommand;
use Illuminate\Support\Str;

class RequestMakeCommand extends BaseRequestMakeCommand
{
    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     *
     * @throws FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceRouteParam($stub)->replaceClass($stub, $name);
    }

    /**
     * Replace route param in stub
     *
     * @param $stub
     * @return $this
     * @throws \Jawira\CaseConverter\CaseConverterException
     */
    protected function replaceRouteParam(&$stub): RequestMakeCommand
    {
        $stub = str_replace(['RouteParam', '{{ routeParam }}', '{{routeParam}}'], $this->getRouteParam(), $stub);

        return $this;
    }

    /**
     * Convert input name into route param name
     * @return string
     * @throws \Jawira\CaseConverter\CaseConverterException
     */
    protected function getRouteParam()
    {
        return Str::singular(pascal_to_snake(Str::replaceFirst('Request', '', $this->getNameInput())));
    }
}
