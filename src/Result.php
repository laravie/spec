<?php

namespace Laravie\Spec;

use Illuminate\Support\Collection;

class Result implements Contracts\Result
{
    /**
     * Specification name.
     *
     * @var string
     */
    protected $name;

    /**
     * Specification description.
     *
     * @var string
     */
    protected $description;

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
     * Construct a new result.
     */
    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $this->errors = new Collection();
        $this->recommendations = new Collection();
    }

    /**
     * Construct a new result from specification.
     *
     * @return static
     */
    public static function make(Contracts\Specification $specification)
    {
        return new static(
            $specification->name(), $specification->description()
        );
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

    /**
     * Get the specification name,
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get the specification description.
     */
    public function description(): string
    {
        return $this->description;
    }


}
