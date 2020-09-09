<?php

namespace Laravie\Spec\Contracts;

interface Specification
{
    /**
     * Specification UID.
     */
    public function uid(): string;

    /**
     * Specification name.
     */
    public function name(): string;

    /**
     * Specification description.
     */
    public function description(): string;

    /**
     * Validate the specification and return a result.
     */
    public function validate(): Result;
}
