<?php

namespace App\Model;

class RecipeInstruction
{
    /** @var string $step */
    protected $step;
    /** @var string $description */
    protected $description;

    public function __construct(int $step, string $description) {
        $this->step = $step;
        $this->description = $description;
    }

    public function setStep(int $step): void
    {
        $this->step = $step;
    }

    public function getStep(): int
    {
        return $this->step;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
