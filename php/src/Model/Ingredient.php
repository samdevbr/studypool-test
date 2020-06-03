<?php

namespace App\Model;

class Ingredient
{
    /** @var string $name */
    protected $name;
    /** @var int $amount */
    protected $amount;
    /** @var MeasurementUnit $measurementUnit */
    protected $measurementUnit;

    public function __construct(
        string $name,
        ?MeasurementUnit $measurementUnit,
        int $amount = 0
    ) {
        $this->name = $name;
        $this->measurementUnit = $measurementUnit;
        $this->amount = $amount;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setMeasurementUnit(MeasurementUnit $measurementUnit): void
    {
        $this->measurementUnit = $measurementUnit;
    }

    public function getMeasurementUnit(): MeasurementUnit
    {
        return $this->measurementUnit;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function __toString(): string
    {
        if (!$this->measurementUnit) {
            return $this->amount > 0 ?
                "{$this->amount} {$this->name}" :
                $this->name;
        };

        $measurementAsString = $this->measurementUnit
            ->toString($this->amount);

        return "$measurementAsString\t{$this->name}";
    }
}
