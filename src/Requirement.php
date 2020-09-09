<?php

namespace Laravie\Spec;

use Illuminate\Support\Collection;

class Requirement implements Contracts\Requirement
{
    /**
     * Requirement name.
     *
     * @var string
     */
    protected $name;

    /**
     * List of specifications.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $specifications;

    /**
     * List of specification results.
     */
    protected $results;

    /**
     * Construct a new Requirement.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->specifications = new Collection();
    }

    /**
     * Add specification to current requirement.
     *
     * @return $this
     */
    public function add(Contracts\Specification $specification)
    {
        $this->specifications->put(
            $specification->uid(), $specification
        );

        return $this;
    }

    /**
     * Check whether the requirement passes.
     */
    public function passes(): bool
    {
        return $this->results()->filter(static function ($result) {
            return $result->failed();
        })->isEmpty();
    }

    /**
     * Check whether the requirement failed.
     */
    public function failed(): bool
    {
        return ! $this->passes();
    }

    /**
     * Get registered specifications.
     */
    public function specifications(): Collection
    {
        return $this->specifications;
    }

    /**
     * Get results from specifications.
     */
    public function results(): Collection
    {
        if (\is_null($this->results)) {
            $this->results = $this->specifications->mapWithKeys(static function ($specification) {
                return [$specification->uid() => $specification->validate()];
            });
        }

        return $this->results;
    }

    /**
     * Get results passes validation.
     */
    public function validated(): Collection
    {
        return $this->results()->filter(static function ($result) {
            return $result->passes();
        })->map(static function () {
            return true;
        });
    }

    /**
     * Get results errors.
     */
    public function errors(): Collection
    {
        return $this->results()->filter(static function ($result) {
            return $result->failed();
        })->map(static function ($result) {
            return $result->errors();
        });
    }

    /**
     * Get results recommendations.
     */
    public function recommendations(): Collection
    {
        return $this->results()->map(static function ($result) {
            return $result->recommendations();
        })->filter(static function ($recommendations) {
            return ! empty($recommendations);
        });
    }
}
