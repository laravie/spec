<?php

namespace Laravie\Spec\Contracts;

interface Result
{
    /**
     * Passes result.
     */
    public function passes(): bool;

    /**
     * Failed result.
     */
    public function failed(): bool;

    /**
     * Get result errors.
     */
    public function errors(): array;

    /**
     * Get result recommendations.
     */
    public function recommendations(): array;
}
