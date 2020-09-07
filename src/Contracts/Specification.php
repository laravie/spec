<?php


namespace Laravie\Spec\Contracts;


interface Specification
{
    /**
     * Get the specification UID.
     *
     * @return string
     */
    public function uid(): string;

    /**
     * Validate the specification and return a result.
     */
    public function validate(): Result;
}