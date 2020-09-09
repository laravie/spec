<?php

namespace Laravie\Spec\Contracts;

use Illuminate\Support\Collection;

interface Requirement
{
    /**
     * Add specification to current requirement.
     *
     * @return $this
     */
    public function add(Specification $specification);

    /**
     * Check whether the requirement passes.
     */
    public function passes(): bool;

    /**
     * Check whether the requirement failed.
     */
    public function failed(): bool;

    /**
     * Get registered specifications.
     */
    public function specifications(): Collection;

    /**
     * Get results from specifications.
     */
    public function results(): Collection;

    /**
     * Get results passes validation.
     */
    public function validated(): Collection;
}
