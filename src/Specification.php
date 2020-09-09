<?php

namespace Laravie\Spec;

abstract class Specification implements Contracts\Specification
{
    /**
     * Specification's name.
     */
    abstract public function uid(): string;

    /**
     * Validate the specification.
     */
    abstract public function validate(): Contracts\Result;
}
