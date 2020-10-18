<?php

namespace Laravie\Spec\Contracts;

interface Presenter
{
    /**
     * Handle the requirement.
     *
     * @return mixed
     */
    public function handle(Requirement $requirement);
}
