<?php

namespace Laravie\Spec;

use Illuminate\Support\Str;

abstract class Specification implements Contracts\Specification
{
    /**
     * Specification UID.
     */
    public function uid(): string
    {
        return Str::slug($this->name());
    }

    /**
     * Specification name.
     */
    abstract public function name(): string;

    /**
     * Specification description.
     */
    abstract function description(): string;

    /**
     * Validate the specification.
     */
    abstract public function validate(): Contracts\Result;
}
