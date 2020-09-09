<?php

namespace Laravie\Spec\Contracts;

interface Specification
{
    /**
     * Get the specification UID.
     */
    public function uid(): string;

    /**
     * Validate the specification and return a result.
     */
    public function validate(): Result;
}
