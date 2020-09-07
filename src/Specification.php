<?php


namespace Laravie\Spec;


abstract class Specification implements Contracts\Specification
{
    abstract public function uid(): string;

    abstract public function validate(): Contracts\Result;
}