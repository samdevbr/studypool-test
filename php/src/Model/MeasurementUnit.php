<?php
namespace App\Model;

class MeasurementUnit
{
    /** @var string $name */
    protected $name;
    /** @var string $abbreviation */
    protected $abbreviation;

    public function __construct(string $name, string $abbreviation)
    {
        $this->name = $name;
        $this->abbreviation = $abbreviation;
    }

    public function toString(int $amount): string
    {
        return "$amount{$this->abbreviation}";
    }
}
