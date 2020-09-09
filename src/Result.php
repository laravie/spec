<?php

namespace Laravie\Spec;

use Illuminate\Support\Collection;

class Result implements Contracts\Result
{
    /**
     * List of errors for the Result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $errors;

    /**
     * List of recommendations for the Result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $recommendations;

    /**
     * Construct a result.
     */
    public function __construct()
    {
        $this->errors = new Collection();
        $this->recommendations = new Collection();
    }

    /**
     * Add an error.
     *
     * @return $this
     */
    public function error(string $message)
    {
        $this->errors->push($message);

        return $this;
    }

    /**
     * Add a recommendation.
     *
     * @return $this
     */
    public function recommend(string $recommend)
    {
        $this->recommendations->push($recommend);

        return $this;
    }

    /**
     * Passes result.
     */
    public function passes(): bool
    {
        return $this->errors->isEmpty();
    }

    /**
     * Failed result.
     */
    public function failed(): bool
    {
        return ! $this->passes();
    }

    /**
     * Get result errors.
     */
    public function errors(): array
    {
        return $this->errors->all();
    }

    /**
     * Get result recommendations.
     */
    public function recommendations(): array
    {
        return $this->recommendations->all();
    }
}
